<?php

    namespace Martin\Forms\Controllers;

    use BackendMenu;
    use Backend\Classes\Controller;
    use Backend\Facades\Backend;
    use Illuminate\Support\Facades\Redirect;
    use October\Rain\Support\Facades\Flash;
    use Martin\Forms\Models\Record;

    class Records extends Controller {

        public $implement = [
            'Backend.Behaviors.ListController'
        ];

        public $listConfig = 'config_list.yaml';

        public $requiredPermissions = ['martin.forms.access_records'];

        public function __construct() {
            parent::__construct();
            BackendMenu::setContext('Martin.Forms', 'forms', 'records');
        }

        public function view($id){
            $record = Record::find($id);
            if(!$record) {
                Flash::error(e(trans('martin.forms::lang.controllers.records.error')));
                return Redirect::to(Backend::url('martin/forms/records'));
            }
            $this->addCss('/plugins/martin/forms/assets/css/records.css');
            $this->pageTitle      = e(trans('martin.forms::lang.controllers.records.view_title'));
            $this->vars['record'] = $record;
        }

        public function onDeleteSingle() {
            $id     = post('id' );
            $record = Record::find($id);
            if($record) {
                $record->delete();
                Flash::success(e(trans('martin.forms::lang.controllers.records.deleted')));
            } else {
                Flash::error(e(trans('martin.forms::lang.controllers.records.error')));
            }
            return Redirect::to(Backend::url('martin/forms/records'));
        }

    }

?>