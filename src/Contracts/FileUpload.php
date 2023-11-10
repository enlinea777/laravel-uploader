<?php
/**
 * FileUpload contract
 *
 * @author: John
 * @last-mod: 10-11-2023
 */
namespace Enlinea777\LaravelUploader\Contracts;

use Illuminate\Http\Request;

interface FileUpload
{

    /**
     * Handle the uploaded file
     *
     * @param Illuminate\Http\Request $request
     * @param string $fieldName
     * @param array $settings
     *
     * @return mixed $path|false
     */
    public function handle(Request $request, $fieldName, $settings = []);
}
