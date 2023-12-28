<?php 
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");

    if(isset($_GET["time"])) {
        if(!empty($_GET["time"])) {
            $time = $_GET["time"];
            if(!preg_match("/^[A-Za-z0-9- :)(\/ ]*$/", $time)) {
                $time = date("l M d Y H:i:s");
            }
            echo $time;

            $stmt = $connection->prepare("UPDATE users SET ActiveStatus=? WHERE ID=?;");
            $stmt->bind_param("si", $v1, $v2);
            $v1 = (String) $time;
            $v2 = (int) USER["ID"];
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }
    }
?>