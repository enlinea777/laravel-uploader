<?php
/**
 * laravel-uploader settings
 *
 * @author: John
 * @last-mod: 10-11-2023
 */
return [
    'default_disk' => env('ENLINEA777_LARAVEL_UPLOADER_DEFAULT_DISK', 'public'),
    'default_directory' => env('ENLINEA777_LARAVEL_UPLOADER_DEFAULT_DIRECTORY', 'media'),
    'default_max_file_size' => env('ENLINEA777_LARAVEL_UPLOADER_DEFAULT_MAX_FILE_SIZE', 52428800), // 50 MB
    'default_allowed_extensions' => [
        'png','jpg','jpeg','mp4','doc','docx','ppt','pptx','xls','xlsx','txt','pdf'
    ],
];
