<?php 
    header("Cross-Origin-Resource-Policy: same-origin");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    $parseUser = USER;
    if(!isset($_SESSION["User"]) || !isset($_SESSION["ID"])) {
        exit;
    } else {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["UserKey"]) && isset($_POST["UserID"])) {
                if(!empty($_POST["UserKey"]) && !empty($_POST["UserID"])) {
                    $userKey = $_POST["UserKey"];
                    $userID = $_POST["UserID"];
                    settype($userID, "integer");
                    $userKey = trim($userKey);
                    $userKey = stripslashes($userKey);
                    $userKey = htmlspecialchars($userKey);
                    if(preg_match("/^[a-zA-Z0-9]*$/", $userKey)) {
                       http_response_code(502); 
                    } else {

                        $SQL = "SELECT ID FROM users WHERE UserKey=?";
                        $STMT = $connection->prepare($SQL);
                        $STMT->bind_param("s", $v1);
                        $v1 = $userKey;
                        $STMT->execute();
                        $result = $STMT->get_result();
                        if(!$result->num_rows > 0) {
                            http_response_code(404);
                        } else {
                            $person = $result->fetch_assoc();
                            $user1 = USER["UserKey"];
                            $user2 = $userKey;
                            if($person["ID"] == USER["ID"]) {
                                http_response_code(451);
                            } else {
                                //print_r($person);
                                //print_r(USER);
                                $SQL = "SELECT * FROM blocked_contacts WHERE  Blocker=? AND Blocked=?";
                                $STMT = $connection->prepare($SQL);
                                $STMT->bind_param("ss", $v1, $v2);
                                $v1 = $user1;
                                $v2 = $user2;
                                $STMT->execute();
                                $result = $STMT->get_result();
                                if($result->num_rows > 0) {
                                    http_response_code(409);
                                } else {

                                    $SQL = "DELETE FROM messages WHERE UserFrom IN(?,?) AND UserTo IN(?,?)";
                                    $STMT = $connection->prepare($SQL);
                                    $STMT->bind_param("iiii", $v1, $v2, $v3, $v4);
                                    $v1 = $userID;
                                    $v2 = USER["ID"];
                                    $v3 = $userID;
                                    $v4 = USER["ID"];
                                    $STMT->execute();

                                    $SQL = "INSERT INTO blocked_contacts(Blocker, Blocked) VALUES(?,?)";
                                    $STMT = $connection->prepare($SQL);
                                    $STMT->bind_param("ss", $v1, $v2);
                                    $v1 = USER["UserKey"];
                                    $v2 = $userKey;
                                    $STMT->execute();
                                    http_response_code(200);

                                }
                            }
                        }
                    }
                }
            }
        }

    }
?>
