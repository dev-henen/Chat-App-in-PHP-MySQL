<?php

    if (isset($_GET['ft'])) {
        if (!empty($_GET['ft'])) {
            $file = $_GET['ft'];
            $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $location = '';

            switch ($file_type) {
                case 'css':
                    $location = 'css/';
                    header('Content-type: text/css');
                break;
                case 'js':
                    $location = 'js/';
                    header('Content-type: text/javascript');
                break;
                case 'png':
                    $location = 'images/';
                    header('Content-type: image/png');
                break;
                case 'jpg':
                    $location = 'images/';
                    header('Content-type: image/jpg');
                break;
                case 'gif':
                    $location = 'images/';
                    header('Content-type: image/gif');
                break;
                case 'svg':
                    $location = 'images/';
                    header('Content-type: image/svg+xml');
                break;
                default:
                    $location = '404.png';
            }
            $location .= $file;
            readfile($location);
        }
    }
