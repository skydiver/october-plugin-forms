<?php

    return [

        'plugin' => [
            'name'        => 'Magic Forms',
            'description' => 'einfaches Erstellen von AJAX Formularen'
        ],

        'menu' => [
            'label'    => 'Magic Forms',
            'records'  => ['label' => 'Records'],
            'exports'  => ['label' => 'Export'],
            'settings' => 'Konfigurieren der plugin parameter',
        ],

        'controllers' => [
            'records' => [
                'title'      => 'Einträge anzeigen',
                'view_title' => 'Details zum Eintrag',
                'error'      => 'Eintrag nicht gefunden',
                'deleted'    => 'Eintrag erfolgreich gelöscht',
                'columns'    => [
                    'id'         => 'Eintrag ID',
                    'group'      => 'Gruppe',
                    'ip'         => 'IP Adresse',
                    'form_data'  => 'Gespeicherte Felder',
                    'files'      => 'Anhänge',
                    'created_at' => 'Erstellt',
                ],
                'buttons' => [
                    'read'       => 'Als gelesen markieren',
                    'unread'     => 'Als ungelesen markieren',
                    'gdpr_clean' => 'DSVGO Aufräumung',
                ],
                'alerts' => [
                    'gdpr_confirm' => "Sind sie sicher dass Sie alte Einträge aufräumen wollen?\nDiese Aktion kann nicht wiederrufen werden!",
                    'gdpr_success' => 'DSVGO Aufräumung wurde erfolgreich ausgeführt',
                    'gdpr_perms'   => 'Sie haben keine Berechtigung für diese Funktion.',
                ],
            ],
            'exports' => [
                'title'                 => 'Einträge exportieren',
                'breadcrumb'            => 'Exportieren',
                'filter_section'        => '1. Einträge filtern',
                'filter_type'           => 'Alle Einträge exportieren',
                'filter_groups'         => 'Gruppen',
                'filter_date_after'     => 'Nach dem Datum',
                'filter_date_before'    => 'Vor dem Datum',
                'options_section'       => '2. Extra Optionen',
                'options_metadata'      => 'Inklusive Metadaten',
                'options_metadata_com'  => 'Exportiere die Einträge mit Metadaten (Eintrag ID, Gruppe, IP, Erstellungsdatum)',
                'options_deleted'       => 'Inklusive gelöschter Einträge',
                'options_delimiter'     => 'Alternatives Trennzeichen benutzen',
                'options_delimiter_com' => 'Semikolon als Trennzeichen',
                'options_utf'           => 'Enkodierung in UTF8',
                'options_utf_com'       => 'Enkodierung Ihrer CSV-Datei im UTF-8 Format für die Unterstützung von Umlauten und Sonderzeichen.',
            ],
        ],

        'components' => [
            'generic_form' => [
                'name'        => 'Generisches AJAX Formular',
                'description' => 'Mit Standardeinstellungen rendered ein generisches Formular; Überschreib Komponenten HTML mit deinen eigenen Feldern.',
            ],
            'upload_form' => [
                'name'        => 'Upload AJAX Formular [BETA]',
                'description' => 'Zeigt wie man Dateiupload in deinem Formular implementiert.',
            ],
            'empty_form' => [
                'name'        => 'Leeres AJAX Formular',
                'description' => 'Erstellt eine leere Vorlage für dein individuelles Formular; Überschreib Komponenten HTML.',
            ],
            'shared' => [
                'csrf_error'        => 'Formular Seitzung abgelaufen! Bitte die Seite neuladen.',
                'recaptcha_warn'    => 'Warnung: reCAPTCHA ist nicht ordentlich konfiguriert. Bitte, gehe zum Backend > Einstellungen > CMS > Magic Forms um reCAPTCHA zu kofigurieren.',
                'group_validation'  => 'Formular Validierung',
                'group_messages'    => 'Flash Benachrichtung',
                'group_mail'        => 'Benachrichtigungen Einstellungen',
                'group_mail_resp'   => 'Automatische Antwort Einstellungen',
                'group_settings'    => 'Weitere Einstellungen',
                'group_security'    => 'Sicherheit',
                'group_recaptcha'   => 'reCAPTCHA Einstellungen',
                'group_advanced'    => 'Fortgeschrittene Einstellungen',
                'group_uploader'    => 'Uploader Einstellungen',
                'validation_req'    => 'Die Eigenschaft wird benötigt',
                'group'             => ['title' => 'Gruppe'              , 'description' => 'Organisiere deine Formulare durch eigene Gruppennamen. Diese Option ist für das Exportieren der Daten sehr praktischt.'],
                'rules'             => ['title' => 'Regeln'              , 'description' => 'Erstelle eigene Regeln Mithilfe der Laravel Validierungsfunktion'],
                'rules_messages'    => ['title' => 'Regeln Benachrichtigungen'     , 'description' => 'Erstelle eigene Benachrichtigungen Mithilfe der Laravel Validierungsfunktion'],
                'custom_attributes' => ['title' => 'Eigene Attribute'  , 'description' => 'Erstelle eigene Attribute Mithilfe der Laravel Validierungsfunktion'],
                'messages_success'  => ['title' => 'Erfolg'            , 'description' => 'Nachricht bei erfolgreicher Übermittlung des Formulars', 'default' => 'Your form was successfully submitted'  ],
                'messages_errors'   => ['title' => 'Fehler'             , 'description' => 'Nachricht bei Fehlern während der Eingabe der Formulardaten'         , 'default' => 'There were errors with your submission'],
                'messages_partial'  => ['title' => 'Benutze eigene Partial' , 'description' => 'Überschreibe Flash-Nachrichten mit deinem eigenem Partial in deinem Theme'],
                'mail_enabled'      => ['title' => 'Sende Benachrichtigungen' , 'description' => 'Sende eine Benachrichtigungsmail nach jeder erfolgreichen Übertragung.'],
                'mail_subject'      => ['title' => 'Betreff'            , 'description' => 'Überschreibe die standard E-Mail Betreffszeile'],
                'mail_recipients'   => ['title' => 'Empfänger'         , 'description' => 'E-Mail Empfänger eintragen (Füge eine E-Mail Adresse pro Zeile ein)'],
                'mail_bcc'          => ['title' => 'BCC'                , 'description' => 'Sende blind carbon copy (BCC) zur folgenden Empfängern (Füge eine E-Mail Adresse per Zeile ein)'],
                'mail_replyto'      => ['title' => 'Empfänger E-Mail Feld', 'description' => 'Formular Feld das die E-Mail Adresse enthält. Diese Adresse wird als Empfänger Adresse benutzt.'],
                'mail_template'     => ['title' => 'E-Mail Vorlage'      , 'description' => 'Benutze eigene E-Mail Vorlagen. Gebe einen Vorlagen Code ein wie z.B. "martin.forms::mail.notification" (Kann im Einstellungen der E-Mail Vorlagen im Backend gefunden werden). Leer lassen für Standardvorlage.'],
                'mail_uploads'      => ['title' => 'Sende Uploads'       , 'description' => 'Sende Uploads als Anhang'],
                'mail_resp_enabled' => ['title' => 'Sende Auto-Antwort' , 'description' => 'Sende eine automatische Antwort E-Mail zu der Person die dein Formular ausgfüllt.'],
                'mail_resp_field'   => ['title' => 'E-Mail Feld'        , 'description' => 'Formular Feld das die E-Mail Adresse enthät für die automatische Antwort'],
                'mail_resp_from'    => ['title' => 'Absender Adresse'     , 'description' => 'Absender E-Mail Adresse was benutzt werden soll (z.B. noreply@yourcompany.com)'],
                'mail_resp_subject' => ['title' => 'Betreff'            , 'description' => 'Überschreibe standard E-Mail Betreffszeile'],
                'reset_form'        => ['title' => 'Resete Formular'         , 'description' => 'Resete das Formular nach erfolgreichen Übertragung'],
                'redirect'          => ['title' => 'Umleitung bei Erfolg', 'description' => 'URL-Umleitung nach erfoglreichen Übertragung'],
                'inline_errors'     => ['title' => 'Inline Fehler'      , 'description' => 'Zeige Inline-Fehler an. Die Funktion braucht Extra-Code. Siehe in der Dokumentation für mehr Informationen.', 'disabled' => 'Deaktiviert', 'display' => 'Zeige Fehler', 'variable' => 'JS Variable'],
                'js_on_success'     => ['title' => 'JS bei Erfolg'      , 'description' => 'Führe eigenen JavaScript-Code aus wenn das Formular erfolgreich übertragen wurde. Keine Script Tags benutzen!'],
                'js_on_error'       => ['title' => 'JS bei Fehlern'        , 'description' => 'Führe eigenen JavaScript-Code aus wenn das Formular nicht validiert werden kann. Keine Script Tags benutzen!'],
                'allowed_fields'    => ['title' => 'Erlaubte Felder'     , 'description' => 'Festlegen welche Felder gefiltert und gespeichert werden sollen. (Füge ein Feld per Zeile ein)'],
                'anonymize_ip'      => ['title' => 'IP-Anonymisierung'       , 'description' => 'IP-Adresse nicht speichern.', 'full' => 'Voll', 'partial' => 'Teilanonymisierung', 'disabled' => 'Deaktiviert'],
                'sanitize_data'     => ['title' => 'Bereinigung der Formulardaten' , 'description' => 'Bereinige die Formulardaten und speichere das Ergebnis in der Datenbank', 'disabled' => 'deaktiviert', 'htmlspecialchars' => 'Benutzer htmlspecialchars'],
                'recaptcha_enabled' => ['title' => 'Aktiviere reCAPTCHA'   , 'description' => 'reCAPTCHA-Widget in deinem Formular einfügen'],
                'recaptcha_theme'   => ['title' => 'Theme'              , 'description' => 'Farbschema des Widgets', 'light'  => 'Hell' , 'dark'    => 'Dunkel'],
                'recaptcha_type'    => ['title' => 'Typ'               , 'description' => 'reCAPTCHA Typ festlegen' , 'image'  => 'Bild' , 'audio'   => 'Audio'],
                'recaptcha_size'    => [
                    'title' => 'Größe',
                    'description' => 'Die Größe des Widgets',
                    'normal' => 'Normal',
                    'compact' => 'Kompakt',
                    'invisible' => 'Unsichtbar',
                ],
                'skip_database'      => ['title' => 'Überspringe DB'              , 'description' => 'Keine Speicherung der Formulardaten in der Datenbank. Nützlich wenn man Events mit einem eigenem Plugin nutzen möchte.'],
                'emails_date_format' => ['title' => 'Datum Formatierung in E-Mails', 'description' => 'Ändere die Datumformatierung die dann in E-Mails verwendet wird.'],
                'uploader_enable'    => ['title' => 'Erlaube Uploads'        , 'description' => 'Aktiviere Datei-Upload. Diese Option muss aufgrund der Sicherheitseinstellungen explizit aktiviert werden.'],
                'uploader_multi'     => ['title' => 'Merhfachdateien'       , 'description' => 'Erlaube Mehrfachdateien-Uploads'],
                'uploader_pholder'   => ['title' => 'Platzhalter Text'     , 'description' => 'Platzhalter Text der angezeigt wird so lange keine Datei hochgeladen wurde', 'default' => 'Click or drag files to upload'],
                'uploader_maxsize'   => ['title' => 'Dateigröße Limitierung'      , 'description' => 'Die maximale Dateigröße die hochgeladen werden kann in Megabytes'],
                'uploader_types'     => ['title' => 'Erlaubte Datei-Typen'   , 'description' => 'Erlaubte Dateiendungen oder ein Stern (*) für alle Typen (Füge eine Dateiendung per Zeile ein)'],
                'uploader_remFile'   => ['title' => 'Popup Text Datei entfernen'    , 'description' => 'Text Platzhalter für die Abfrage, wenn eine Datei vor dem Upload entfernt wird', 'default' => 'Are you sure ?'],
            ]
        ],

        'settings' => [
            'tabs'                    => ['general' => 'Allgemein', 'recaptcha' => 'reCAPTCHA', 'gdpr' => 'DSVGO'],
            'section_flash_messages'  => 'Flash Nachrichten',
            'global_messages_success' => ['label' => 'Globale Erfolgsnachricht', 'comment' => '(Diese Einstellung kann aus der Komponente heraus überschrieben werden)', 'default' => 'Your form was successfully submitted'],
            'global_messages_errors'  => ['label' => 'Globale Fehlernachricht' , 'comment' => '(Diese Einstellung kann aus der Komponente heraus überschrieben werden)', 'default' => 'There were errors with your submission'],
            'plugin_help'             => 'Die Plugindokumentation erreichst Du über die GitHub repo:',
            'global_hide_button'      => 'Navigationsobjekt vestecken',
            'global_hide_button_desc' => 'Praktisch, wenn Du eigene Events mit einem eigenem Plugin nutzen möchtest.',
            'section_recaptcha'       => 'reCAPTCHA Einstellungen',
            'recaptcha_site_key'      => 'Site key',
            'recaptcha_secret_key'    => 'Secret key',
            'gdpr_help_title'         => 'Information',
            'gdpr_help_comment'       => 'Das neue EU-DSVGO Gesetz in Europa besagt dass die Einträge nicht mehr unendlich aufbewahrt werden dürfen. Diese müssen je nach nach Bedarf automatisiert gelöscht werden.',
            'gdpr_enable'             => 'Aktiviere EU-DSVGO konforme Aufräumung',
            'gdpr_days'               => 'Behalte die Einträge für die Anzahl an: X Tagen',
        ],

        'permissions' => [
            'tab'             => 'Magic Forms',
            'access_records'  => 'Zugriff auf gespeicherte Formular-Einsendedaten',
            'access_exports'  => 'Zugriff für das Exportieren der gespeicherten Formular-Einsendedaten',
            'access_settings' => 'Zugriff auf Modul-Konfiguration',
            'gdpr_cleanup'    => 'Führe EU-DSVGO Aufräumung der Datenbank durch.',
        ],

        'mails' => [
            'form_notification' => ['description' => 'Benachrichtung nach erfolgreicher Einsendung der Formulardaten.'],
            'form_autoresponse' => ['description' => 'Automatische Antwort nach erfolgreicher Einsendung der Formulardaten.'],
        ],

        'validation' => [
            'recaptcha_error' => 'Kann das reCAPTCHA Feld nicht validieren.'
        ],

        'classes' => [
            'GDPR' => [
                'alert_gdpr_disabled' => 'EU-DSVGO Einstellungen sind deaktiviert.',
                'alert_invalid_gdpr'  => 'Ungültige Einstellung des EU-DSVGO Aufräumvorgangs Intervals nach X Tagen.',
            ]
        ]

    ];

?>
