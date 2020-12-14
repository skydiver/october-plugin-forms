<?php

namespace Martin\Forms\Classes\Mails;

use Mail;
use Martin\Forms\Models\Record;
use System\Models\MailTemplate;
use Martin\Forms\Classes\BackendHelpers;

class AutoResponse implements Mailable
{
    private $properties;
    private $post;
    private $record;
    private $data;

    public function __construct(array $properties, array $post, Record $record)
    {
        $this->properties = $properties;
        $this->post = $post;
        $this->record = $record;
    }

    public function send()
    {
        // SET DEFAULT EMAIL DATA ARRAY
        $this->data = [
            'id'   => $this->record->id,
            'data' => $this->post,
            'ip'   => $this->record->ip,
            'date' => $this->record->created_at
        ];

        // CHECK FOR CUSTOM SUBJECT
        if (!empty($this->properties['mail_resp_subject'])) {
            $this->prepareCustomSubject();
        }

        // SET EMAIL PARAMETERS
        $response = isset($this->properties['mail_resp_field']) ? $this->properties['mail_resp_field'] : null;
        $to       = isset($this->post[$response]) ? $this->post[$response] : null;
        $name     = isset($this->properties['mail_resp_name']) ? $this->properties['mail_resp_name'] : null;
        $from     = isset($this->properties['mail_resp_from']) ? $this->properties['mail_resp_from'] : null;
        $subject  = isset($this->properties['mail_resp_subject']) ? $this->properties['mail_resp_subject'] : null;

        if (filter_var($to, FILTER_VALIDATE_EMAIL) && filter_var($from, FILTER_VALIDATE_EMAIL)) {
            // CUSTOM TEMPLATE
            $template = $this->getTemplate();

            // SEND AUTORESPONSE EMAIL
            Mail::sendTo($to, $template, $this->data, function ($message) use ($from, $name, $subject) {
                $message->from($from, $name);

                if (isset($subject)) {
                    $message->subject($subject);
                }
            });
        }
    }

    /**
     * Returns email template to use
     *
     * @return string
     */
    public function getTemplate(): string
    {
        return !empty($this->properties['mail_resp_template']) && MailTemplate::findOrMakeTemplate($this->properties['mail_resp_template']) ?
            $this->properties['mail_resp_template'] :
            'martin.forms::mail.autoresponse';
    }

    /**
     * Parse custom subject and modify using form variables and custom settings
     *
     * @return void
     */
    public function prepareCustomSubject()
    {
        // SET DATE FORMAT
        $dateFormat = $this->properties['emails_date_format'] ?? 'Y-m-d';

        // DATA TO REPLACE
        $id = $this->data['id'];
        $ip = $this->data['ip'];
        $date = date($dateFormat);

        // REPLACE RECORD TOKENS IN SUBJECT
        $this->properties['mail_resp_subject'] = BackendHelpers::replaceToken('record.id', $id, $this->properties['mail_resp_subject']);
        $this->properties['mail_resp_subject'] = BackendHelpers::replaceToken('record.ip', $ip, $this->properties['mail_resp_subject']);
        $this->properties['mail_resp_subject'] = BackendHelpers::replaceToken('record.date', $date, $this->properties['mail_resp_subject']);

        // REPLACE FORM FIELDS TOKENS IN SUBJECT
        foreach ($this->data['data'] as $key => $value) {
            if (!is_array($value)) {
                $token = 'form.' . $key;
                $this->properties['mail_resp_subject'] = BackendHelpers::replaceToken($token, $value, $this->properties['mail_resp_subject']);
            }
        }
    }
}
