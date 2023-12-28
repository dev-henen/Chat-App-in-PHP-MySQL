<?php 
    header("Cross-Origin-Resource-Policy: same-origin");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");

    if(isset($_GET["userID"])) {
        $userID = $_GET["userID"];
        settype($userID, "integer");
        
        $SQL = "SELECT ID, Email, UserName, DayOfBirth, YearOfBirth, MonthOfBirth, Photo, RegDate, LINE, UserKey FROM users WHERE ID=?";
        $STMT = $connection->prepare($SQL);
        $STMT->bind_param("i", $v1);
        $v1 = (int) sprintf("%d", $userID);
        $STMT->execute();
        $result = $STMT->get_result();
        if($result->num_rows > 0) {

            $row = $result->fetch_assoc();
    
            $SQL = "SELECT * FROM blocked_contacts WHERE Blocker IN(?,?) AND Blocked IN(?,?)";
            $STMT = $connection->prepare($SQL);
            $STMT->bind_param("ssss", $v1, $v2, $v3, $v4);
            $v1 = USER["UserKey"];
            $v2 = $row["UserKey"];
            $v3 = USER["UserKey"];
            $v4 = $row["UserKey"];
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
            $v2 = $row["UserKey"];
            $v3 = USER["UserKey"];
            $v4 = $row["UserKey"];
            $STMT->execute();
            $result = $STMT->get_result();
            if(!$result->num_rows > 0 && $row["UserKey"] != USER["UserKey"]) {
                http_response_code(403);
                exit;
            }


            echo json_encode($row);

        }

    }
?>