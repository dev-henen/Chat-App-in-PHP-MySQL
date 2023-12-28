<?php

    header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
    header('Cross-Origin-Resource-Policy: same-origin');
    session_start();
    use App\App_Start;
    use Database\Connection;

    if (!defined('INCLUDE_APP_STARTER_0000000X3949472934938498_PACK')) {
        exit;
    }
    define('USER_AGENT', $_SERVER['HTTP_USER_AGENT']);
    $device = 'desktop';
    if (strpos(strtolower(USER_AGENT), 'mobile')) {
        $device = 'mobile';
    }
    define('DEVICE', $device);
    unset($device);
    @require $_SERVER['DOCUMENT_ROOT'] . "/".'appStart/__allow_include.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/".'appStart/app.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/".'appStart/DataBase.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/".'appStart/test_data.php';

    //Database configuration
    $application = new App_Start();
    $database = new Connection('database_host', 'database_username', 'database_password', 'database_name');

    $database::create_connection();
    $connection = $database::$connection;
    $app_name = $application::$configs['appName'];
    $app_lang = $application::$configs['appLanguage'];
    $app_charset = $application::$configs['appCharset'];
    $max_file_content = $application::$configs['maxFileContent'];
    $max_execution_time = $application::$configs['maxExecutionTime'];
    $images_location = $application::$configs['imagesLocation'];
    $image_upload_location = $application::$configs['imageUploadLocation'];
    $video_upload_location = $application::$configs['videoUploadLocation'];
    $upload_tmp_dir = $application::$configs['uploadTMPDirectory'];
