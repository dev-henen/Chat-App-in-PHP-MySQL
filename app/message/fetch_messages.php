<?php 
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    if(isset($_GET["userID"])) {
        $offset = 0;
        if(isset($_GET["offset"]) && !empty($_GET["offset"])) {
            $offset = $_GET["offset"];
            settype($offset, "integer");
        }     
        $user1 = (int) $_GET["userID"];
        $user2 = (int) $_SESSION["ID"]; 
        settype($user1, "integer");
        settype($user2, "integer");
        $sql = sprintf("(SELECT * FROM messages WHERE UserFrom IN(%d, %d) AND UserTo IN(%d, %d) ORDER BY ID DESC LIMIT 10 OFFSET %d) ORDER BY ID;", $user1, $user2, $user1, $user2, $offset);
        $result = $connection->query($sql);
        if($result->num_rows > 0) {
            echo preg_replace("/\s+/", " ", json_encode($result->fetch_all(MYSQLI_ASSOC)));
        }
        $connection->query(sprintf("UPDATE messages SET HaveRead='true' WHERE UserTo=%d AND UserFrom=%d AND HaveRead='false'", $user2, $user1));
    }
?>