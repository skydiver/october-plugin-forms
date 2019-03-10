<?php

namespace Martin\Forms\Classes;

use Mail;
use System\Models\MailTemplate;
use Martin\Forms\Classes\BackendHelpers;

class SendMail {

    public static function sendNotification($properties, $post, $record, $files) {

        // CHECK IF THERE IS AT LEAST ONE MAIL ADDRESS
        if (!isset($properties['mail_recipients'])) {
            $properties['mail_recipients'] = false;
        }

        // CHECK IF THERE IS AT LEAST ONE MAIL ADDRESS
        if (!isset($properties['mail_bcc'])) {
            $properties['mail_bcc'] = false;
        }

        if (is_array($properties['mail_recipients']) || is_array($properties['mail_bcc'])) {

            // CUSTOM TEMPLATE
            $template = isset($properties['mail_template']) && $properties['mail_template'] != '' && MailTemplate::where('code', $properties['mail_template'])->count() ? $properties['mail_template'] : 'martin.forms::mail.notification';

            $data = [
                'id'   => $record->id,
                'data' => $post,
                'ip'   => $record->ip,
                'date' => $record->created_at
            ];

            // CHECK FOR CUSTOM SUBJECT
            if (isset($properties['mail_subject'])) {

                // REPLACE RECORD TOKENS IN SUBJECT
                $properties['mail_subject'] = BackendHelpers::replaceToken('record.id', $data['id'], $properties['mail_subject']);
                $properties['mail_subject'] = BackendHelpers::replaceToken('record.ip', $data['ip'], $properties['mail_subject']);
                $properties['mail_subject'] = BackendHelpers::replaceToken('record.date', date('Y-m-d'), $properties['mail_subject']);

                // REPLACE FORM FIELDS TOKENS IN SUBJECT
                foreach ($data['data'] as $key => $value) {
                    if (!is_array($value)) {
                        $properties['mail_subject'] = BackendHelpers::replaceToken('form.'.$key, $value, $properties['mail_subject']);
                    }
                }

                // SET CUSTOM SUBJECT
                $data['subject'] = $properties['mail_subject'];

            }

            // SEND NOTIFICATION EMAIL
            Mail::sendTo($properties['mail_recipients'], $template, $data, function ($message) use ($properties, $post, $files) {

                // SEND BLIND CARBON COPY
                if (isset($properties['mail_bcc']) && is_array($properties['mail_bcc'])) {
                    $message->bcc($properties['mail_bcc']);
                }

                // USE CUSTOM SUBJECT
                if (isset($properties['mail_subject'])) {
                    $message->subject($properties['mail_subject']);
                }

                // ADD REPLY TO ADDRESS
                if (isset($properties['mail_replyto']) && isset($post[$properties['mail_replyto']])) {
                    $message->replyTo($post[$properties['mail_replyto']]);
                }

                // ADD UPLOADS
                if (isset($properties['mail_uploads']) && $properties['mail_uploads'] && !empty($files)) {
                    foreach ($files as $file) {
                        $message->attach($file->getLocalPath(), ['as' => $file->getFilename()]);
                    }
                }

            });

        }

    }

    public static function sendAutoResponse($properties, $post, $record) {
        
        $data = [
            'id'   => $record->id,
            'data' => $post,
            'ip'   => $record->ip,
            'date' => $record->created_at
        ];

        // CHECK FOR CUSTOM SUBJECT
        if (isset($properties['mail_resp_subject'])) {

            // REPLACE RECORD TOKENS IN SUBJECT
            $properties['mail_resp_subject'] = BackendHelpers::replaceToken('record.id', $data['id'], $properties['mail_resp_subject']);
            $properties['mail_resp_subject'] = BackendHelpers::replaceToken('record.ip', $data['ip'], $properties['mail_resp_subject']);
            $properties['mail_resp_subject'] = BackendHelpers::replaceToken('record.date', date('Y-m-d'), $properties['mail_resp_subject']);

            // REPLACE FORM FIELDS TOKENS IN SUBJECT
            foreach ($data['data'] as $key => $value) {
                if (!is_array($value)) {
                    $properties['mail_resp_subject'] = BackendHelpers::replaceToken('form.'.$key, $value, $properties['mail_resp_subject']);
                }
            }
        }

        $response = isset($properties['mail_resp_field']) ? $properties['mail_resp_field'] : null;
        $to       = isset($post[$response]) ? $post[$response] : null;
        $from     = isset($properties['mail_resp_from']) ? $properties['mail_resp_from'] : null;
        $subject  = isset($properties['mail_resp_subject']) ? $properties['mail_resp_subject'] : null;

        if (filter_var($to, FILTER_VALIDATE_EMAIL) && filter_var($from, FILTER_VALIDATE_EMAIL)) {

            // CUSTOM TEMPLATE
            $template = isset($properties['mail_resp_template']) && $properties['mail_resp_template'] != '' && MailTemplate::where('code', $properties['mail_resp_template'])->count() ? $properties['mail_resp_template'] : 'martin.forms::mail.autoresponse';

            Mail::sendTo($to, $template, [
                    'id'   => $record->id,
                    'data' => $post,
                    'ip'   => $record->ip,
                    'date' => $record->created_at
                ], function ($message) use ($from, $subject) {
                    $message->from($from);
                    if (isset($subject)) {
                        $message->subject($subject);
                    }
                }
            );

        }

    }

}

?>
