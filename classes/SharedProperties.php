<?php

namespace BlakeJones\MagicForms\Classes;

use Lang;

trait SharedProperties {

    public function defineProperties() {
        return [
            'group' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.group.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.group.description',
                'type'              => 'string',
                'showExternalParam' => false,
            ],
            'rules' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.rules.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.rules.description',
                'type'              => 'dictionary',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_validation',
                'showExternalParam' => false,
            ],
            'rules_messages' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.rules_messages.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.rules_messages.description',
                'type'              => 'dictionary',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_validation',
                'showExternalParam' => false,
            ],
            'custom_attributes' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.custom_attributes.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.custom_attributes.description',
                'type'              => 'dictionary',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_validation',
                'showExternalParam' => false,
            ],
            'messages_success' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.messages_success.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.messages_success.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_messages',
                'default'           => Lang::get('blakejones.magicforms::lang.components.shared.messages_success.default'),
                'showExternalParam' => false,
                'validation'        => ['required' => ['message' => Lang::get('blakejones.magicforms::lang.components.shared.validation_req')]]
            ],
            'messages_errors' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.messages_errors.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.messages_errors.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_messages',
                'default'           => Lang::get('blakejones.magicforms::lang.components.shared.messages_errors.default'),
                'showExternalParam' => false,
                'validation'        => ['required' => ['message' => Lang::get('blakejones.magicforms::lang.components.shared.validation_req')]]
            ],
            'messages_partial' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.messages_partial.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.messages_partial.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_messages',
                'showExternalParam' => false
            ],
            'mail_enabled' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_enabled.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_enabled.description',
                'type'              => 'checkbox',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_subject' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_subject.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_subject.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_recipients' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_recipients.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_recipients.description',
                'type'              => 'dictionary',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_bcc' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_bcc.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_bcc.description',
                'type'              => 'stringList',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_replyto' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_replyto.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_replyto.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_template' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_template.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_template.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_resp_enabled' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_resp_enabled.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_resp_enabled.description',
                'type'              => 'checkbox',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail_resp',
                'showExternalParam' => false
            ],
            'mail_resp_field' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_resp_field.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_resp_field.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail_resp',
                'showExternalParam' => false
            ],
            'mail_resp_from' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_resp_from.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_resp_from.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail_resp',
                'showExternalParam' => false
            ],
            'mail_resp_subject' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_resp_subject.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_resp_subject.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail_resp',
                'showExternalParam' => false
            ],
            'mail_resp_template' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.mail_template.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.mail_template.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_mail_resp',
                'showExternalParam' => false
            ],
            'reset_form' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.reset_form.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.reset_form.description',
                'type'              => 'checkbox',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'redirect' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.redirect.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.redirect.description',
                'type'              => 'string',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'inline_errors' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.inline_errors.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.inline_errors.description',
                'type'              => 'dropdown',
                'options'           => ['disabled' => 'blakejones.magicforms::lang.components.shared.inline_errors.disabled', 'display' => 'blakejones.magicforms::lang.components.shared.inline_errors.display', 'variable' => 'blakejones.magicforms::lang.components.shared.inline_errors.variable'],
                'default'           => 'disabled',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'js_on_success' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.js_on_success.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.js_on_success.description',
                'type'              => 'text',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'js_on_error' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.js_on_error.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.js_on_error.description',
                'type'              => 'text',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'allowed_fields' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.allowed_fields.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.allowed_fields.description',
                'type'              => 'stringList',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_security',
                'showExternalParam' => false
            ],
            'sanitize_data' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.sanitize_data.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.sanitize_data.description',
                'type'              => 'dropdown',
                'options'           => ['disabled' => 'blakejones.magicforms::lang.components.shared.sanitize_data.disabled', 'htmlspecialchars' => 'blakejones.magicforms::lang.components.shared.sanitize_data.htmlspecialchars'],
                'default'           => 'disabled',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_security',
                'showExternalParam' => false
            ],
            'anonymize_ip' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.anonymize_ip.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.anonymize_ip.description',
                'type'              => 'dropdown',
                'options'           => ['disabled' => 'blakejones.magicforms::lang.components.shared.anonymize_ip.disabled', 'partial' => 'blakejones.magicforms::lang.components.shared.anonymize_ip.partial', 'full' => 'blakejones.magicforms::lang.components.shared.anonymize_ip.full'],
                'default'           => 'disabled',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_security',
                'showExternalParam' => false
            ],
            'recaptcha_enabled' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.recaptcha_enabled.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.recaptcha_enabled.description',
                'type'              => 'checkbox',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_recaptcha',
                'showExternalParam' => false
            ],
            'recaptcha_theme' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.recaptcha_theme.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.recaptcha_theme.description',
                'type'              => 'dropdown',
                'options'           => ['light' => 'blakejones.magicforms::lang.components.shared.recaptcha_theme.light', 'dark' => 'blakejones.magicforms::lang.components.shared.recaptcha_theme.dark'],
                'default'           => 'light',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_recaptcha',
                'showExternalParam' => false
            ],
            'recaptcha_type' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.recaptcha_type.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.recaptcha_type.description',
                'type'              => 'dropdown',
                'options'           => ['image' => 'blakejones.magicforms::lang.components.shared.recaptcha_type.image', 'audio' => 'blakejones.magicforms::lang.components.shared.recaptcha_type.audio'],
                'default'           => 'image',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_recaptcha',
                'showExternalParam' => false
            ],
            'recaptcha_size' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.recaptcha_size.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.recaptcha_size.description',
                'type'              => 'dropdown',
                'options'           => [
                    'normal' => 'blakejones.magicforms::lang.components.shared.recaptcha_size.normal',
                    'compact' => 'blakejones.magicforms::lang.components.shared.recaptcha_size.compact',
                    'invisible' => 'blakejones.magicforms::lang.components.shared.recaptcha_size.invisible',
                ],
                'default'           => 'normal',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_recaptcha',
                'showExternalParam' => false
            ],
            'skip_database' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.skip_database.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.skip_database.description',
                'type'              => 'checkbox',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_advanced',
                'showExternalParam' => false
            ],
            'emails_date_format' => [
                'title'             => 'blakejones.magicforms::lang.components.shared.emails_date_format.title',
                'description'       => 'blakejones.magicforms::lang.components.shared.emails_date_format.description',
                'default'           => 'Y-m-d',
                'group'             => 'blakejones.magicforms::lang.components.shared.group_advanced',
                'showExternalParam' => false
            ],
        ];
    }

}

?>
