<?php

    use Data\Test_data;

    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["userID"])) {
            $send = true;
            
            if(!empty($_POST["messageType"]) && $_POST["messageType"] == "text") {
                if(empty($_POST["userID"]) || empty($_POST["messageBody"]) || empty($_POST["messageType"])) exit;
                if(isset($_POST["reply"]) && !empty($_POST["reply"])) {
                    $reply = new Test_data($_POST["reply"]);
                    $replyText = $reply->return;
                } else {
                    $replyText = null;
                }
                if(strlen($replyText) > 1000) {
                    $replyText = null;
                }
                $messageType = new Test_data($_POST["messageType"]);
                $userID = new Test_data($_POST["userID"]);
                $messageBody = new Test_data($_POST["messageBody"]);
                $sql = "INSERT INTO messages(UserFrom, UserTo, MessageType, MessageBody, ReplyBody) VALUES(?, ?, ?, ?, ?)";

                if(!$messageType->stringIsPlainAndValid()) {
                    $send = false;
                } elseif($messageType->ignore_len("GREAT", 10)) {
                    $send = false;
                }

                if(!$userID->isVal_num()) {
                    $send = false;
                } elseif($userID->ignore_len("GREAT", 200)) {
                    $send = false;
                }

                $message = $messageBody->return;
                $message = str_replace("\n", "<br>", $message);
                $message = str_replace("\\", "&bsol;", $message);
                $message = str_replace('"', "&quot;", $message);
                $message = str_replace("'", "&apos;", $message);
                $ID = $userID->return;
                settype($ID, "integer");
                if(strlen($message) > 5000) {
                    $send = false;
                }
                
            }



            if($send === true) {
                echo $message;
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("iisss", $v1, $v2, $v3, $v4, $v5);
                $v1 = (int) USER["ID"];
                $v2 = (int) $ID;
                $v3 = $messageType->return;
                $v4 = $message;
                $v5 = $replyText;
                $stmt->execute();
                $stmt->close();
                $connection->close();
            }

            
        }
    }
?>