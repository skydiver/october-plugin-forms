<?php namespace BlakeJones\MagicForms\Traits;

use Input;
use Cms\Classes\ComponentBase;
use System\Models\File;
use System\Classes\CombineAssets;
use ApplicationException;

trait FileUploader
{

    use \BlakeJones\MagicForms\Traits\ComponentUtils;

    public $maxSize;
    public $placeholderText;
    public $removeText;

    /**
     * Supported file types.
     * @var array
     */
    public $fileTypes;

    /**
     * @var bool Has the model been bound.
     */
    protected $isBound = false;

    /**
     * @var bool Is the related attribute a "many" type.
     */
    public $isMulti = false;

    /**
     * @var Collection
     */
    public $fileList;

    /**
     * @var Model
     */
    public $singleFile;

    public function componentDetails()
    {
        return [
            'name'        => 'File Uploader',
            'description' => 'Upload a file'
        ];
    }

    public function defineProperties()
    {
        return [
            'placeholderText' => [
                'title'       => 'Placeholder text',
                'description' => 'Wording to display when no file is uploaded',
                'default'     => 'Click or drag files to upload',
                'type'        => 'string',
            ],
            'removeText' => [
                'title'       => 'Remove Popup text',
                'description' => 'Wording to display in the popup when you remove file',
                'default'     => 'Are you sure ?',
                'type'        => 'string',
            ],
            'maxSize' => [
                'title'       => 'Max file size (MB)',
                'description' => 'The maximum file size that can be uploaded in megabytes.',
                'default'     => '5',
                'type'        => 'string',
            ],
            'fileTypes' => [
                'title'       => 'Supported file types',
                'description' => 'File extensions separated by commas (,) or star (*) to allow all types.',
                'default'     => '*',
                'type'        => 'string',
            ],
            'deferredBinding' => [
                'title'       => 'Use deferred binding',
                'description' => 'If checked the associated model must be saved for the upload to be bound.',
                'type'        => 'checkbox',
            ],
        ];
    }

    public function init()
    {
        $this->fileTypes = $this->processFileTypes(true);
        $this->maxSize = $this->property('maxSize');
        $this->placeholderText = $this->property('placeholderText');
        $this->removeText = $this->property('removeText');
    }

    public function onRun()
    {
        $this->addCss('assets/css/uploader.css');
        $this->addJs('assets/vendor/dropzone/dropzone.js');
        $this->addJs('assets/js/uploader.js');

        if ($result = $this->checkUploadAction()) {
            return $result;
        }

        $this->fileList = $fileList = $this->getFileList();
        $this->singleFile = $fileList->first();
    }

    public function onRender()
    {
        if (!$this->isBound) {
            throw new ApplicationException('There is no model bound to the uploader!');
        }

        if ($populated = $this->property('populated')) {
            $this->setPopulated($populated);
        }
    }

    /**
     * Adds the bespoke attributes used internally by this widget.
     * - thumbUrl
     * - pathUrl
     * @return System\Models\File
     */
    protected function decorateFileAttributes($file)
    {
        $file->pathUrl = $file->thumbUrl = $file->getPath();

        return $file;
    }

    public function onRemoveAttachment()
    {
        if (($file_id = post('file_id')) && ($file = File::find($file_id))) {
            $this->model->{$this->attribute}()->remove($file, $this->getSessionKey());
        }
    }

}