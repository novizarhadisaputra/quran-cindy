<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GlobalHelper
{
    public function downloadFile($url, $fileId)
    {
        $contents = file_get_contents($url);
        $fileMime = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        $fileName = $fileId . '.' . $fileMime;
        $filePath = '/' . $fileMime;
        Storage::disk('asset')->put($filePath . '/' . $fileName, $contents);
        return (object) [
            'file_mime' => $fileMime,
            'file_name' => $fileName,
            'file_path' => $filePath
        ];
    }

    public function getFile($filePath, $fileName)
    {
        $url = Storage::disk('asset')->url($filePath . '/' . $fileName);
        return $url;
    }
}
