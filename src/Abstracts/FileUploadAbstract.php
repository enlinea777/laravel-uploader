<?php
/**
 * FileUploadAbstract
 *
  * @author: John
 * @last-mod: 10-11-2023
 */
namespace Enlinea777\LaravelUploader\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Enlinea777\LaravelUploader\Contracts\FileUpload as FileUploadContract;

abstract class FileUploadAbstract implements FileUploadContract
{
    /**
     * Default settings
     *
     */
    protected $defaults;

    /**
     * Initialize default settings
     *
     * @return void
     */
    protected function initializeDefaults()
    {
        $this->defaults = [
            'disk' => config('enlinea777_fileupload.default_disk'),
            'directory' => config('enlinea777_fileupload.default_directory'),
            'maxFileSize' => config('enlinea777_fileupload.default_max_file_size'),
            'allowedExtensions' => config('enlinea777_fileupload.default_allowed_extensions'),
        ];
    }

    /**
     * Handle the uploaded file
     *
     * @param Illuminate\Http\Request $request
     * @param string $fieldName
     * @param array $settings
     *
     * @return array|false
     */
    public function handle(Request $request, $fieldName, $settings = [])
    {
        $settings = array_merge($this->defaults, $settings);

        $uploadedFile = $request->file($fieldName);

        if ($this->uploadValidate($uploadedFile, $settings)) {
            return $this->storeFile($uploadedFile, $settings);
        }

        return false;
    }

    /**
     * Validate the uploaded file for extension & size
     *
     * @return bool
     */
    abstract protected function uploadValidate(UploadedFile $uploadedFile, $settings);
    
    /**
     * Return the file extension as extracted from the origin file name
     *
     * @param Illuminate\Http\UploadedFile $uploadedFile
     *
     * @return string
     */
    abstract protected function getExtension(UploadedFile $uploadedFile);

    /**
     * Generate an unique path for storing file from the filename
     *
     * @param Illuminate\Http\UploadedFile $uploadedFile
     *
     * @return string
     */
    abstract protected function generatePath(UploadedFile $uploadedFile);

    /**
     * Return the original filename
     *
     * @param Illuminate\Http\UploadedFile $uploadedFile
     *
     * @return string
     */
    abstract protected function getOriginName(UploadedFile $uploadedFile);

    /**
     * Return the file size
     *
     * @param Illuminate\Http\UploadedFile $uploadedFile
     *
     * @return double
     */
    abstract protected function getFileSize(UploadedFile $uploadedFile);

    /**
     * Physically store the  uploaded file
     *
     * @param Illuminate\Http\UploadedFile $uploadedFile
     * @param array $settings
     *
     * @return array
     */
    abstract protected function storeFile(UploadedFile $uploadedFile, $settings);
}
