<?php

namespace Martin\Forms\Classes\FilePond;

use Validator;
use Illuminate\Http\Request;
use Martin\Forms\Models\Settings;
use Illuminate\Support\Facades\Response;
use October\Rain\Filesystem\Definitions;
use Illuminate\Routing\Controller as BaseController;

class FilePondController extends BaseController
{
    /**
     * @var Filepond
     */
    private $filepond;

    /**
     * @var Illuminate\Http\UploadedFile
     */
    private $file;

    public function __construct(FilePond $filepond)
    {
        $this->filepond = $filepond;
    }

    /**
     * Uploads the file to the temporary directory
     * and returns an encrypted path to the file
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request): \Illuminate\Http\Response
    {
        $field = $this->getUploadFieldName();
        $input = $request->file($field);
        $this->file = is_array($input) ? $input[0] : $input;

        /** VALIDATE UPLOAD FILE TYPE */
        if ($this->checkInvalidFile()) {
            return Response::make('File type not allowed', 422, [
                'Content-Type' => 'text/plain',
            ]);
        }

        if ($input === null) {
            return Response::make($field . ' is required', 422, [
                'Content-Type' => 'text/plain',
            ]);
        }

        $filePath = $this->generateTempFilename();
        $filePathParts = pathinfo($filePath);

        if (!$this->file->move($filePathParts['dirname'], $filePathParts['basename'])) {
            return Response::make('Could not save file', 500, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make($this->filepond->getServerIdFromPath($filePath), 200, [
            'Content-Type' => 'text/plain',
        ]);
    }

    /**
     * Takes the given encrypted filepath and deletes
     * it if it hasn't been tampered with
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request): \Illuminate\Http\Response
    {
        $filePath = $this->filepond->getPathFromServerId($request->getContent());

        if (unlink($filePath)) {
            return Response::make('', 200, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make('', 500, [
            'Content-Type' => 'text/plain',
        ]);
    }

    /**
     * Get field name used for uploads
     *
     * @return string
     */
    private function getUploadFieldName(): string
    {
        return request()->headers->get('FILEPOND-FIELD');
    }

    /**
     * Generate unique temporary filename
     *
     * @return string
     */
    private function generateTempFilename(): string
    {
        return vsprintf('%s%s%s__%s', [
            $this->filepond->getTempPath(),
            DIRECTORY_SEPARATOR,
            str_random(8),
            $this->file->getClientOriginalName()
        ]);
    }

    /**
     * Check if uploaded file is a valid mime type
     *
     * @return boolean
     */
    private function checkInvalidFile(): bool
    {
        $field = $this->getUploadFieldName();
        $types = $this->allowedFileTypes();

        $validator = Validator::make(request()->all(), [
            $field . '.*' => 'mimes:' . $types,
        ]);

        return $validator->fails();
    }

    /**
     * Get a list of allowed files types
     *
     * @return string
     */
    private function allowedFileTypes(): string
    {
        $settings = Settings::get('global_allowed_files', false);

        if ($settings) {
            return $settings;
        }

        $default = Definitions::get('defaultExtensions');

        return implode(',', $default);
    }
}
