<?php

    return [

        'plugin' => [
            'name'        => 'Magic Forms',
            'description' => 'Créer des formulaires AJAX facilement'
        ],

        'menu' => [
            'label'    => 'Magic Forms',
            'records'  => ['label' => 'Enregistrements'],
            'exports'  => ['label' => 'Export'],
            'settings' => 'Configurer kes parameters du plugin',
        ],

        'controllers' => [
            'records' => [
                'title'      => 'Voir les enregistrements',
                'view_title' => 'Détails de l\'enregistrement',
                'error'      => 'Enregistrement non trouvé',
                'deleted'    => 'Enregistrement supprimé avec succès',
                'columns'    => [
                    'id'         => 'Enregistrement N°',
                    'group'      => 'Groupe',
                    'ip'         => 'Adresse IP',
                    'form_data'  => 'Champs stockés',
                    'files'      => 'Fichiers attachés',
                    'created_at' => 'Créer le',
                ],
            ],
            'exports' => [
                'title'                => 'Exporter les enregistrements',
                'breadcrumb'           => 'Exporter',
                'filter_section'       => '1. Filtrer les enregistrements',
                'filter_type'          => 'Exporter tous les enregistrements',
                'filter_groups'        => 'Groupes',
                'filter_date_after'    => 'Date de début',
                'filter_date_before'   => 'Date de fin',
                'options_section'      => '2. Options supplémentaires',
                'options_metadata'     => 'Inclure les metadonnées',
                'options_metadata_com' => 'Exporter les enregistrements avec les metadonnées (n°, groupe, IP, date de création)',
                'options_deleted'      => 'Inclure les enregistrements supprimés',
            ],
        ],

        'components' => [
            'generic_form' => [
                'name'        => 'Formulaire générique AJAX',
                'description' => 'Rendu d\'un formulaire générique; remplacer le composant HTML par vos propres champs personnalisés.',
            ],
            'upload_form' => [
                'name'        => 'Téléchargements AJAX [BETA]',
                'description' => 'Montre comment implémenter des téléchargements de fichiers sur votre formulaire.',
            ],
            'empty_form' => [
                'name'        => 'Formulaire AJAX vide',
                'description' => 'Créer un modèle vide pour votre formulaire personnalisé; remplacer le composant HTML.',
            ],
            'shared' => [
                'csrf_error'        => 'La session du formulaire a expirée ! Veuillez actualiser la page.',
                'recaptcha_warn'    => 'Avertissement: reCAPTCHA n\'est pas correctement configuré. Àllez dans Backend > Paramètres > CMS > Magic Forms et configurez svp.',
                'group_validation'  => 'Validation du formulaire',
                'group_messages'    => 'Messages Flash ',
                'group_mail'        => 'Notifications',
                'group_mail_resp'   => 'Réponse automatique',
                'group_settings'    => 'Plus de réglages',
                'group_security'    => 'Securité',
                'group_recaptcha'   => 'reCAPTCHA',
                'group_uploader'    => 'Transfert de fichiers',
                'validation_req'    => 'La propriété est requise',
                'group'             => ['title' => 'Groupe'                          , 'description' => 'Organisez vos formulaires avec un nom de groupe personnalisé. Cette option est utile lorsque vous exportez des données.'],
                'rules'             => ['title' => 'Règles'                          , 'description' => 'Définissez vos propres règles en utilisant la validation de Laravel'],
                'rules_messages'    => ['title' => 'Messages de règles'              , 'description' => 'Utilisez vos propres messages de règles en utilisant la validation de Laravel'],
                'messages_success'  => ['title' => 'Succès'                          , 'description' => 'Message lorsque le formulaire est soumis avec succès'  , 'default' => 'Votre formulaire a été envoyé avec succès'  ],
                'messages_errors'   => ['title' => 'Erreurs'                         , 'description' => 'Message lorsque le formulaire contient des erreurs'    , 'default' => 'Il y a eu des erreurs dans votre formulaire'],
                'mail_enabled'      => ['title' => 'Envoyer des notifications'       , 'description' => 'Envoyer des notifications par mail sur chaque formulaire envoyé'],
                'mail_subject'      => ['title' => 'Sujet'                           , 'description' => 'Remplacer le sujet par défaut du courrier électronique'],
                'mail_recipients'   => ['title' => 'Destinataires'                   , 'description' => 'Spécifier les destinataires des e-mails (ajouter une adresse par ligne)'],
                'mail_uploads'      => ['title' => 'Envoyer les téléchargements'     , 'description' => 'Envoi des fichiers téléchargés en pièce jointe'],
                'mail_resp_enabled' => ['title' => 'Envoyer une réponse automatique' , 'description' => 'Envoyer un e-mail d\'auto-réponse à la personne qui soumet le formulaire'],
                'mail_resp_field'   => ['title' => 'Champ email'                     , 'description' => 'Champ de formulaire contenant l\'adresse e-mail du destinataire de réponse automatique '],
                'mail_resp_from'    => ['title' => 'Adresse de l\'expéditeur'        , 'description' => 'Adresse e-mail de l\'expéditeur du courrier électronique de réponse automatique (par exemple nepasrepondre@votreentreprise.com)'],
                'mail_resp_subject' => ['title' => 'Sujet'                           , 'description' => 'Remplacer le sujet par défaut du courrier électronique'],
                'reset_form'        => ['title' => 'Réinitialiser le formulaire'     , 'description' => 'Réinitialiser le formulaire après l\'envoi réussi'],
                'redirect'          => ['title' => 'Redirection envoi réussi'        , 'description' => 'Rediriger vers une URL spécifique lors de l\'envoi réussi. Remarque: doit être une URL valide commençant par http ou https ou la redirection sera ignorée.'],
                'anonymize_ip'      => ['title' => 'Anonymiser IP'                   , 'description' => 'Ne pas enregistrer les adresses IP', 'full' => 'Complet', 'partial' => 'Partiel', 'disabled' => 'Désactivé'],
                'allowed_fields'    => ['title' => 'Champs autorisés'                , 'description' => 'Spécifiez les champs qui doivent être filtrés et stockés (ajoutez un nom de champ par ligne)'],
                'recaptcha_enabled' => ['title' => 'Activer reCAPTCHA'               , 'description' => 'Insère le widget reCAPTCHA sur votre formulaire'],
                'recaptcha_theme'   => ['title' => 'Thème'                           , 'description' => 'Le thème de couleur du widget' , 'light'  => 'Léger' ,  'dark'    => 'Sombre'],
                'recaptcha_type'    => ['title' => 'Type'                            , 'description' => 'Le type de CAPTCHA à servir'   , 'image'  => 'Image' ,  'audio'   => 'Audio'],
                'recaptcha_size'    => ['title' => 'Taille'                          , 'description' => 'La taille du widget'           , 'normal' => 'Normale', 'compact' => 'Compacte'],
                'uploader_enable'   => ['title' => 'Autoriser les téléchargements'   , 'description' => 'Activer le téléchargement des fichiers. Vous devez activer cette option explicitement comme mesure de sécurité.'],
                'uploader_multi'    => ['title' => 'Fichiers multiples'              , 'description' => 'Autoriser plusieurs téléchargements de fichiers'],
                'uploader_pholder'  => ['title' => 'Texte de remplacement'           , 'description' => 'Texte à afficher quand aucun fichier n\'est téléchargé', 'default' => 'Cliquez pour choisir ou faites glisser les fichiers à télécharger'],
                'uploader_maxsize'  => ['title' => 'Limite de taille de fichier'     , 'description' => 'Taille maximale du fichier pouvant être téléchargée en mégaoctets'],
                'uploader_types'    => ['title' => 'Types de fichiers autorisés'     , 'description' => 'Extensions de fichiers autorisées ou étoile (*) pour tous les types (ajoutez une extension par ligne)'],
                'uploader_remFile'  => ['title' => 'Texte de Suppression'            , 'description' => 'Texte à afficher dans la popup lors de la suppression d\'un fichier', 'default' => 'Êtes-vous sûr ?'],
            ]
        ],

        'settings' => [
            'section_flash_messages'  => 'Messages Flash',
            'global_messages_success' => ['label' => 'Message de réussite', 'comment' => '(Ce paramètre peut être remplacé par le composant)', 'default' => 'Votre formulaire a été envoyé avec succès'],
            'global_messages_errors'  => ['label' => 'Global Errors Message' , 'comment' => '(Ce paramètre peut être remplacé par le composant)', 'default' => 'Il y a eu des erreurs dans votre formulaire'],
            'section_recaptcha'       => 'Paramètres reCAPTCHA',
            'recaptcha_site_key'      => 'Clé du site',
            'recaptcha_secret_key'    => 'Clé secrète',
        ],

        'permissions' => [
            'tab'             => 'Magic Forms',
            'access_records'  => 'Accéder aux données des formulaires stockés',
            'access_exports'  => 'Accès aux exports des formulaires stockés',
            'access_settings' => 'Accès à la configuration du module',
        ],

        'mails' => [
            'form_notification' => ['description' => 'Notifier quand un formulaire est envoyé'],
            'form_autoresponse' => ['description' => 'Auto-Réponse lorsqu\'un formulaire est envoyé'],
        ],

        'validation' => [
            'recaptcha_error' => 'Impossible de valider le champ reCAPTCHA'
        ],

    ];

?>