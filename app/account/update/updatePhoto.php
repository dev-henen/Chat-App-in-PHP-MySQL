<?php

    use Data\Test_data;
    use Data\Test_file;

    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_FILES["image"]["name"])) {
            $update = false;
            
            if(!empty($_FILES["image"]["name"])) {

                $image = new Test_file($_FILES["image"]);

                if($image->is_real_image()) { $update = true; }
            }



            if($update === true) {
                $upload_file = new Data\Upload_file($image->return);
                $upload_file->set_folder("uploads/photo_4598749587394875934593874/");
                if($upload_file->permit(["png", "jpg", "gif", "jpeg"])){
                    if(!$upload_file->isExisting()){
                        if($upload_file->maxFileSize(10000000)) $update = false;
                        if($update === true && !$upload_file->move_to_folder()) $update = false;
                        if(!$upload_file->rename(null,"JPG")){
                            $update = false;
                            $file_url = $upload_file->target_file;
                        } else { $file_url = $upload_file->auto_generated_name; }
                    }else{ $update = false;  }
                }else{ $update = false; }

                if($update === true) {
                    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/move_file.php");
                    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/compress.php");
                    @compress($_SERVER['DOCUMENT_ROOT'] . "/" . $file_url, $_SERVER['DOCUMENT_ROOT'] . "/" .  $file_url, 5);
                    $move = move_file($file_url, $upload_tmp_dir, $image_upload_location);
                    if(!$move) { @unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $file_url); $update = false; } else {
                        echo $upload_file->file_new_name;
                    }
                }


                if($update === true) {
                    
                    $sql = "UPDATE users SET Photo=? WHERE ID=?;";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("si", $v1, $v2);
                    $v1 = $upload_file->file_new_name;
                    $v2 = (int) USER["ID"];
                    $stmt->execute();
                    $stmt->close();
                    $connection->close();
                    @unlink($_SERVER['DOCUMENT_ROOT'] . "/" . "uploads/photo_4598749587394875934593874/" . USER["Photo"]);
                }
            }

            
        }
    }
?>