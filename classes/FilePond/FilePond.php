<?php

namespace Martin\Forms\Classes\FilePond;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class FilePond
{
    /**
     * Converts the given path into a filepond server id
     *
     * @param string $path
     * @return string
     */
    public function getServerIdFromPath($path)
    {
        return Crypt::encryptString($path);
    }

    /**
     * Converts the given filepond server id into a path
     *
     * @param string $serverId
     * @return string
     */
    public function getPathFromServerId($serverId)
    {
        if (!trim($serverId)) {
            throw new InvalidPathException();
        }

        $filePath = Crypt::decryptString($serverId);
        $tempPath = $this->getTempPath();

        if (!Str::startsWith($filePath, $tempPath)) {
            throw new InvalidPathException();
        }

        return $filePath;
    }

    public function getTempPath()
    {
        $defaultPath = temp_path('magic-forms-temp');

        if (File::exists($defaultPath)) {
            return $defaultPath;
        }

        File::makeDirectory($defaultPath);
        return $defaultPath;
    }
}
