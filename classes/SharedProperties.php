<?php

namespace Martin\Forms\Classes;

use Lang;

trait SharedProperties {

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
            'custom_attributes' => [
                'title'             => 'martin.forms::lang.components.shared.custom_attributes.title',
                'description'       => 'martin.forms::lang.components.shared.custom_attributes.description',
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
            'messages_partial' => [
                'title'             => 'martin.forms::lang.components.shared.messages_partial.title',
                'description'       => 'martin.forms::lang.components.shared.messages_partial.description',
                'type'              => 'string',
                'group'             => 'martin.forms::lang.components.shared.group_messages',
                'showExternalParam' => false
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
            'mail_bcc' => [
                'title'             => 'martin.forms::lang.components.shared.mail_bcc.title',
                'description'       => 'martin.forms::lang.components.shared.mail_bcc.description',
                'type'              => 'stringList',
                'group'             => 'martin.forms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_replyto' => [
                'title'             => 'martin.forms::lang.components.shared.mail_replyto.title',
                'description'       => 'martin.forms::lang.components.shared.mail_replyto.description',
                'type'              => 'string',
                'group'             => 'martin.forms::lang.components.shared.group_mail',
                'showExternalParam' => false
            ],
            'mail_template' => [
                'title'             => 'martin.forms::lang.components.shared.mail_template.title',
                'description'       => 'martin.forms::lang.components.shared.mail_template.description',
                'type'              => 'string',
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
            'mail_resp_template' => [
                'title'             => 'martin.forms::lang.components.shared.mail_template.title',
                'description'       => 'martin.forms::lang.components.shared.mail_template.description',
                'type'              => 'string',
                'group'             => 'martin.forms::lang.components.shared.group_mail_resp',
                'showExternalParam' => false
            ],
            'reset_form' => [
                'title'             => 'martin.forms::lang.components.shared.reset_form.title',
                'description'       => 'martin.forms::lang.components.shared.reset_form.description',
                'type'              => 'checkbox',
                'group'             => 'martin.forms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'redirect' => [
                'title'             => 'martin.forms::lang.components.shared.redirect.title',
                'description'       => 'martin.forms::lang.components.shared.redirect.description',
                'type'              => 'string',
                'group'             => 'martin.forms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'inline_errors' => [
                'title'             => 'martin.forms::lang.components.shared.inline_errors.title',
                'description'       => 'martin.forms::lang.components.shared.inline_errors.description',
                'type'              => 'dropdown',
                'options'           => ['disabled' => 'martin.forms::lang.components.shared.inline_errors.disabled', 'display' => 'martin.forms::lang.components.shared.inline_errors.display', 'variable' => 'martin.forms::lang.components.shared.inline_errors.variable'],
                'default'           => 'disabled',
                'group'             => 'martin.forms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'js_on_success' => [
                'title'             => 'martin.forms::lang.components.shared.js_on_success.title',
                'description'       => 'martin.forms::lang.components.shared.js_on_success.description',
                'type'              => 'text',
                'group'             => 'martin.forms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'js_on_error' => [
                'title'             => 'martin.forms::lang.components.shared.js_on_error.title',
                'description'       => 'martin.forms::lang.components.shared.js_on_error.description',
                'type'              => 'text',
                'group'             => 'martin.forms::lang.components.shared.group_settings',
                'showExternalParam' => false
            ],
            'allowed_fields' => [
                'title'             => 'martin.forms::lang.components.shared.allowed_fields.title',
                'description'       => 'martin.forms::lang.components.shared.allowed_fields.description',
                'type'              => 'stringList',
                'group'             => 'martin.forms::lang.components.shared.group_security',
                'showExternalParam' => false
            ],
            'sanitize_data' => [
                'title'             => 'martin.forms::lang.components.shared.sanitize_data.title',
                'description'       => 'martin.forms::lang.components.shared.sanitize_data.description',
                'type'              => 'dropdown',
                'options'           => ['disabled' => 'martin.forms::lang.components.shared.sanitize_data.disabled', 'htmlspecialchars' => 'martin.forms::lang.components.shared.sanitize_data.htmlspecialchars'],
                'default'           => 'disabled',
                'group'             => 'martin.forms::lang.components.shared.group_security',
                'showExternalParam' => false
            ],
            'anonymize_ip' => [
                'title'             => 'martin.forms::lang.components.shared.anonymize_ip.title',
                'description'       => 'martin.forms::lang.components.shared.anonymize_ip.description',
                'type'              => 'dropdown',
                'options'           => ['disabled' => 'martin.forms::lang.components.shared.anonymize_ip.disabled', 'partial' => 'martin.forms::lang.components.shared.anonymize_ip.partial', 'full' => 'martin.forms::lang.components.shared.anonymize_ip.full'],
                'default'           => 'disabled',
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
            'skip_database' => [
                'title'             => 'martin.forms::lang.components.shared.skip_database.title',
                'description'       => 'martin.forms::lang.components.shared.skip_database.description',
                'type'              => 'checkbox',
                'group'             => 'martin.forms::lang.components.shared.group_advanced',
                'showExternalParam' => false
            ],
        ];
    }

}

?>