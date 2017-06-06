<?php

    namespace Martin\Forms\Classes;

    use AjaxException, Lang, Redirect, Request, Session, Validator;
    use Cms\Classes\ComponentBase;
    use Illuminate\Support\Facades\Event;
    use October\Rain\Exception\ApplicationException;
    use October\Rain\Exception\ValidationException;
    use October\Rain\Support\Facades\Flash;
    use Martin\Forms\Classes\BackendHelpers;
    use Martin\Forms\Classes\SendMail;
    use Martin\Forms\Models\Record;
    use Martin\Forms\Models\Settings;

    abstract class MagicForm extends ComponentBase {

        use \Martin\Forms\Classes\ReCaptcha;
        use \Martin\Forms\Classes\SharedProperties;

        public function onRun() {

            $this->page['recaptcha_enabled']       = $this->isReCaptchaEnabled();
            $this->page['recaptcha_misconfigured'] = $this->isReCaptchaMisconfigured();

            if($this->isReCaptchaEnabled()) {
                $this->loadReCaptcha();
            }

            if($this->isReCaptchaMisconfigured()) {
                $this->page['recaptcha_warn'] = Lang::get('martin.forms::lang.components.shared.recaptcha_warn');
            }

            if($this->property('inline_errors') == 'display') {
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

            # CSRF CHECK
            if(Session::token() != post('_token')) {
                throw new AjaxException(['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                    'type'    => 'danger',
                    'content' => Lang::get('martin.forms::lang.components.shared.csrf_error'),
                ])]);
            }

            # LOAD TRANSLATOR PLUGIN
            if(BackendHelpers::isTranslatePlugin()) {
                $translator = \RainLab\Translate\Classes\Translator::instance();
                $translator->loadLocaleFromSession();
                $locale = $translator->getLocale();
                \RainLab\Translate\Models\Message::setContext($locale);
            }

            # FILTER ALLOWED FIELDS
            $allow = $this->property('allowed_fields');
            if(is_array($allow) && !empty($allow)) {
                foreach($allow as $field) {
                    $post[$field] = post($field);
                }
                if($this->isReCaptchaEnabled()) { $post['g-recaptcha-response'] = post('g-recaptcha-response'); }
            } else {
                $post = post();
            }

            # VALIDATION PARAMETERS
            $rules = (array) $this->property('rules');
            $msgs  = (array) $this->property('rules_messages');

            # TRANSLATE CUSTOM ERROR MESSAGES
            if(BackendHelpers::isTranslatePlugin()) {
                foreach($msgs as $rule => $msg) {
                    $msgs[$rule] = \RainLab\Translate\Models\Message::trans($msg);
                }
            }

            # ADD reCAPTCHA VALIDATION
            if($this->isReCaptchaEnabled()) {
                $rules['g-recaptcha-response'] = 'required';
            }

            # DO FORM VALIDATION
            $validator = Validator::make($post, $rules, $msgs);
    
            # NICE reCAPTCHA FIELD NAME
            if($this->isReCaptchaEnabled()) {
                $fields_names = ['g-recaptcha-response' => 'reCAPTCHA'];
                $validator->setAttributeNames($fields_names);
            }

            # VALIDATE ALL + CAPTCHA EXISTS
            if($validator->fails()) {

                # GET DEFAULT ERROR MESSAGE
                $message = $this->property('messages_errors');

                # LOOK FOR TRANSLATION
                if(BackendHelpers::isTranslatePlugin()) {
                    $message = \RainLab\Translate\Models\Message::trans($message);
                }

                # THROW ERRORS
                if($this->property('inline_errors') == 'display') {
                    throw new ValidationException($validator);
                } else {
                    throw new AjaxException($this->exceptionResponse($validator, [
                        'type'    => 'danger',
                        'title'   => $message,
                        'list'    => $validator->messages()->all(),
                        'jscript' => $this->property('js_on_error'),
                    ]));
                }

            }

            # IF FIRST VALIDATION IS OK, VALIDATE CAPTCHA vs GOOGLE
            # (this prevents to resolve captcha after every form error)
            if($this->isReCaptchaEnabled()) {

                # PREPARE RECAPTCHA VALIDATION
                $rules   = ['g-recaptcha-response'           => 'recaptcha'];
                $err_msg = ['g-recaptcha-response.recaptcha' => Lang::get('martin.forms::lang.validation.recaptcha_error')];

                # DO SECOND VALIDATION
                $validator = Validator::make($post, $rules, $err_msg);

                # VALIDATE ALL + CAPTCHA EXISTS
                if($validator->fails()) {

                    # THROW ERRORS
                    if($this->property('inline_errors') == 'display') {
                        throw new ValidationException($validator);
                    } else {
                        throw new AjaxException($this->exceptionResponse($validator, [
                            'type'    => 'danger',
                            'content' => Lang::get('martin.forms::lang.validation.recaptcha_error'),
                            'jscript' => $this->property('js_on_error'),
                        ]));
                    }

                }

            }

            # REMOVE EXTRA FIELDS FROM STORED DATA
            unset($post['_token'], $post['g-recaptcha-response'], $post['_session_key'], $post['_uploader']);

            Event::fire('martin.forms.beforeSaveRecord', json_encode($post));

            # SAVE RECORD TO DATABASE
            $record = new Record;
            $record->ip        = $this->getIP();
            $record->form_data = json_encode($post);
            if($this->property('group') != '') { $record->group = $this->property('group'); }
            $record->save(null, post('_session_key'));

            # SEND NOTIFICATION EMAIL
            if($this->property('mail_enabled')) {
                SendMail::sendNotification($this->getProperties(), $post, $record, $record->files);
            }

            # SEND AUTORESPONSE EMAIL
            if($this->property('mail_resp_enabled')) {
                SendMail::sendAutoResponse($this->getProperties(), $post);
            }
            
            Event::fire('martin.forms.afterSaveRecord', json_encode($post));

            # CHECK FOR REDIRECT
            if(filter_var($this->property('redirect'), FILTER_VALIDATE_URL)) {
                return Redirect::to($this->property('redirect'));
            }

            # GET DEFAULT SUCCESS MESSAGE
            $message = $this->property('messages_success');

            # LOOK FOR TRANSLATION
            if(BackendHelpers::isTranslatePlugin()) {
                $message = \RainLab\Translate\Models\Message::trans($message);
            }

            # DISPLAY SUCCESS MESSAGE
            return ['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                'type'    => 'success',
                'content' => $message,
                'jscript' => $this->prepareJavaScript(),
            ])];

        }

        private function exceptionResponse($validator, $params) {

            # EXCEPTION RESPONSE
            $response = ['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', $params)];

            # INCLUDE ERROR FIELDS IF REQUIRED
            if($this->property('inline_errors') != 'disabled') {
                $response['error_fields'] = $validator->messages();
            }

            return $response;

        }

        private function prepareJavaScript() {

            $code = false;

            /* SUCCESS JS */
            if($this->property('js_on_success') != '') {
                $code .= $this->property('js_on_success');
            }

            /* RECAPTCHA JS */
            if($this->isReCaptchaEnabled()) {
                $code .= $content = $this->renderPartial('@js/recaptcha.js');
            }

            /* RESET FORM JS */
            if($this->property('reset_form')) {
                $code .= $content = $this->renderPartial('@js/reset-form.js', ['id' => '#' . $this->alias . '_forms_flash']);
                if($this->property('uploader_enable')) { $code .= $content = $this->renderPartial('@js/reset-uploader.js', ['id' => $this->alias]); }
            }

            return $code;

        }

        private function getIP() {
            if($this->property('anonymize_ip') == 'full') {
                $address = '(Not stored)';
            } else if($this->property('anonymize_ip') == 'partial') {
                $address = BackendHelpers::anonymizeIPv4(Request::getClientIp());
            } else {
                $address = Request::getClientIp();
            }
            return $address;
        }

    }

?>