<?php

namespace Martin\Forms\Classes;

use Lang;
use Config;
use Request;
use Session;
use Redirect;
use Validator;
use AjaxException;
use Cms\Classes\ComponentBase;
use Martin\Forms\Models\Record;
use Martin\Forms\Models\Settings;
use Martin\Forms\Classes\SendMail;
use Illuminate\Support\Facades\Event;
use Martin\Forms\Classes\BackendHelpers;
use October\Rain\Exception\ValidationException;

abstract class MagicForm extends ComponentBase
{

    use \Martin\Forms\Classes\ReCaptcha;
    use \Martin\Forms\Classes\SharedProperties;

    public function onRun() {

        $this->page['recaptcha_enabled']       = $this->isReCaptchaEnabled();
        $this->page['recaptcha_misconfigured'] = $this->isReCaptchaMisconfigured();

        if ($this->isReCaptchaEnabled()) {
            $this->loadReCaptcha();
        }

        if ($this->isReCaptchaMisconfigured()) {
            $this->page['recaptcha_warn'] = Lang::get('martin.forms::lang.components.shared.recaptcha_warn');
        }

        if ($this->property('inline_errors') == 'display') {
            $this->addJs('assets/js/inline-errors.js');
        }

    }

    public function settings() {
        return [
            'recaptcha_site_key'   => Settings::get('recaptcha_site_key'),
            'recaptcha_secret_key' => Settings::get('recaptcha_secret_key'),
        ];
    }

    public function onFormSubmit() {

        // FLASH PARTIAL
        $flash_partial = $this->property('messages_partial', '@flash.htm');

        // CSRF CHECK
        if (Config::get('cms.enableCsrfProtection') && (Session::token() != post('_token'))) {
            throw new AjaxException(['#' . $this->alias . '_forms_flash' => $this->renderPartial($flash_partial, [
                'status'  => 'error',
                'type'    => 'danger',
                'content' => Lang::get('martin.forms::lang.components.shared.csrf_error'),
            ])]);
        }

        // LOAD TRANSLATOR PLUGIN
        if (BackendHelpers::isTranslatePlugin()) {
            $translator = \RainLab\Translate\Classes\Translator::instance();
            $translator->loadLocaleFromSession();
            $locale = $translator->getLocale();
            \RainLab\Translate\Models\Message::setContext($locale);
        }

        // FILTER ALLOWED FIELDS
        $allow = $this->property('allowed_fields');
        if (is_array($allow) && !empty($allow)) {
            foreach ($allow as $field) {
                $post[$field] = post($field);
            }
            if ($this->isReCaptchaEnabled()) {
                $post['g-recaptcha-response'] = post('g-recaptcha-response');
            }
        } else {
            $post = post();
        }

        // SANITIZE FORM DATA
        if ($this->property('sanitize_data') == 'htmlspecialchars') {
            $post = $this->array_map_recursive(function ($value) {
                return htmlspecialchars($value, ENT_QUOTES);
            }, $post);
        }

        // VALIDATION PARAMETERS
        $rules = (array)$this->property('rules');
        $msgs  = (array)$this->property('rules_messages');
        $custom_attributes = (array)$this->property('custom_attributes');

        // TRANSLATE CUSTOM ERROR MESSAGES
        if (BackendHelpers::isTranslatePlugin()) {
            foreach ($msgs as $rule => $msg) {
                $msgs[$rule] = \RainLab\Translate\Models\Message::trans($msg);
            }
        }

        // ADD reCAPTCHA VALIDATION
        if ($this->isReCaptchaEnabled() && $this->property('recaptcha_size') != 'invisible') {
            $rules['g-recaptcha-response'] = 'required';
        }

        // DO FORM VALIDATION
        $validator = Validator::make($post, $rules, $msgs, $custom_attributes);

        // NICE reCAPTCHA FIELD NAME
        if ($this->isReCaptchaEnabled()) {
            $fields_names = ['g-recaptcha-response' => 'reCAPTCHA'];
            $validator->setAttributeNames(array_merge($fields_names, $custom_attributes));
        }

        // VALIDATE ALL + CAPTCHA EXISTS
        if ($validator->fails()) {

            // GET DEFAULT ERROR MESSAGE
            $message = $this->property('messages_errors');

            // LOOK FOR TRANSLATION
            if (BackendHelpers::isTranslatePlugin()) {
                $message = \RainLab\Translate\Models\Message::trans($message);
            }

            // THROW ERRORS
            if ($this->property('inline_errors') == 'display') {
                throw new ValidationException($validator);
            } else {
                throw new AjaxException($this->_exceptionResponse($validator, [
                    'status'  => 'error',
                    'type'    => 'danger',
                    'title'   => $message,
                    'list'    => $validator->messages()->all(),
                    'errors'  => json_encode($validator->messages()->messages()),
                    'jscript' => $this->property('js_on_error'),
                ]));
            }

        }

        // IF FIRST VALIDATION IS OK, VALIDATE CAPTCHA vs GOOGLE
        // (this prevents to resolve captcha after every form error)
        if ($this->isReCaptchaEnabled()) {

            // PREPARE RECAPTCHA VALIDATION
            $rules   = ['g-recaptcha-response'           => 'recaptcha'];
            $err_msg = ['g-recaptcha-response.recaptcha' => Lang::get('martin.forms::lang.validation.recaptcha_error')];

            // DO SECOND VALIDATION
            $validator = Validator::make($post, $rules, $err_msg);

            // VALIDATE ALL + CAPTCHA EXISTS
            if ($validator->fails()) {

                // THROW ERRORS
                if ($this->property('inline_errors') == 'display') {
                    throw new ValidationException($validator);
                } else {
                    throw new AjaxException($this->_exceptionResponse($validator, [
                        'status'  => 'error',
                        'type'    => 'danger',
                        'content' => Lang::get('martin.forms::lang.validation.recaptcha_error'),
                        'errors'  => json_encode($validator->messages()->messages()),
                        'jscript' => $this->property('js_on_error'),
                    ]));
                }

            }

        }

        // REMOVE EXTRA FIELDS FROM STORED DATA
        unset($post['_token'], $post['g-recaptcha-response'], $post['_session_key'], $post['_uploader']);

        // FIRE BEFORE SAVE EVENT
        Event::fire('martin.forms.beforeSaveRecord', [&$post, $this]);

        if (count($custom_attributes)) {
            $post = collect($post)->mapWithKeys(function ($val, $key) use ($custom_attributes) {
                return [array_get($custom_attributes, $key, $key) => $val];
            })->all();
        }

        $record = new Record;
        $record->ip        = $this->getIP();
        $record->created_at = date('Y-m-d H:i:s');

        // SAVE RECORD TO DATABASE
        if (! $this->property('skip_database')) {
            $record->form_data = json_encode($post, JSON_UNESCAPED_UNICODE);
            if ($this->property('group') != '') {
                $record->group = $this->property('group');
            }
            $record->save(null, post('_session_key'));
        }

        // SEND NOTIFICATION EMAIL
        if ($this->property('mail_enabled')) {
            SendMail::sendNotification($this->getProperties(), $post, $record, $record->files);
        }

        // SEND AUTORESPONSE EMAIL
        if ($this->property('mail_resp_enabled')) {
            SendMail::sendAutoResponse($this->getProperties(), $post, $record);
        }

        // FIRE AFTER SAVE EVENT
        Event::fire('martin.forms.afterSaveRecord', [&$post, $this, $record]);

        // CHECK FOR REDIRECT
        if ($this->property('redirect')) {
            return Redirect::to($this->property('redirect'));
        }

        // GET DEFAULT SUCCESS MESSAGE
        $message = $this->property('messages_success');

        // LOOK FOR TRANSLATION
        if (BackendHelpers::isTranslatePlugin()) {
            $message = \RainLab\Translate\Models\Message::trans($message);
        }

        // DISPLAY SUCCESS MESSAGE
        return ['#' . $this->alias . '_forms_flash' => $this->renderPartial($flash_partial, [
            'status'  => 'success',
            'type'    => 'success',
            'content' => $message,
            'jscript' => $this->prepareJavaScript(),
        ])];

    }

    private function _exceptionResponse($validator, $params) {

        // FLASH PARTIAL
        $flash_partial = $this->property('messages_partial', '@flash.htm');

        // EXCEPTION RESPONSE
        $response = ['#' . $this->alias . '_forms_flash' => $this->renderPartial($flash_partial, $params)];

        // INCLUDE ERROR FIELDS IF REQUIRED
        if ($this->property('inline_errors') != 'disabled') {
            $response['error_fields'] = $validator->messages();
        }

        return $response;

    }

    private function prepareJavaScript()
    {
        $code = false;

        /* SUCCESS JS */
        if ($this->property('js_on_success') != '') {
            $code .= $this->property('js_on_success');
        }

        /* RECAPTCHA JS */
        if ($this->isReCaptchaEnabled()) {
            $code .= $this->renderPartial('@js/recaptcha.htm');
        }

        /* RESET FORM JS */
        if ($this->property('reset_form')) {
            $params = ['id' => '#' . $this->alias . '_forms_flash'];
            $code .= $this->renderPartial('@js/reset-form.htm', $params);
        }

        /* RESET UPLOAD FORM */
        if ($this->property('reset_form') && $this->property('uploader_enable')) {
            $params = ['id' => $this->alias];
            $code .= $this->renderPartial('@js/reset-uploader.htm', $params);
        }

        return $code;
    }

    private function getIP()
    {
        if ($this->property('anonymize_ip') == 'full') {
            return '(Not stored)';
        }

        $ip = Request::getClientIp();

        if ($this->property('anonymize_ip') == 'partial') {
            return BackendHelpers::anonymizeIPv4($ip);
        }

        return $ip;
    }

    private function array_map_recursive($callback, $array)
    {
        $func = function ($item) use (&$func, &$callback) {
            return is_array($item) ? array_map($func, $item) : call_user_func($callback, $item);
        };

        return array_map($func, $array);
    }
}
