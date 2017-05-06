<?php

    namespace Martin\Forms\Classes;

    use Mail;
    use System\Models\MailTemplate;

    class SendMail {

        public static function sendNotification($properties, $post, $record, $files) {

            if(is_array($properties['mail_recipients'])) {

                # CUSTOM TEMPLATE
                $template = MailTemplate::where('code', $properties['mail_template'])->count() ? $properties['mail_template'] : 'martin.forms::mail.notification';

                Mail::sendTo($properties['mail_recipients'], $template, [
                    'id'   => $record->id,
                    'data' => $post,
                    'ip'   => $record->ip,
                    'date' => $record->created_at
                ], function($message) use ($properties, $files) {

                    $message->subject($properties['mail_subject']);

                    if(isset($properties['mail_uploads']) && $properties['mail_uploads'] && !empty($files)) {
                        foreach($files as $file) {
                            $message->attach($file->getLocalPath(), ['as' => $file->getFilename()]);
                        }
                    }

                });

            }

        }

        public static function sendAutoResponse($properties, $post) {

            $to      = $post[$properties['mail_resp_field']];
            $from    = $properties['mail_resp_from'];
            $subject = $properties['mail_resp_subject'];

            if(filter_var($to, FILTER_VALIDATE_EMAIL) && filter_var($from, FILTER_VALIDATE_EMAIL)) {

                # CUSTOM TEMPLATE
                $template = isset($properties['mail_resp_template']) && $properties['mail_resp_template'] != '' && MailTemplate::where('code', $properties['mail_resp_template'])->count() ? $properties['mail_resp_template'] : 'martin.forms::mail.autoresponse';

                Mail::sendTo($to, $template, $post, function($message) use ($from, $subject) {
                    $message->from($from);
                    $message->subject($subject);
                });

            }

        }

    }

?>