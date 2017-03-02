<?php
namespace App\Services\FileManager;


use Illuminate\Http\UploadedFile;

interface HandlerInterface
{
    /**
     * @param UploadedFile $file
     * @return string|false filename
     */
    public function store(UploadedFile $file);

    /**
     * @param string $filename
     * @return boolean true|false
     */
    public function delete($filename);

    /**
     * @param $relativePath
     * @return string url
     */
    public static function link($relativePath);
}