<?php 
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    header("Cross-Origin-Resource-Policy: same-origin");
    if(isset($_GET["userID"])) {
        $userID = (int) $_GET["userID"];
        settype($userID, "integer");
        $SQL = "SELECT ID, Email, UserName, Photo, ActiveStatus, UserKey FROM users WHERE ID=? AND NOT ID=?";
        $STMT = $connection->prepare($SQL);
        $STMT->bind_param("ii", $v1, $v2);
        $v1 = sprintf("%d", $userID);
        $v2 = (int) $_SESSION["ID"];
        $STMT->execute();
        $result = $STMT->get_result();
        if($result->num_rows > 0) {
            define("CHATS", $result->fetch_all(MYSQLI_ASSOC));

            $SQL = "SELECT * FROM blocked_contacts WHERE  Blocker IN(?,?) AND Blocked IN(?,?)";
            $STMT = $connection->prepare($SQL);
            $STMT->bind_param("ssss", $v1, $v2, $v3, $v4);
            $v1 = USER["UserKey"];
            $v2 = CHATS[0]["UserKey"];
            $v3 = USER["UserKey"];
            $v4 = CHATS[0]["UserKey"];
            $STMT->execute();
            $result = $STMT->get_result();
            if($result->num_rows > 0) {
                http_response_code(403);
                exit;
            }

            $SQL = "SELECT * FROM contacts WHERE User1 IN(?,?) AND User2 IN(?,?)";
            $STMT = $connection->prepare($SQL);
            $STMT->bind_param("ssss", $v1, $v2, $v3, $v4);
            $v1 = USER["UserKey"];
            $v2 = CHATS[0]["UserKey"];
            $v3 = USER["UserKey"];
            $v4 = CHATS[0]["UserKey"];
            $STMT->execute();
            $result = $STMT->get_result();
            if(!$result->num_rows > 0) {
                http_response_code(403);
                exit;
            }

            echo json_encode(CHATS);
        }
    }
?>
