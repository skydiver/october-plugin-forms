<?php

    namespace Martin\Forms\Models;

    use Lang, Model;
    use Cms\Classes\Theme;
    use Cms\Classes\Page;

    class Settings extends Model {

        public $implement      = ['System.Behaviors.SettingsModel'];
        public $settingsCode   = 'martin_forms_settings';
        public $settingsFields = 'fields.yaml';

        // public function __construct() {
        //     $this->attributes = [
        //         'global_messages_success' => Lang::get('martin.forms::lang.settings.global_messages_success.default'),
        //         'global_messages_errors'  => Lang::get('martin.forms::lang.settings.global_messages_errors.default'),
        //     ];
        //     parent::__construct();
        // }

    }

?>