<?php

    namespace Martin\Forms\Controllers;

    use App, BackendMenu, Lang;
    use Backend\Classes\Controller;
    use Backend\Facades\Backend;
    use Illuminate\Support\Facades\Redirect;
    use October\Rain\Support\Facades\Flash;
    use Martin\Forms\Classes\GDPR;
    use Martin\Forms\Classes\UnreadRecords;
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

        public function view($id) {
            $record = Record::find($id);
            if(!$record) {
                Flash::error(e(trans('martin.forms::lang.controllers.records.error')));
                return Redirect::to(Backend::url('martin/forms/records'));
            }
            $record->unread = false;
            $record->save();
            $this->addCss('/plugins/martin/forms/assets/css/records.css');
            $this->pageTitle      = e(trans('martin.forms::lang.controllers.records.view_title'));
            $this->vars['record'] = $record;
        }

        public function onDelete() {
            if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
                Record::whereIn('id',$checkedIds)->delete();
            }
            $counter = UnreadRecords::getTotal();
            return [
                'counter' => ($counter != null) ? $counter : 0,
                'list'    => $this->listRefresh()
            ];
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

        public function download($record_id, $file_id) {
            $record = Record::findOrFail($record_id);
            $file   = $record->files->find($file_id);
            if(!$file) { App::abort(404, Lang::get('backend::lang.import_export.file_not_found_error')); }
            return response()->download($file->getLocalPath(), $file->getFilename());
            exit();
        }

        public function listInjectRowClass($record, $definition = null) {
            if ($record->unread) {
                return 'new';
            }
        }

        public function onReadState() {
            if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
                $unread = (post('state') == 'read') ? 0 : 1;
                Record::whereIn('id',$checkedIds)->update(['unread' => $unread]);
            }
            $counter = UnreadRecords::getTotal();
            return [
                'counter' => ($counter != null) ? $counter : 0,
                'list'    => $this->listRefresh()
            ];
        }

        public function onGDPRClean() {
            if ($this->user->hasPermission(['martin.forms.gdpr_cleanup'])) {
                GDPR::cleanRecords();
                Flash::success(e(trans('martin.forms::lang.controllers.records.alerts.gdpr_success')));
            } else {
                Flash::error(e(trans('martin.forms::lang.controllers.records.alerts.gdpr_perms')));
            }
            $counter = UnreadRecords::getTotal();
            return [
                'counter' => ($counter != null) ? $counter : 0,
                'list'    => $this->listRefresh()
            ];
        }

    }

?>