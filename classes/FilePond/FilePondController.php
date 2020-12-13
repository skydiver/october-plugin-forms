<?php

namespace Martin\Forms\Classes\FilePond;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
    public function upload(Request $request)
    {
        $field = $request->headers->get('FILEPOND-FIELD');
        $input = $request->file($field);
        $this->file = is_array($input) ? $input[0] : $input;

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
    public function delete(Request $request)
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
     * Generate unique temporary filename
     *
     * @return string
     */
    private function generateTempFilename()
    {
        return vsprintf('%s%s%s__%s', [
            $this->filepond->getTempPath(),
            DIRECTORY_SEPARATOR,
            str_random(8),
            $this->file->getClientOriginalName()
        ]);
    }
}
