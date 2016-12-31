<?php

    namespace Martin\Forms\Classes;

    use AjaxException, Lang, Mail, Request, Validator;
    use Cms\Classes\ComponentBase;
    use October\Rain\Support\Facades\Flash;
    use Martin\Forms\Models\Record;

    abstract class MagicForm extends ComponentBase {

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
            ];
        }

        public function onFormSubmit() {

            $rules = (array) $this->property('rules');
            $msgs  = (array) $this->property('rules_messages');

            $allow = $this->property('allowed_fields');

            if(is_array($allow) && !empty($allow)) {
                foreach($allow as $field) {
                    $post[$field] = post($field);
                }
            } else {
                $post = post();
            }

            $validator = Validator::make($post, $rules, $msgs);

            if($validator->fails()) {

                $messages = $validator->messages();
                Flash::error($messages->first());
                throw new AjaxException(['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm', [
                    'title'  => $this->property('messages_errors'),
                    'errors' => $messages->all()
                ])]);

            } else {

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

                Flash::success($this->property('messages_success'));
                return ['#' . $this->alias . '_forms_flash' => $this->renderPartial('@flash.htm')];

            }

        }

    }

?>