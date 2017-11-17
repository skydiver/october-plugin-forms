<?php

    namespace Martin\Forms\Components;

    use Lang;
    use October\Rain\Filesystem\Definitions;
    use Martin\Forms\Classes\MagicForm;
    use Martin\Forms\Models\Record;

    class UploadForm extends MagicForm {

        use \Martin\Forms\Traits\FileUploader;

        public function componentDetails() {
            return [
                'name'        => 'martin.forms::lang.components.upload_form.name',
                'description' => 'martin.forms::lang.components.upload_form.description',
            ];
        }

        public function init() {
            $this->fileTypes       = $this->processFileTypes(true);
            $this->maxSize         = $this->property('maxSize');
            $this->placeholderText = $this->property('placeholderText');
            $this->removeText      = $this->property('removeText');
            $this->setProperty('deferredBinding', 1);
            $this->bindModel('files', new Record);
        }

        public function onRun() {
            parent::onRun();
            $this->addCss('assets/css/uploader.css');
            $this->addJs('assets/vendor/dropzone/dropzone.js');
            $this->addJs('assets/js/uploader.js');
            $this->isMulti = $this->property('uploader_multi');
            if($result = $this->checkUploadAction()) { return $result; }
        }

        public function defineProperties() {
            $local = [
                'mail_uploads' => [
                    'title'             => 'martin.forms::lang.components.shared.mail_uploads.title',
                    'description'       => 'martin.forms::lang.components.shared.mail_uploads.description',
                    'type'              => 'checkbox',
                    'default'           => false,
                    'group'             => 'martin.forms::lang.components.shared.group_mail',
                    'showExternalParam' => false
                ],
                'uploader_enable' => [
                    'title'             => 'martin.forms::lang.components.shared.uploader_enable.title',
                    'description'       => 'martin.forms::lang.components.shared.uploader_enable.description',
                    'default'           => false,
                    'type'              => 'checkbox',
                    'group'             => 'martin.forms::lang.components.shared.group_uploader',
                    'showExternalParam' => false,
                ],
                'uploader_multi' => [
                    'title'             => 'martin.forms::lang.components.shared.uploader_multi.title',
                    'description'       => 'martin.forms::lang.components.shared.uploader_multi.description',
                    'default'           => true,
                    'type'              => 'checkbox',
                    'group'             => 'martin.forms::lang.components.shared.group_uploader',
                    'showExternalParam' => false,
                ],
                'placeholderText' => [
                    'title'             => 'martin.forms::lang.components.shared.uploader_pholder.title',
                    'description'       => 'martin.forms::lang.components.shared.uploader_pholder.description',
                    'default'           => Lang::get('martin.forms::lang.components.shared.uploader_pholder.default'),
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_uploader',
                    'showExternalParam' => false,
                ],
                'removeText' => [
                    'title'             => 'martin.forms::lang.components.shared.uploader_remFile.title',
                    'description'       => 'martin.forms::lang.components.shared.uploader_remFile.description',
                    'default'           => Lang::get('martin.forms::lang.components.shared.uploader_remFile.default'),
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_uploader',
                    'showExternalParam' => false,
                ],
                'maxSize' => [
                    'title'             => 'martin.forms::lang.components.shared.uploader_maxsize.title',
                    'description'       => 'martin.forms::lang.components.shared.uploader_maxsize.description',
                    'default'           => '5',
                    'type'              => 'string',
                    'group'             => 'martin.forms::lang.components.shared.group_uploader',
                    'showExternalParam' => false,
                ],
                'fileTypes' => [
                    'title'             => 'martin.forms::lang.components.shared.uploader_types.title',
                    'description'       => 'martin.forms::lang.components.shared.uploader_types.description',
                    'default'           => Definitions::get('defaultExtensions'),
                    'type'              => 'stringList',
                    'group'             => 'martin.forms::lang.components.shared.group_uploader',
                    'showExternalParam' => false,
                ],
            ];
            return array_merge(parent::defineProperties(), $local);
        }

    }

?>