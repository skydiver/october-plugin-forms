<?php

    namespace Martin\Forms;

    use Backend, Lang, Validator;
    use System\Classes\PluginBase;
    use System\Classes\SettingsManager;
    use Martin\Forms\Classes\ReCaptchaValidator;

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

        public function registerNavigation(){
            return [
                'forms' => [
                    'label'       => 'martin.forms::lang.menu.label',
                    'icon'        => 'icon-bolt',
                    'iconSvg'     => 'plugins/martin/forms/assets/imgs/icon.svg',
                    'url'         => Backend::url('martin/forms/records'),
                    'permissions' => ['martin.forms.access_records'],
                    'sideMenu' => [
                        'records' => [
                            'label'       => 'martin.forms::lang.menu.records.label',
                            'icon'        => 'icon-database',
                            'url'         => Backend::url('martin/forms/records'),
                            'permissions' => ['martin.forms.access_records']
                        ]
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
            ];
        }

        public function registerComponents() {
            return [
                'Martin\Forms\Components\GenericForm' => 'genericForm',
                'Martin\Forms\Components\EmptyForm'   => 'emptyForm',
            ];
        }

        public function registerMailTemplates() {
            return [
                'martin.forms::mail.notification' => Lang::get('martin.forms::lang.mails.form_notification.description'),
            ];
        }

        public function register() {

            Validator::resolver(function($translator, $data, $rules, $messages, $customAttributes) {
                return new ReCaptchaValidator($translator, $data, $rules, $messages, $customAttributes);
            });

        }

    }

?>