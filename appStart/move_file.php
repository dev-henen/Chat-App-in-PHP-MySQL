<?php 
    function move_file($file, $tmp, $dir) {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $file)) {
            $path = str_replace($tmp, $dir, $file);
            if(rename($_SERVER['DOCUMENT_ROOT'] . "/" . $file, $_SERVER['DOCUMENT_ROOT'] . "/" . $path)) {
                return $path;
            } else {
                return false;
            }
        } else { return false; }
    }
?>