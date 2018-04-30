<?php

    namespace Martin\Forms;

    use Backend, Lang, Validator;
    use System\Classes\PluginBase;
    use System\Classes\SettingsManager;
    use Martin\Forms\Classes\BackendHelpers;
    use Martin\Forms\Classes\GDPR;
    use Martin\Forms\Classes\ReCaptchaValidator;
    use Martin\Forms\Classes\UnreadRecords;
    use Martin\Forms\Models\Settings;

    class Plugin extends PluginBase {

        public function pluginDetails() {
            return [
                'name'        => 'martin.forms::lang.plugin.name',
                'description' => 'martin.forms::lang.plugin.description',
                'author'      => 'Martin M.',
                'icon'        => 'icon-bolt',
                'homepage'    => 'https://github.com/skydiver/'
            ];
        }

        public function registerNavigation() {
            if(Settings::get('global_hide_button', false)) { return; }
            return [
                'forms' => [
                    'label'       => 'martin.forms::lang.menu.label',
                    'icon'        => 'icon-bolt',
                    'iconSvg'     => 'plugins/martin/forms/assets/imgs/icon.svg',
                    'url'         => BackendHelpers::getBackendURL(['martin.forms.access_records' => 'martin/forms/records', 'martin.forms.access_exports' => 'martin/forms/exports'], 'martin.forms.access_records'),
                    'permissions' => ['martin.forms.*'],
                    'sideMenu' => [
                        'records' => [
                            'label'        => 'martin.forms::lang.menu.records.label',
                            'icon'         => 'icon-database',
                            'url'          => Backend::url('martin/forms/records'),
                            'permissions'  => ['martin.forms.access_records'],
                            'counter'      => UnreadRecords::getTotal(),
                            'counterLabel' => 'Un-Read Messages'
                        ],
                        'exports' => [
                            'label'       => 'martin.forms::lang.menu.exports.label',
                            'icon'        => 'icon-download',
                            'url'         => Backend::url('martin/forms/exports'),
                            'permissions' => ['martin.forms.access_exports']
                        ],
                    ]
                ]
            ];
        }

        public function registerSettings() {
            return [
                'config' => [
                    'label'       => 'martin.forms::lang.menu.label',
                    'description' => 'martin.forms::lang.menu.settings',
                    'category'    => SettingsManager::CATEGORY_CMS,
                    'icon'        => 'icon-bolt',
                    'class'       => 'Martin\Forms\Models\Settings',
                    'permissions' => ['martin.forms.access_settings'],
                    'order'       => 500
                ]
            ];
        }

        public function registerPermissions() {
            return [
                'martin.forms.access_settings' => ['tab' => 'martin.forms::lang.permissions.tab', 'label' => 'martin.forms::lang.permissions.access_settings'],
                'martin.forms.access_records'  => ['tab' => 'martin.forms::lang.permissions.tab', 'label' => 'martin.forms::lang.permissions.access_records'],
                'martin.forms.access_exports'  => ['tab' => 'martin.forms::lang.permissions.tab', 'label' => 'martin.forms::lang.permissions.access_exports'],
                'martin.forms.gdpr_cleanup'    => ['tab' => 'martin.forms::lang.permissions.tab', 'label' => 'martin.forms::lang.permissions.gdpr_cleanup'],
            ];
        }

        public function registerComponents() {
            return [
                'Martin\Forms\Components\GenericForm' => 'genericForm',
                'Martin\Forms\Components\UploadForm'  => 'uploadForm',
                'Martin\Forms\Components\EmptyForm'   => 'emptyForm',
            ];
        }

        public function registerMailTemplates() {
            return [
                'martin.forms::mail.notification' => Lang::get('martin.forms::lang.mails.form_notification.description'),
                'martin.forms::mail.autoresponse' => Lang::get('martin.forms::lang.mails.form_autoresponse.description'),
            ];
        }

        public function register() {
            $this->app->resolving('validator', function($validator) {
                Validator::extend('recaptcha', 'Martin\Forms\Classes\ReCaptchaValidator@validateReCaptcha');
            });
        }

        public function registerSchedule($schedule) {
            $schedule->call(function () {
                $records = GDPR::cleanRecords();
            })->daily();
        }

    }

?>
