<?php

namespace App\Helpers;

class VersionJS
{
    public static function Auto($file)
    {
        $path_file = public_path($file);
        if (strpos($file, '/') !== 0 || !file_exists($path_file)) return $file;
        $mtime = filemtime($path_file);
        return env('APP_URL') . sprintf("%s?v=%d", $file, $mtime);
    }
}