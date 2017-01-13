<?php

    namespace Martin\Forms\Classes;

    use Mail;

    class SendMail {

        public static function sendNotification($recipients, $record, $post) {
            if(is_array($recipients)) {
                Mail::sendTo($recipients, 'martin.forms::mail.notification', [
                    'id'   => $record->id,
                    'data' => $post,
                    'ip'   => $record->ip,
                    'date' => $record->created_at
                ]);
            }
        }

        public static function sendAutoResponse($to, $from, $post) {
            if(filter_var($to, FILTER_VALIDATE_EMAIL) && filter_var($from, FILTER_VALIDATE_EMAIL)) {
                Mail::sendTo($to, 'martin.forms::mail.autoresponse', $post, function($message) use ($from) {
                    $message->from($from);
                });
            }
        }

    }

?>