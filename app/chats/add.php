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
            if(isset($_POST["UserKey"])) {
                if(!empty($_POST["UserKey"])) {
                    $userKey = $_POST["UserKey"];
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
                                $SQL = "SELECT * FROM contacts WHERE User1 IN(?, ?) AND User2 IN(?, ?)";
                                $STMT = $connection->prepare($SQL);
                                $STMT->bind_param("ssss", $v1, $v2, $v3, $v4);
                                $v1 = $user1;
                                $v2 = $user2;
                                $v3 = $user1;
                                $v4 = $user2;
                                $STMT->execute();
                                $result = $STMT->get_result();
                                if($result->num_rows > 0) {
                                    http_response_code(409);
                                } else {
    
                                    $SQL = "INSERT INTO contacts(User1, User2, Creator) VALUES(?,?,?)";
                                    $STMT = $connection->prepare($SQL);
                                    $STMT->bind_param("ssi", $v1, $v2, $v3);
                                    $v1 = $userKey;
                                    $v2 = USER["UserKey"];
                                    $v3 = (int) USER["ID"];
                                    $STMT->execute();
                                    http_response_code(201);
                                    echo $person["ID"];

                                }
                            }
                        }
                    }
                }
            }
        }

    }
?>
