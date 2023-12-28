<?php 
    namespace App;

    if(!defined("INCLUDE_APP_STARTER_0000000X3949472934938498_PACK")) exit;
    final class App_Start {
        public static $configs;
        public function __construct()
        {
            self::$configs = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/App.ini");
        }
    }

?>