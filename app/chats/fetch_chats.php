<?php 
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    header("Cross-Origin-Resource-Policy: same-origin");
    if(!isset($_SESSION["User"]) || !isset($_SESSION["ID"])) {
        exit;
    } else {

        $SQL = "SELECT * FROM contacts WHERE User1=? OR User2=?";
        $STMT = $connection->prepare($SQL);
        $STMT->bind_param("ss", $v1, $v2);
        $v1 = USER["UserKey"];
        $v2 = USER["UserKey"];
        $STMT->execute();
        $result = $STMT->get_result();
        $chats = array();
        if($result->num_rows > 0) {

            $rows = $result->fetch_all(MYSQLI_ASSOC);
            for($i = 0; $i < count($rows); $i++) {
                //print_r($rows);

                $SQL = "SELECT ID, Email, UserName, Photo, ActiveStatus, UserKey FROM users WHERE NOT ID=? AND UserKey IN(?,?)";
                $STMT = $connection->prepare($SQL);
                $STMT->bind_param("iss", $v1, $v2, $v3);
                $v1 = (int) $_SESSION["ID"];
                $v2 = $rows[$i]["User1"];
                $v3 = $rows[$i]["User2"];
                $STMT->execute();
                $result = $STMT->get_result();
                if(!$result->num_rows > 0) { continue; }
                $chat = $result->fetch_assoc();


                $SQL = "SELECT * FROM blocked_contacts WHERE Blocker IN(?, ?) AND Blocked IN(?, ?)";
                $STMT = $connection->prepare($SQL);
                $STMT->bind_param("ssss", $v1, $v2, $v3, $v4);
                $v1 = USER["UserKey"];
                $v2 = $chat["UserKey"];
                $v3 = USER["UserKey"];
                $v4 = $chat["UserKey"];
                $STMT->execute();
                $result = $STMT->get_result();
                if($result->num_rows > 0) { continue; }
                

                array_push($chats, $chat);
                
            }
            echo json_encode($chats);
        }


    }
?>
