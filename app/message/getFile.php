<?php

@require $_SERVER['DOCUMENT_ROOT'] . "/".'appStart/__allow_include.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/".'config.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/".'appStart/access.php';

    if (isset($_GET['ft'])) {
        if (!empty($_GET['ft'])) {
            $file = $_GET['ft'];
            $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $location = $image_upload_location;

            $location .= $file;
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/".$location)) {
                readfile($_SERVER['DOCUMENT_ROOT'] . "/".$location);
            } else {
                readfile($_SERVER['DOCUMENT_ROOT'] . "/".$image_upload_location."../404.png");
            }
        }
    }
