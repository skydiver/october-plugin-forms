<?php

    return [

        'plugin' => [
            'name'        => 'Magic Forms',
            'description' => 'Create easy AJAX forms'
        ],

        'menu' => [
            'label'    => 'Magic Forms',
            'records'  => ['label' => 'Records'],
            'exports'  => ['label' => 'Export'],
            'settings' => 'Configure plugin parameters',
        ],

        'controllers' => [
            'records' => [
                'title'      => 'View Records',
                'view_title' => 'Record Details',
                'error'      => 'Record not found',
                'deleted'    => 'Record deleted successfully',
                'columns'    => [
                    'id'         => 'Record ID',
                    'group'      => 'Group',
                    'ip'         => 'IP Address',
                    'form_data'  => 'Stored Fields',
                    'files'      => 'Attached Files',
                    'created_at' => 'Created',
                ],
                'buttons' => [
                    'read'       => 'Mark as Read',
                    'unread'     => 'Mark as Unread',
                    'gdpr_clean' => 'GDPR Clean',
                ],
                'alerts' => [
                    'gdpr_confirm' => "Are you sure you want to clean old records?\nThis action cannot be undone!",
                    'gdpr_success' => 'GDPR cleanup was executed successfully',
                    'gdpr_perms'   => 'You don\'t have permission to this feature',
                ],
            ],
            'exports' => [
                'title'                 => 'Export Records',
                'breadcrumb'            => 'Export',
                'filter_section'        => '1. Filter records',
                'filter_type'           => 'Export all records',
                'filter_groups'         => 'Groups',
                'filter_date_after'     => 'Date after',
                'filter_date_before'    => 'Date before',
                'options_section'       => '2. Extra options',
                'options_metadata'      => 'Include metadata',
                'options_metadata_com'  => 'Export records with metadata (Record ID, group, IP, created date)',
                'options_deleted'       => 'Include deleted records',
                'options_delimiter'     => 'Use alternative delimiter',
                'options_delimiter_com' => 'Use semicolon as delimiter',
                'options_utf'           => 'Encode in UTF8',
                'options_utf_com'       => 'Encode your csv in UTF-8 to support non standard characters',
            ],
        ],

        'components' => [
            'generic_form' => [
                'name'        => 'Generic AJAX Form',
                'description' => 'By default renders a generic form; override component HTML with your custom fields.',
            ],
            'upload_form' => [
                'name'        => 'Upload AJAX Form [BETA]',
                'description' => 'Shows how to implement file uploads on your form.',
            ],
            'empty_form' => [
                'name'        => 'Empty AJAX Form',
                'description' => 'Create a empty template for your custom form; override component HTML.',
            ],
            'shared' => [
                'csrf_error'        => 'Form session expired! Please refresh the page.',
                'recaptcha_warn'    => 'Warning: reCAPTCHA is not properly configured. Please, goto Backend > Settings > CMS > Magic Forms and configure.',
                'group_validation'  => 'Form Validation',
                'group_messages'    => 'Flash Messages',
                'group_mail'        => 'Notifications Settings',
                'group_mail_resp'   => 'Auto-Response Settings',
                'group_settings'    => 'More Settings',
                'group_security'    => 'Security',
                'group_recaptcha'   => 'reCAPTCHA Settings',
                'group_advanced'    => 'Advanced Settings',
                'group_uploader'    => 'Uploader Settings',
                'validation_req'    => 'The property is required',
                'group'             => ['title' => 'Group'              , 'description' => 'Organize your forms with a custom group name. This option is useful when exporting data.'],
                'rules'             => ['title' => 'Rules'              , 'description' => 'Set your own rules using Laravel validation'],
                'rules_messages'    => ['title' => 'Rules Messages'     , 'description' => 'Use your own rules messages using Laravel validation'],
                'custom_attributes' => ['title' => 'Custom Attributes'  , 'description' => 'Use your own custom attributes using Laravel validation'],
                'messages_success'  => ['title' => 'Success'            , 'description' => 'Message when the form is successfully submited', 'default' => 'Your form was successfully submitted'  ],
                'messages_errors'   => ['title' => 'Errors'             , 'description' => 'Message when the form contains errors'         , 'default' => 'There were errors with your submission'],
                'messages_partial'  => ['title' => 'Use Custom Partial' , 'description' => 'Override flash messages with your custom partial inside your theme'],
                'mail_enabled'      => ['title' => 'Send Notifications' , 'description' => 'Send mail notifications on every form submited'],
                'mail_subject'      => ['title' => 'Subject'            , 'description' => 'Override default email subject'],
                'mail_recipients'   => ['title' => 'Recipients'         , 'description' => 'Specify email recipients (add one address per line)'],
                'mail_bcc'          => ['title' => 'BCC'                , 'description' => 'Send blind carbon copy to email recipients (add one address per line)'],
                'mail_replyto'      => ['title' => 'ReplyTo Email Field', 'description' => 'Form field containing the email address of sender to be used as "ReplyTo"'],
                'mail_template'     => ['title' => 'Mail Template'      , 'description' => 'Use custom mail template. Specify template code like "martin.forms::mail.notification" (found on Settings, Mail templates). Leave empty to use default.'],
                'mail_uploads'      => ['title' => 'Send Uploads'       , 'description' => 'Send uploads as attachements'],
                'mail_resp_enabled' => ['title' => 'Send Auto-Response' , 'description' => 'Send an auto-response email to the person submitting the form'],
                'mail_resp_field'   => ['title' => 'Email Field'        , 'description' => 'Form field containing the email address of the recipient of auto-response'],
                'mail_resp_from'    => ['title' => 'Sender Address'     , 'description' => 'Email address of auto-response email sender (e.g. noreply@yourcompany.com)'],
                'mail_resp_subject' => ['title' => 'Subject'            , 'description' => 'Override default email subject'],
                'reset_form'        => ['title' => 'Reset Form'         , 'description' => 'Reset form after successfully submit'],
                'redirect'          => ['title' => 'Redirect on Success', 'description' => 'Redirect to URL on successfully submit.'],
                'inline_errors'     => ['title' => 'Inline errors'      , 'description' => 'Display inline errors. This requires extra code, check documentation for more info.', 'disabled' => 'Disabled', 'display' => 'Display errors', 'variable' => 'JS variable'],
                'js_on_success'     => ['title' => 'JS on Success'      , 'description' => 'Execute custom JavaScript code when the form was successfully submitted. Don\'t use script tags.'],
                'js_on_error'       => ['title' => 'JS on Error'        , 'description' => 'Execute custom JavaScript code when the form doesn\'t validate. Don\'t use script tags.'],
                'allowed_fields'    => ['title' => 'Allowed Fields'     , 'description' => 'Specify which fields should be filtered and stored (add one field name per line)'],
                'anonymize_ip'      => ['title' => 'Anonymize IP'       , 'description' => 'Don\'t store IP address', 'full' => 'Full', 'partial' => 'Partial', 'disabled' => 'Disabled'],
                'sanitize_data'     => ['title' => 'Sanitize form data' , 'description' => 'Sanitize form data and save result on database', 'disabled' => 'Disabled', 'htmlspecialchars' => 'Use htmlspecialchars'],
                'recaptcha_enabled' => ['title' => 'Enable reCAPTCHA'   , 'description' => 'Insert the reCAPTCHA widget on your form'],
                'recaptcha_theme'   => ['title' => 'Theme'              , 'description' => 'The color theme of the widget', 'light'  => 'Light' , 'dark'    => 'Dark'],
                'recaptcha_type'    => ['title' => 'Type'               , 'description' => 'The type of CAPTCHA to serve' , 'image'  => 'Image' , 'audio'   => 'Audio'],
                'recaptcha_size'    => ['title' => 'Size'               , 'description' => 'The size of the widget'       , 'normal' => 'Normal', 'compact' => 'Compact'],
                'skip_database'     => ['title' => 'Skip DB'            , 'description' => 'Don\'t store this form on database. Useful if you want to use events with your custom plugin.'],
                'uploader_enable'   => ['title' => 'Allow uploads'      , 'description' => 'Enable files uploading. You need to explicitly enable this option as a security measure.'],
                'uploader_multi'    => ['title' => 'Multiple files'     , 'description' => 'Allow multipe files uploads'],
                'uploader_pholder'  => ['title' => 'Placeholder text'   , 'description' => 'Wording to display when no file is uploaded', 'default' => 'Click or drag files to upload'],
                'uploader_maxsize'  => ['title' => 'File size limit'    , 'description' => 'The maximum file size that can be uploaded in megabytes'],
                'uploader_types'    => ['title' => 'Allowed file types' , 'description' => 'Allowed file extensions or star (*) for all types (add one extension per line)'],
                'uploader_remFile'  => ['title' => 'Remove Popup text'  , 'description' => 'Wording to display in the popup when you remove file', 'default' => 'Are you sure ?'],
            ]
        ],

        'settings' => [
            'tabs'                    => ['general' => 'General', 'recaptcha' => 'reCAPTCHA', 'gdpr' => 'GDPR'],
            'section_flash_messages'  => 'Flash Messages',
            'global_messages_success' => ['label' => 'Global Success Message', 'comment' => '(This setting can be overridden from the component)', 'default' => 'Your form was successfully submitted'],
            'global_messages_errors'  => ['label' => 'Global Errors Message' , 'comment' => '(This setting can be overridden from the component)', 'default' => 'There were errors with your submission'],
            'plugin_help'             => 'You can access plugin documentation at GitHub repo:',
            'global_hide_button'      => 'Hide navigation item',
            'global_hide_button_desc' => 'Useful if you want to use events with your custom plugin.',
            'section_recaptcha'       => 'reCAPTCHA Settings',
            'recaptcha_site_key'      => 'Site key',
            'recaptcha_secret_key'    => 'Secret key',
            'gdpr_help_title'         => 'Information',
            'gdpr_help_comment'       => 'New GDPR law in Europe, you can\'t keep records undefinitely, need to clear them after a certain period of time depending on your needs',
            'gdpr_enable'             => 'Enable GDPR',
            'gdpr_days'               => 'Keep records for a maximum of X days',
        ],

        'permissions' => [
            'tab'             => 'Magic Forms',
            'access_records'  => 'Access stored forms data',
            'access_exports'  => 'Access to export stored data',
            'access_settings' => 'Access module configuration',
            'gdpr_cleanup'    => 'Perform GDPR database cleanup',
        ],

        'mails' => [
            'form_notification' => ['description' => 'Notify when a form is submited'],
            'form_autoresponse' => ['description' => 'Auto-Response when a form is submited'],
        ],

        'validation' => [
            'recaptcha_error' => 'Cannot validate reCAPTCHA field'
        ],

        'classes' => [
            'GDPR' => [
                'alert_gdpr_disabled' => 'GDPR options are disabled',
                'alert_invalid_gdpr'  => 'Invalid GDPR days setting value',
            ]
        ]

    ];

?>
