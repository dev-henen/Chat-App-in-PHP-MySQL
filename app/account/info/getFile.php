<?php
    if(isset($_GET["ft"])) {
        if(!empty($_GET["ft"])) {
            $file = $_GET["ft"];
            $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $location = "";

            switch($file_type) {
                case "png":
                    $location = "uploads/photo_4598749587394875934593874/";
                    header("Content-type: image/png");
                break;
                case "jpg":
                    $location = "uploads/photo_4598749587394875934593874/";
                    header("Content-type: image/jpg");
                break;
                case "gif":
                    $location = "uploads/photo_4598749587394875934593874/";
                    header("Content-type: image/gif");
                break;
                default:
                    $location = "uploads/";
                    $file = "404.png";
            }
            $location .= $file;
            readfile($_SERVER['DOCUMENT_ROOT'] . "/" . $location);
        }
    }
?>