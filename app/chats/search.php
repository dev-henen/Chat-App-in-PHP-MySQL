<?php 
    header("Cross-Origin-Resource-Policy: same-origin");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    if(!isset($_SESSION["User"]) || !isset($_SESSION["ID"])) {
        exit;
    } else {

        if(isset($_GET['q']) && !empty($_GET['q'])) {

            $q = trim(stripslashes($_GET['q']));
            $q = preg_replace('/[^a-zA-Z0-9 ]/', '', $q);
            $sql = 'SELECT `UserName`, `Photo`, `UserKey` FROM `users` WHERE `UserName`LIKE "%'.$q.'%" OR `UserKey` LIKE "%'.$q.'%" AND NOT `ID`='.USER['ID'].' ORDER BY `UserKey` LIMIT 20;';
            $result = $connection->query($sql);
            if($result->num_rows > 0) {

                echo json_encode($result->fetch_all(MYSQLI_ASSOC));

            } else {
                http_response_code(204);
            }

        }

    }