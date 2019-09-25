<?php

    return [

        'plugin' => [
            'name'        => '表单',
            'description' => '管理网站所有提交表单内容'
        ],

        'menu' => [
            'label'    => '表单',
            'records'  => ['label' => '记录'],
            'exports'  => ['label' => '导出'],
            'settings' => '设置插件参数',
        ],

        'controllers' => [
            'records' => [
                'title'      => '查看记录',
                'view_title' => '记录详情',
                'error'      => '未找到该记录',
                'deleted'    => '记录删除成功',
                'columns'    => [
                    'id'         => '记录 ID',
                    'group'      => '组',
                    'ip'         => 'IP 地址',
                    'form_data'  => '记录字段',
                    'files'      => '附件',
                    'created_at' => '创建于',
                ],
                'buttons' => [
                    'read'       => '标记为已读',
                    'unread'     => '标记为未读',
                    'gdpr_clean' => 'GDPR 清理',
                ],
                'alerts' => [
                    'gdpr_confirm' => '你确定需要清除旧数据吗？\n此操作无法撤销！',
                    'gdpr_success' => 'GDPR 清理执行成功',
                    'gdpr_perms'   => '没有该权限',
                ],
            ],
            'exports' => [
                'title'                => '导出记录',
                'breadcrumb'           => '导出',
                'filter_section'       => '1. 过滤记录',
                'filter_type'          => '导出所有记录',
                'filter_groups'        => '组',
                'filter_date_after'    => '开始日期',
                'filter_date_before'   => '结束日期',
                'options_section'      => '2. 附加选项',
                'options_metadata'     => '包含元数据',
                'options_metadata_com' => '导出包含元数据的记录（记录 ID，组，IP，创建时间）',
                'options_deleted'      => '包含已删除的记录',
            ],
        ],

        'components' => [
            'generic_form' => [
                'name'        => '生成 AJAX 表单',
                'description' => '默认会创建一个常规表单；你可以使用自定义字段来覆盖组件 HTML。',
            ],
            'upload_form' => [
                'name'        => 'AJAX 上传表单 [BETA]',
                'description' => 'Shows how to implement file uploads on your form.',
            ],
            'empty_form' => [
                'name'        => '空 AJAX 表单',
                'description' => 'Create a empty template for your custom form; override component HTML.',
            ],
            'shared' => [
                'csrf_error'        => 'Form session expired! Please refresh the page.',
                'recaptcha_warn'    => '警告：reCAPTCHA 配置不正确。请到 后台 > 设置 > CMS > 表单 进行配置。',
                'group_validation'  => '表单验证',
                'group_messages'    => '闪现消息',
                'group_mail'        => '通知设置',
                'group_mail_resp'   => '自动回复设置',
                'group_settings'    => '更多设置',
                'group_security'    => '安全',
                'group_recaptcha'   => 'reCAPTCHA 设置',
                'group_advanced'    => '高级设置',
                'group_uploader'    => '上传设置',
                'validation_req'    => '该属性为必填项',
                'group'             => ['title' => '组'              , 'description' => 'Organize your forms with a custom group name. This option is useful when exporting data.'],
                'rules'             => ['title' => '条件'              , 'description' => 'Set your own rules using Laravel validation'],
                'rules_messages'    => ['title' => '条件消息'     , 'description' => 'Use your own rules messages using Laravel validation'],
                'custom_attributes' => ['title' => '自定义属性'  , 'description' => 'Use your own custom attributes using Laravel validation'],
                'messages_success'  => ['title' => '成功'            , 'description' => 'Message when the form is successfully submited', 'default' => 'Your form was successfully submitted'  ],
                'messages_errors'   => ['title' => '错误'             , 'description' => 'Message when the form contains errors'         , 'default' => 'There were errors with your submission'],
                'messages_partial'  => ['title' => '使用自定义 Partial' , 'description' => 'Override flash messages with your custom partial inside your theme'],
                'mail_enabled'      => ['title' => '发送通知' , 'description' => 'Send mail notifications on every form submited'],
                'mail_subject'      => ['title' => '主题'            , 'description' => 'Override default email subject'],
                'mail_recipients'   => ['title' => '收件人'         , 'description' => 'Specify email recipients (add one address per line)'],
                'mail_bcc'          => ['title' => '密送'                , 'description' => 'Send blind carbon copy to email recipients (add one address per line)'],
                'mail_replyto'      => ['title' => '回复邮件字段', 'description' => 'Form field containing the email address of sender to be used as "ReplyTo"'],
                'mail_template'     => ['title' => '邮件模板'      , 'description' => 'Use custom mail template. Specify template code like "martin.forms::mail.notification" (found on Settings, Mail templates). Leave empty to use default.'],
                'mail_uploads'      => ['title' => '发送上传文件'       , 'description' => 'Send uploads as attachements'],
                'mail_resp_enabled' => ['title' => '发送自动回复' , 'description' => 'Send an auto-response email to the person submitting the form'],
                'mail_resp_field'   => ['title' => '邮件字段'        , 'description' => 'Form field containing the email address of the recipient of auto-response'],
                'mail_resp_from'    => ['title' => '发件人地址'     , 'description' => 'Email address of auto-response email sender (e.g. noreply@yourcompany.com)'],
                'mail_resp_subject' => ['title' => '主题'            , 'description' => 'Override default email subject'],
                'reset_form'        => ['title' => '重置表单'         , 'description' => 'Reset form after successfully submit'],
                'redirect'          => ['title' => '成功后重定向', 'description' => 'Redirect to URL on successfully submit.'],
                'inline_errors'     => ['title' => '内联错误'      , 'description' => 'Display inline errors. This requires extra code, check documentation for more info.', 'disabled' => 'Disabled', 'display' => 'Display errors', 'variable' => 'JS variable'],
                'js_on_success'     => ['title' => '成功回调 JS'      , 'description' => 'Execute custom JavaScript code when the form was successfully submitted. Don\'t use script tags.'],
                'js_on_error'       => ['title' => '错误回调 JS'        , 'description' => 'Execute custom JavaScript code when the form doesn\'t validate. Don\'t use script tags.'],
                'allowed_fields'    => ['title' => '允许的字段'     , 'description' => 'Specify which fields should be filtered and stored (add one field name per line)'],
                'anonymize_ip'      => ['title' => '匿名 IP'       , 'description' => 'Don\'t store IP address', 'full' => 'Full', 'partial' => 'Partial', 'disabled' => 'Disabled'],
                'sanitize_data'     => ['title' => '清理表单数据' , 'description' => 'Sanitize form data and save result on database', 'disabled' => 'Disabled', 'htmlspecialchars' => 'Use htmlspecialchars'],
                'recaptcha_enabled' => ['title' => '启用 reCAPTCHA'   , 'description' => 'Insert the reCAPTCHA widget on your form'],
                'recaptcha_theme'   => ['title' => '主题'              , 'description' => 'The color theme of the widget', 'light'  => 'Light' , 'dark'    => 'Dark'],
                'recaptcha_type'    => ['title' => '类型'               , 'description' => 'The type of CAPTCHA to serve' , 'image'  => 'Image' , 'audio'   => 'Audio'],
                'recaptcha_size'    => ['title' => '尺寸'               , 'description' => 'The size of the widget'       , 'normal' => 'Normal', 'compact' => 'Compact'],
                'skip_database'     => ['title' => '跳过数据库'            , 'description' => 'Don\'t store this form on database. Useful if you want to use events with your custom plugin.'],
                'uploader_enable'   => ['title' => '允许上传'      , 'description' => 'Enable files uploading. You need to explicitly enable this option as a security measure.'],
                'uploader_multi'    => ['title' => '多文件'     , 'description' => 'Allow multipe files uploads'],
                'uploader_pholder'  => ['title' => '占位文字'   , 'description' => 'Wording to display when no file is uploaded', 'default' => 'Click or drag files to upload'],
                'uploader_maxsize'  => ['title' => '文件大小限制'    , 'description' => 'The maximum file size that can be uploaded in megabytes'],
                'uploader_types'    => ['title' => '允许的文件类型' , 'description' => 'Allowed file extensions or star (*) for all types (add one extension per line)'],
                'uploader_remFile'  => ['title' => '移除时的弹出文字'  , 'description' => 'Wording to display in the popup when you remove file', 'default' => 'Are you sure ?'],
            ]
        ],

        'settings' => [
            'tabs'                    => ['general' => '常规', 'recaptcha' => 'reCAPTCHA', 'gdpr' => 'GDPR'],
            'section_flash_messages'  => '闪现信息',
            'global_messages_success' => ['label' => '全局成功消息', 'comment' => '（此项设置可以被组件覆盖）', 'default' => 'Your form was successfully submitted'],
            'global_messages_errors'  => ['label' => '全局错误消息' , 'comment' => '（此项设置可以被组件覆盖）', 'default' => 'There were errors with your submission'],
            'plugin_help'             => '你可以在 Github 仓库中查看插件文档：',
            'global_hide_button'      => '隐藏导航项',
            'global_hide_button_desc' => '如果要在你的定制插件中使用事件',
            'section_recaptcha'       => 'reCAPTCHA 设置',
            'recaptcha_site_key'      => 'Site key',
            'recaptcha_secret_key'    => 'Secret key',
            'gdpr_help_title'         => '提示信息',
            'gdpr_help_comment'       => '根据欧洲新的 GDPR 法案，你不能无限期地保存用户数据，根据你的需求，在一段时间后，需要需要清除它们。',
            'gdpr_enable'             => '启用 GDPR',
            'gdpr_days'               => '保留数据最多不超过 X 天',
        ],

        'permissions' => [
            'tab'             => '联系表单',
            'access_records'  => '访问已保存的表单数据',
            'access_exports'  => '访问导出功能，导出已保存的数据',
            'access_settings' => '访问插件配置',
            'gdpr_cleanup'    => '执行 GDPR 数据清理',
        ],

        'mails' => [
            'form_notification' => ['description' => '表单提交时通知'],
            'form_autoresponse' => ['description' => '表单提交时自动答复'],
        ],

        'validation' => [
            'recaptcha_error' => 'Cannot validate reCAPTCHA field'
        ],

        'classes' => [
            'GDPR' => [
                'alert_gdpr_disabled' => 'GDPR 选项已禁用',
                'alert_invalid_gdpr'  => '无效的 GDPR 天数设置',
            ]
        ]

    ];

?>
