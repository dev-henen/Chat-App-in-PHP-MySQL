<?php

    use Data\Test_data;
    use Data\Test_file;

    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["userID"])) {
            $send = true;
            
            if(!empty($_POST["messageType"]) && $_POST["messageType"] == "image") {
                if(empty($_POST["userID"]) || empty($_FILES["messageBody"]["name"]) || empty($_POST["messageType"])) exit;

                $messageType = new Test_data($_POST["messageType"]);
                $userID = new Test_data($_POST["userID"]);
                $messageBodyTest = new Test_file($_FILES["messageBody"]);
                $sql = "INSERT INTO messages(UserFrom, UserTo, MessageType, MessageBody) VALUES(?, ?, ?, ?)";

                if(!$messageType->stringIsPlainAndValid()) { $send = false; } elseif($messageType->ignore_len("GREAT", 10)) {
                    $send = false;
                }
                if(!$userID->isVal_num()) { $send = false; } elseif($userID->ignore_len("GREAT", 200)) {
                    $send = false;
                }
                if(!$messageBodyTest->is_real_image()) { $send = false; }
                $ID = $userID->return;
                settype($ID, "integer");
                
            }



            if($send === true) {
                $upload_file = new Data\Upload_file($messageBodyTest->return);
                $upload_file->set_folder($upload_tmp_dir);
                if($upload_file->permit(["png", "jpg", "gif", "jpeg"])){
                    if(!$upload_file->isExisting()){
                        if($upload_file->maxFileSize(10000000)) $send = false;
                        if($send === true && !$upload_file->move_to_folder()) $send = false;
                        if(!$upload_file->rename(null,"JPG")){
                            $send = false;
                            $file_url = $upload_file->target_file;
                        } else { $file_url = $upload_file->auto_generated_name; }
                    }else{ $send = false;  }
                }else{ $send = false; }

                if($send === true) {
                    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/move_file.php");
                    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/compress.php");
                    @compress($_SERVER['DOCUMENT_ROOT'] . "/" . $file_url, $_SERVER['DOCUMENT_ROOT'] . "/" .  $file_url, 10);
                    $move = move_file($file_url, $upload_tmp_dir, $image_upload_location);
                    if(!$move) { @unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $file_url); $send = false; } else {
                        echo "file uploaded: " . $upload_file->file_new_name;
                    }
                }


                if($send === true) {
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("iiss", $v1, $v2, $v3, $v4);
                    $v1 = (int) USER["ID"];
                    $v2 = (int) $ID;
                    $v3 = $messageType->return;
                    $v4 = (String) $upload_file->file_new_name;
                    $stmt->execute();
                    $stmt->close();
                    $connection->close();
                }
            }

            
        }
    }
?>