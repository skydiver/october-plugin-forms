<?php

    return [

        'plugin' => [
            'name'        => 'Magic Forms',
            'description' => 'Kolay AJAX formları oluşturun'
        ],

        'menu' => [
            'label'    => 'Sihirli Formlar',
            'records'  => ['label' => 'Kayıtlar'],
            'exports'  => ['label' => 'Dışa Aktar'],
            'settings' => 'Eklenti parametrelerini yapılandır',
        ],

        'controllers' => [
            'records' => [
                'title'      => 'Kayıtları Görüntüle',
                'view_title' => 'Kayıt Ayrıntıları',
                'error'      => 'Kayıt bulunamadı',
                'deleted'    => 'Kayıt başarıyla silindi',
                'columns'    => [
                    'id'         => 'Kayıt Kimliği',
                    'group'      => 'Grup',
                    'ip'         => 'IP Adresi',
                    'form_data'  => 'Kayıtlı Alanlar',
                    'created_at' => 'Oluşturuldu',
                ],
            ],
            'exports' => [
                'title'                => 'Dışa Aktarma Kayıtları',
                'breadcrumb'           => 'Dışa Aktarma',
                'filter_section'       => '1. Filtre kayıtları',
                'filter_type'          => 'Tüm kayıtları dışa aktar',
                'filter_groups'        => 'Gruplar',
                'filter_date_after'    => 'Tarihinden sonra',
                'filter_date_before'   => 'Tarihinden önce',
                'options_section'      => '2. Ekstra seçenekler',
                'options_metadata'     => 'Meta verileri içe aktar',
                'options_metadata_com' => 'Meta verilerle kayıtları dışa aktarmak (Kayıt Kimliği, grup, IP, oluşturma tarihi)',
                'options_deleted'      => 'Silinmiş kayıtları dahil et',
            ],
        ],

        'components' => [
            'generic_form' => [
                'name'        => 'Genel AJAX Formu',
                'description' => 'Varsayılan olarak, genel bir form oluşturur; Özel alanlarınızla, HTML bileşenlerini geçersiz kılar.',
            ],
            'empty_form' => [
                'name'        => 'Boş AJAX Formu',
                'description' => 'Özel formunuz için boş bir şablon oluşturun; HTML bileşenlerini geçersiz kıl.',
            ],
            'shared' => [
                'csrf_error'        => 'Form oturumu doldu! Lütfen sayfayı yenileyin.',
                'recaptcha_warn'    => 'Uyarı: reCAPTCHA düzgün şekilde yapılandırılmadı',
                'group_validation'  => 'Form Doğrulaması',
                'group_messages'    => 'Flash Mesajları',
                'group_security'    => 'Güvenlik',
                'group_mail'        => 'Posta Ayarları',
                'group_recaptcha'   => 'ReCAPTCHA Ayarları',
                'validation_req'    => 'Özellikler gereklidir',
                'group'             => ['title' => 'Grup'                , 'description' => 'Formlarınızı özel bir grup adı ile düzenleyin. Bu seçenek, veri aktarırken yararlıdır.'],
                'rules'             => ['title' => 'Kurallar'            , 'description' => 'Laravel doğrulamasını kullanarak kendi kurallarınızı belirleyin'],
                'rules_messages'    => ['title' => 'Kural Mesajları'     , 'description' => 'Laravel doğrulamasını kullanarak kendi kural mesajlarını kullanın'],
                'messages_success'  => ['title' => 'Başarı'              , 'description' => 'Form başarıyla gönderildiğinde gönderilecek ileti', 'default' => 'Formunuz başarıyla gönderildi'  ],
                'messages_errors'   => ['title' => 'Hatalar'             , 'description' => 'Formda hatalar olduğunda gösterilecek mesaj'         , 'default' => 'Gönderiminizle ilgili hatalar vardı.'],
                'allowed_fields'    => ['title' => 'İzin Verilen Alanlar', 'description' => 'Filtrelenecek ve depolanacak alanları belirtin (her satır için bir alan adı ekleyin)'],
                'mail_enabled'      => ['title' => 'Posta Bildirimleri'  , 'description' => 'Gönderilen her formda posta gönder'],
                'mail_recipients'   => ['title' => 'Posta Alıcıları'     , 'description' => 'E-posta alıcılarını belirtin (her hat için bir adres ekleyin)'],
                'recaptcha_enabled' => ['title' => 'ReCAPTCHAyı etkinleştir'  , 'description' => 'ReCAPTCHA widgetını formunuza ekleyin.'],
                'recaptcha_theme'   => ['title' => 'Tema'                , 'description' => 'Widgetin renk teması', 'light'  => 'Aydınlık' , 'dark'    => 'Karanlık'],
                'recaptcha_type'    => ['title' => 'Tip'                 , 'description' => 'Gösterilecek CAPTCHA türü' , 'image'  => 'Resim' , 'audio'   => 'Ses'],
                'recaptcha_size'    => ['title' => 'Boyut'               , 'description' => 'Widgetın boyutu'       , 'normal' => 'Normal', 'compact' => 'Kompakt'],
            ]
        ],

        'settings' => [
            'section_flash_messages'  => 'Flash Mesajları',
            'global_messages_success' => ['label' => 'Genel Başarı Mesajları', 'comment' => '(Bu ayar bileşenden geçersiz kılınabilir)', 'default' => 'Formunuz başarıyla gönderildi'],
            'global_messages_errors'  => ['label' => 'Genel Hata Mesajları' , 'comment' => '(Bu ayar bileşenden geçersiz kılınabilir)', 'default' => 'Gönderiminizle ilgili hatalar vardı.'],
            'section_recaptcha'       => 'ReCAPTCHA Ayarları',
            'recaptcha_site_key'      => 'Site anahtarı',
            'recaptcha_secret_key'    => 'Gizli anahtar',
        ],

        'permissions' => [
            'tab'             => 'Sihirli Formlar',
            'access_records'  => 'Kayıtlı form verilerine erişme',
            'access_exports'  => 'Saklanan verilere dışa aktarma erişimi',
            'access_settings' => 'Erişim modülü yapılandırması',
        ],

        'mails' => [
            'form_notification' => [
                'description' => 'Bir form gönderildiğinde bildirimde bulunun'
            ]
        ],

        'validation' => [
            'recaptcha_error' => 'ReCAPTCHA alanını doğrulayamıyorum'
        ],

    ];

?>
