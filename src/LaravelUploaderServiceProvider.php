<?php
/**
 * LaravelUploaderServiceProvider
 *
 * @author: John
 * @last-mod: 10-11-2023
 */
namespace Enlinea777\LaravelUploader;

use Illuminate\Support\ServiceProvider;
use Enlinea777\LaravelUploader\Services\FileUploadMgmt;
use Enlinea777\LaravelUploader\Contracts\FileUpload as FileUploadContract;

class LaravelUploaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Resources/Assets' => public_path('vendor/fileupload'),
        ], 'enlinea777_fileupload.assets');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FileUploadContract::class, FileUploadMgmt::class);
        $this->mergeConfigFrom(__DIR__.'/Config/enlinea777_fileupload.php', 'enlinea777_fileupload');
    }
}
