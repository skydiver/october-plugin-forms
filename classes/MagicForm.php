<?php

    namespace Martin\Forms\Classes;

    use AjaxException, Lang, Mail, Request, Session, Validator;
    use Cms\Classes\ComponentBase;
    use October\Rain\Exception\ApplicationException;
    use October\Rain\Support\Facades\Flash;
    use Martin\Forms\Models\Record;
    use Martin\Forms\Models\Settings;

    abstract class MagicForm extends ComponentBase {

        public function onRun() {

            if($this->isReCaptchaEnabled()) {
                $this->addJs('https://www.google.com/recaptcha/api.js');
            }

            if($this->property('recaptcha_enabled') && (Settings::get('recaptcha_site_key') == '' || Settings::get('recaptcha_secret_key') == '')) {
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
                'allowed_fields' => [
                    'title'             => 'martin.forms::lang.components.shared.allowed_fields.title',
                    'description'       => 'martin.forms::lang.components.shared.allowed_fields.description',
                    'type'              => 'stringList',
                    'group'             => 'martin.forms::lang.components.shared.group_security',
                    'showExternalParam' => false
                ],
                'mail_enabled' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_enabled.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_enabled.description',
                    'type'              => 'checkbox',
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
                'recaptcha_enabled' => [
                    'title'             => 'martin.forms::lang.components.shared.recaptcha_enabled.title',
                    'description'       => 'martin.forms::lang.components.shared.recaptcha_enabled.description',
                    'type'              => 'checkbox',
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
            # (this prevents to resolve captcha on every form error)
            if($this->isReCaptchaEnabled()) {
                $rules = ['g-recaptcha-response' => 'recaptcha'];
            }

            # DO SECOND VALIDATION
            $validator = Validator::make($post, $rules);

            # VALIDATE ALL + CAPTCHA EXISTS
            if($validator->fails()) {
                throw new AjaxException(['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                    'type'    => 'danger',
                    'content' => Lang::get('martin.forms::lang.validation.recaptcha_error')
                ])]);
            }

            # REMOVE EXTRA FIELDS FROM STORED DATA
            unset($post['_token'], $post['g-recaptcha-response']);

            $record = new Record;
            $record->ip        = Request::getClientIp();
            $record->form_data = json_encode($post);
            $record->save();

            if($this->property('mail_enabled') && is_array($this->property('mail_recipients'))) {
                Mail::sendTo($this->property('mail_recipients'), 'martin.forms::mail.notification', [
                    'id'   => $record->id,
                    'data' => $post,
                    'ip'   => $record->ip,
                    'date' => $record->created_at
                ]);
            }

            return ['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                'type'    => 'success',
                'content' => $this->property('messages_success')
            ])];

        }

        private function isReCaptchaEnabled() {
            return ($this->property('recaptcha_enabled') && Settings::get('recaptcha_site_key') != '' && Settings::get('recaptcha_secret_key') != '');
        }

    }

?>