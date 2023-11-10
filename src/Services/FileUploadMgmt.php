<?php
/**
 * FileUploadMgmt service
 * Offer more functions to physically delete uploaded files
 *
 * @author: John
 * @last-mod: 10-11-2023
 */
namespace Enlinea777\LaravelUploader\Services;

use Illuminate\Support\Facades\Storage;
use Enlinea777\LaravelUploader\Services\FileUpload;

class FileUploadMgmt extends FileUpload
{
    /**
     * Physically remove an uploaded file
     * Should be called after removing the associated database record
     * @param $disk      string
     * @param $filepath  $string
     * @return void
     */
    public function delete($disk, $filepath)
    {
        Storage::disk($disk)->delete($filepath);
        $this->deleteFileContainer($disk, dirname($filepath));
    }

    /**
     * Physically remove the container of the uploaded file
     * @param $disk       string
     * @param $container  string
     * @return void
     */
    private function deleteFileContainer($disk, $container)
    {
        if (empty(Storage::disk($disk)->allFiles($container))) {
            Storage::disk($disk)->deleteDirectory($container);
        }
    }
}
