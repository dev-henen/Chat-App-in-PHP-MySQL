<?php
    header("Access-Control-Request-Method: POST");
    header("Cross-Origin-Resource-Policy: same-origin");
    use Data\Test_data;
    
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["LoginAccount"])) {
            $email = $password = "";
            $emailErr = $passwordErr = $emailExist = false;
            $submit = true;
            http_response_code(102);

            if(empty($_POST["email"])) {
                $emailErr = true;
                $submit = false;
            } else {
                $emailX = new Test_data($_POST["email"]);
                if(!$emailX->isVal_email()) {
                    $emailErr = true;
                    $submit = false;
                } else {
                    $email = (String) filter_var($emailX->return, FILTER_SANITIZE_EMAIL);
                    $sql = "SELECT ID, Password FROM users WHERE Email='$email';";
                    $result = $connection->query($sql);
                    if($result->num_rows > 0) {
                        $emailExist = true;
                        $row = $result->fetch_assoc();
                        $password = (String) $row["Password"];
                        $ID = (int) $row["ID"];
                    } else {
                        $submit = false;
                        $emailExist = false;
                    }
                }
            }

            if(empty($_POST["password"])) {
                $passwordErr = true;
                $submit = false;
            } else {
                $passwordX = new Test_data($_POST["password"]);
                if(!$passwordX->decrypt_password($password)) {
                    $submit = false;
                    $passwordErr = true;
                }
            }

            if($submit === true) {
                http_response_code(200);
                
                $_SESSION["User"] = $email;
                $_SESSION["ID"] = $ID;
                
                if($passwordX->needHash()) {
                    $password = $passwordX->encrypt_password();
                    $stmt = $connection->prepare("UPDATE users SET Password=? WHERE Email=?;");
                    $stmt->bind_param("ss", $v1, $v2);
                    $v1 = $password;
                    $v2 = $email;
                    $stmt->execute();
                    $stmt->close();
                }
                $connection->close();

                http_response_code(308);


            } else {
                $error = array(
                    "email" => $emailErr,
                    "password" => $passwordErr,
                    "emailExist" => $emailExist
                );
                echo json_encode($error);
                http_response_code(400);
            }

        }
    }
?>