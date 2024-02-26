<?php

    namespace BlakeJones\MagicForms;

    use Backend, Lang, Validator;
    use System\Classes\PluginBase;
    use System\Classes\SettingsManager;
    use BlakeJones\MagicForms\Classes\BackendHelpers;
    use BlakeJones\MagicForms\Classes\GDPR;
    use BlakeJones\MagicForms\Classes\ReCaptchaValidator;
    use BlakeJones\MagicForms\Classes\UnreadRecords;
    use BlakeJones\MagicForms\Models\Settings;

    class Plugin extends PluginBase {

        public function pluginDetails() {
            return [
                'name'        => 'blakejones.magicforms::lang.plugin.name',
                'description' => 'blakejones.magicforms::lang.plugin.description',
                'author'      => 'Martin M. (Forked by Blake Jones)',
                'icon'        => 'icon-bolt',
                'homepage'    => 'https://github.com/blakej115/magic-forms'
            ];
        }

        public function registerNavigation() {
            if(Settings::get('global_hide_button', false)) { return; }
            return [
                'forms' => [
                    'label'       => 'blakejones.magicforms::lang.menu.label',
                    'icon'        => 'icon-bolt',
                    'iconSvg'     => 'plugins/blakejones/magicforms/assets/imgs/icon.svg',
                    'url'         => BackendHelpers::getBackendURL(['blakejones.magicforms.access_records' => 'blakejones/magicforms/records', 'blakejones.magicforms.access_exports' => 'blakejones/magicforms/exports'], 'blakejones.magicforms.access_records'),
                    'permissions' => ['blakejones.magicforms.*'],
                    'sideMenu' => [
                        'records' => [
                            'label'        => 'blakejones.magicforms::lang.menu.records.label',
                            'icon'         => 'icon-database',
                            'url'          => Backend::url('blakejones/magicforms/records'),
                            'permissions'  => ['blakejones.magicforms.access_records'],
                            'counter'      => UnreadRecords::getTotal(),
                            'counterLabel' => 'Un-Read Messages'
                        ],
                        'exports' => [
                            'label'       => 'blakejones.magicforms::lang.menu.exports.label',
                            'icon'        => 'icon-download',
                            'url'         => Backend::url('blakejones/magicforms/exports'),
                            'permissions' => ['blakejones.magicforms.access_exports']
                        ],
                    ]
                ]
            ];
        }

        public function registerSettings() {
            return [
                'config' => [
                    'label'       => 'blakejones.magicforms::lang.menu.label',
                    'description' => 'blakejones.magicforms::lang.menu.settings',
                    'category'    => SettingsManager::CATEGORY_CMS,
                    'icon'        => 'icon-bolt',
                    'class'       => 'BlakeJones\MagicForms\Models\Settings',
                    'permissions' => ['blakejones.magicforms.access_settings'],
                    'order'       => 500
                ]
            ];
        }

        public function registerPermissions() {
            return [
                'blakejones.magicforms.access_settings' => ['tab' => 'blakejones.magicforms::lang.permissions.tab', 'label' => 'blakejones.magicforms::lang.permissions.access_settings'],
                'blakejones.magicforms.access_records'  => ['tab' => 'blakejones.magicforms::lang.permissions.tab', 'label' => 'blakejones.magicforms::lang.permissions.access_records'],
                'blakejones.magicforms.access_exports'  => ['tab' => 'blakejones.magicforms::lang.permissions.tab', 'label' => 'blakejones.magicforms::lang.permissions.access_exports'],
                'blakejones.magicforms.gdpr_cleanup'    => ['tab' => 'blakejones.magicforms::lang.permissions.tab', 'label' => 'blakejones.magicforms::lang.permissions.gdpr_cleanup'],
            ];
        }

        public function registerComponents() {
            return [
                'BlakeJones\MagicForms\Components\GenericForm' => 'genericForm',
                'BlakeJones\MagicForms\Components\UploadForm'  => 'uploadForm',
                'BlakeJones\MagicForms\Components\EmptyForm'   => 'emptyForm',
            ];
        }

        public function registerMailTemplates() {
            return [
                'blakejones.magicforms::mail.notification',
                'blakejones.magicforms::mail.autoresponse',
            ];
        }

        public function register() {
            $this->app->resolving('validator', function($validator) {
                Validator::extend('recaptcha', 'BlakeJones\MagicForms\Classes\ReCaptchaValidator@validateReCaptcha');
            });
        }

        public function registerSchedule($schedule) {
            $schedule->call(function () {
                $records = GDPR::cleanRecords();
            })->daily();
        }

    }

?>
