<?php

    namespace Martin\Forms\Controllers;

    use BackendMenu, Response;
    use Backend\Classes\Controller;
    use League\Csv\Writer as CsvWriter;
    use SplTempFileObject;
    use Martin\Forms\Models\Record;

    class Exports extends Controller {

        public $requiredPermissions = ['martin.forms.access_exports'];

        public $implement = [
            'Backend.Behaviors.FormController',
        ];

        public $formConfig = 'config_form.yaml';

        public function __construct() {
            parent::__construct();
            BackendMenu::setContext('Martin.Forms', 'forms', 'exports');
        }

        public function index() {
            $this->pageTitle = e(trans('martin.forms::lang.controllers.exports.title'));
            $this->create('frontend');
        }

        public function csv() {
            $records = Record::get()->toArray();
            $csv = CsvWriter::createFromFileObject(new SplTempFileObject());
            $csv->insertOne([e(trans('martin.forms::lang.controllers.records.columns.id')), e(trans('martin.forms::lang.controllers.records.columns.ip')), e(trans('martin.forms::lang.controllers.records.columns.created_at')), e(trans('martin.forms::lang.controllers.records.columns.form_data')) . " >>>"]);
            foreach($records as $row) {
                $data = (array) json_decode($row['form_data']);
                array_unshift($data, $row['id'], $row['ip'], $row['created_at']);
                $csv->insertOne($data);
            }
            $csv->output('records.csv');
            exit();
        }

    }

?>