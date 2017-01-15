<?php

    namespace Martin\Forms\Classes;

    use AjaxException, Lang, Request, Session, Validator;
    use Cms\Classes\ComponentBase;
    use October\Rain\Exception\ApplicationException;
    use October\Rain\Support\Facades\Flash;
    use Martin\Forms\Classes\SendMail;
    use Martin\Forms\Models\Record;
    use Martin\Forms\Models\Settings;

    abstract class MagicForm extends ComponentBase {

        public function onRun() {

            $this->page['recaptcha_enabled']       = $this->isReCaptchaEnabled();
            $this->page['recaptcha_misconfigured'] = $this->isReCaptchaMisconfigured();

            if($this->isReCaptchaEnabled()) {
                $this->addJs('https://www.google.com/recaptcha/api.js');
            }

            if($this->isReCaptchaMisconfigured()) {
                $this->page['recaptcha_warn'] = Lang::get('martin.forms::lang.components.shared.recaptcha_warn');
            }

        }

        public function settings() {
            return [
                'recaptcha_site_key'   => Settings::get('recaptcha_site_key'),
                'recaptcha_secret_key' => Settings::get('recaptcha_secret_key'),
            ];
        }

        public function defineProperties() {
            return [
                'group' => [
                    'title'             => 'martin.forms::lang.components.shared.group.title',
                    'description'       => 'martin.forms::lang.components.shared.group.description',
                    'type'              => 'string',
                    'showExternalParam' => false,
                ],
                'rules' => [
                    'title'             => 'martin.forms::lang.components.shared.rules.title',
                    'description'       => 'martin.forms::lang.components.shared.rules.description',
                    'type'              => 'dictionary',
                    'group'             => 'martin.forms::lang.components.shared.group_validation',
                    'showExternalParam' => false,
                ],
                'rules_messages' => [
                    'title'             => 'martin.forms::lang.components.shared.rules_messages.title',
                    'description'       => 'martin.forms::lang.components.shared.rules_messages.description',
                    'type'              => 'dictionary',
                    'group'             => 'martin.forms::lang.components.shared.group_validation',
                    'showExternalParam' => false,
                ],
                'messages_success' => [
                    'title'             => 'martin.forms::lang.components.shared.messages_success.title',
                    'description'       => 'martin.forms::lang.components.shared.messages_success.description',
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_messages',
                    'default'           => Lang::get('martin.forms::lang.components.shared.messages_success.default'),
                    'showExternalParam' => false,
                    'validation'        => ['required' => ['message' => Lang::get('martin.forms::lang.components.shared.validation_req')]]
                ],
                'messages_errors' => [
                    'title'             => 'martin.forms::lang.components.shared.messages_errors.title',
                    'description'       => 'martin.forms::lang.components.shared.messages_errors.description',
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_messages',
                    'default'           => Lang::get('martin.forms::lang.components.shared.messages_errors.default'),
                    'showExternalParam' => false,
                    'validation'        => ['required' => ['message' => Lang::get('martin.forms::lang.components.shared.validation_req')]]
                ],
                'mail_enabled' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_enabled.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_enabled.description',
                    'type'              => 'checkbox',
                    'group'             => 'martin.forms::lang.components.shared.group_mail',
                    'showExternalParam' => false
                ],
                'mail_subject' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_subject.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_subject.description',
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_mail',
                    'showExternalParam' => false
                ],
                'mail_recipients' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_recipients.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_recipients.description',
                    'type'              => 'stringList',
                    'group'             => 'martin.forms::lang.components.shared.group_mail',
                    'showExternalParam' => false
                ],
                'mail_resp_enabled' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_resp_enabled.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_resp_enabled.description',
                    'type'              => 'checkbox',
                    'group'             => 'martin.forms::lang.components.shared.group_mail_resp',
                    'showExternalParam' => false
                ],
                'mail_resp_field' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_resp_field.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_resp_field.description',
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_mail_resp',
                    'showExternalParam' => false
                ],
                'mail_resp_from' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_resp_from.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_resp_from.description',
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_mail_resp',
                    'showExternalParam' => false
                ],
                'mail_resp_subject' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_resp_subject.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_resp_subject.description',
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_mail_resp',
                    'showExternalParam' => false
                ],
                'allowed_fields' => [
                    'title'             => 'martin.forms::lang.components.shared.allowed_fields.title',
                    'description'       => 'martin.forms::lang.components.shared.allowed_fields.description',
                    'type'              => 'stringList',
                    'group'             => 'martin.forms::lang.components.shared.group_security',
                    'showExternalParam' => false
                ],
                'recaptcha_enabled' => [
                    'title'             => 'martin.forms::lang.components.shared.recaptcha_enabled.title',
                    'description'       => 'martin.forms::lang.components.shared.recaptcha_enabled.description',
                    'type'              => 'checkbox',
                    'group'             => 'martin.forms::lang.components.shared.group_recaptcha',
                    'showExternalParam' => false
                ],
                'recaptcha_theme' => [
                    'title'             => 'martin.forms::lang.components.shared.recaptcha_theme.title',
                    'description'       => 'martin.forms::lang.components.shared.recaptcha_theme.description',
                    'type'              => 'dropdown',
                    'options'           => ['light' => 'martin.forms::lang.components.shared.recaptcha_theme.light', 'dark' => 'martin.forms::lang.components.shared.recaptcha_theme.dark'],
                    'default'           => 'light',
                    'group'             => 'martin.forms::lang.components.shared.group_recaptcha',
                    'showExternalParam' => false
                ],
                'recaptcha_type' => [
                    'title'             => 'martin.forms::lang.components.shared.recaptcha_type.title',
                    'description'       => 'martin.forms::lang.components.shared.recaptcha_type.description',
                    'type'              => 'dropdown',
                    'options'           => ['image' => 'martin.forms::lang.components.shared.recaptcha_type.image', 'audio' => 'martin.forms::lang.components.shared.recaptcha_type.audio'],
                    'default'           => 'image',
                    'group'             => 'martin.forms::lang.components.shared.group_recaptcha',
                    'showExternalParam' => false
                ],
                'recaptcha_size' => [
                    'title'             => 'martin.forms::lang.components.shared.recaptcha_size.title',
                    'description'       => 'martin.forms::lang.components.shared.recaptcha_size.description',
                    'type'              => 'dropdown',
                    'options'           => ['normal' => 'martin.forms::lang.components.shared.recaptcha_size.normal', 'compact' => 'martin.forms::lang.components.shared.recaptcha_size.compact'],
                    'default'           => 'normal',
                    'group'             => 'martin.forms::lang.components.shared.group_recaptcha',
                    'showExternalParam' => false
                ],
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

            # ADD reCAPTCHA VALIDATION
            if($this->isReCaptchaEnabled()) {
                $rules['g-recaptcha-response'] = 'required';
            }

            # NICE reCAPTCHA FIELD NAME
            $fields_names = ['g-recaptcha-response' => 'reCAPTCHA'];

            # DO FORM VALIDATION
            $validator = Validator::make($post, $rules, $msgs);
            $validator->setAttributeNames($fields_names);

            # VALIDATE ALL + CAPTCHA EXISTS
            if($validator->fails()) {
                throw new AjaxException(['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                    'type'  => 'danger',
                    'title' => $this->property('messages_errors'),
                    'list'  => $validator->messages()->all()
                ])]);
            }

            # IF FIRST VALIDATION IS OK, VALIDATE CAPTCHA vs GOOGLE
            # (this prevents to resolve captcha after every form error)
            if($this->isReCaptchaEnabled()) {

                # DO SECOND VALIDATION
                $rules     = ['g-recaptcha-response' => 'recaptcha'];
                $validator = Validator::make($post, $rules);

                # VALIDATE ALL + CAPTCHA EXISTS
                if($validator->fails()) {
                    throw new AjaxException(['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                        'type'    => 'danger',
                        'content' => Lang::get('martin.forms::lang.validation.recaptcha_error')
                    ])]);
                }

            }

            # REMOVE EXTRA FIELDS FROM STORED DATA
            unset($post['_token'], $post['g-recaptcha-response']);

            # SAVE RECORD TO DATABASE
            $record = new Record;
            $record->ip        = Request::getClientIp();
            $record->form_data = json_encode($post);
            if($this->property('group') != '') { $record->group = $this->property('group'); }
            $record->save();

            # SEND NOTIFICATION EMAIL
            if($this->property('mail_enabled')) {
                SendMail::sendNotification($this->property('mail_recipients'), $this->property('mail_subject'), $record, $post);
            }

            # SEND AUTORESPONSE EMAIL
            if($this->property('mail_resp_enabled')) {
                SendMail::sendAutoResponse($post[$this->property('mail_resp_field')], $this->property('mail_resp_from'), $this->property('mail_resp_subject'), $post);
            }

            # SHOW SUCCESS MESSAGE
            return ['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                'type'    => 'success',
                'content' => $this->property('messages_success'),
                'jscript' => ($this->isReCaptchaEnabled()) ? 'grecaptcha.reset();' : false
            ])];

        }

        private function isReCaptchaEnabled() {
            return ($this->property('recaptcha_enabled') && Settings::get('recaptcha_site_key') != '' && Settings::get('recaptcha_secret_key') != '');
        }

        private function isReCaptchaMisconfigured() {
            return ($this->property('recaptcha_enabled') && (Settings::get('recaptcha_site_key') == '' || Settings::get('recaptcha_secret_key') == ''));
        }

    }

?>