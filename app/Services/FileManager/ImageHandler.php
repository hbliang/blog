<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 2017/2/9
 * Time: 下午8:54
 */

namespace App\Services\FileManager;


use App\Services\FileManager\Exceptions\InvalidException;
use App\Services\FileManager\Exceptions\StoreException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ImageHandler implements HandlerInterface
{
    /**
     * Where the file is saved
     * @var string
     */
    protected $folder;

    protected static $instance;

    public function __construct($folder = 'images')
    {
        $this->folder = $folder;
    }

    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param UploadedFile $file
     * @return string|false filename
     */
    public function store(UploadedFile $file, $options = [])
    {
        if (!$file->isValid()) {
            throw new InvalidException('Uploaded Image is not valid');
        }

        if (isset($options['folder'])) {
            $folder = $options['folder'];    
        } else {
            $folder = $this->folder;
        }
        
        if (isset($options['filename'])) {
            $filename = $options['filename'];
        } else {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension() ?: 'png';
        }

        $storePath = storage_path('app/public/' . $folder);
        if (!$file->move($storePath, $filename)) {
            throw new StoreException('Fail to store image');
        }

        return $folder . '/' . $filename;
    }

    /**
     * @param string $relativePath
     * @return boolean true|false
     */
    public function delete($relativePath)
    {
        $realFilename = storage_path($relativePath);
        
        return File::delete($realFilename);
    }

    /**
     * @param $relativePath
     * @return string url
     */
    public static function link($relativePath)
    {
        return asset('storage/' . $relativePath);
    }
}