<?php 
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    if(isset($_GET["userFrom"])) {
        $user1 = (int) $_GET["userFrom"];
        $user2 = (int) $_SESSION["ID"];      
        settype($user1, "integer");
        settype($user2, "integer");
        $sql = sprintf("SELECT * FROM messages WHERE UserFrom IN(%d, %d) AND UserTo IN(%d, %d) AND HaveRead='false' ORDER BY ID DESC LIMIT 10;", $user1, $user2, $user1, $user2);
        $result = $connection->query($sql);
        if($result->num_rows > 0) {
            echo preg_replace("/\s+/", " ", str_replace("<br>", " ", json_encode($result->fetch_all(MYSQLI_ASSOC))));
        } else {
            $sql = sprintf("SELECT * FROM messages WHERE UserFrom IN(%d, %d) AND UserTo IN(%d, %d) ORDER BY ID DESC LIMIT 1;", $user1, $user2, $user1, $user2);
            $result = $connection->query($sql);
            if($result->num_rows > 0) {
                echo preg_replace("/\s+/", " ", str_replace("<br>", " ", json_encode($result->fetch_all(MYSQLI_ASSOC))));
            }
        }
    }
?>
