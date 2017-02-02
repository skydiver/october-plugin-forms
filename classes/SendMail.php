<?php

    namespace Martin\Forms\Classes;

    use Mail;

    class SendMail {

        public static function sendNotification($properties, $post, $record, $files) {

            if(is_array($properties['mail_recipients'])) {

                Mail::sendTo($properties['mail_recipients'], 'martin.forms::mail.notification', [
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

        public static function sendAutoResponse($to, $from, $subject, $post) {
            if(filter_var($to, FILTER_VALIDATE_EMAIL) && filter_var($from, FILTER_VALIDATE_EMAIL)) {
                Mail::sendTo($to, 'martin.forms::mail.autoresponse', $post, function($message) use ($from, $subject) {
                    $message->from($from);
                    $message->subject($subject);
                });
            }
        }

    }

?>