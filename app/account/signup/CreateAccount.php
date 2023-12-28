<?php

    header('Access-Control-Request-Method: POST');
    header('Cross-Origin-Resource-Policy: same-origin');
    use Data\Test_data;

    @require $_SERVER['DOCUMENT_ROOT'] . "/" . 'appStart/__allow_include.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/" . 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['CreateAccount'])) {
            $email = $username = $day_of_birth = $year_of_birth = $month_of_birth = $password = '';
            $emailErr = $usernameErr = $day_of_birthErr = $year_of_birthErr = $month_of_birthErr = $passwordErr = $emailExist = false;
            $submit = true;
            http_response_code(102);

            if (empty($_POST['email'])) {
                $emailErr = true;
                $submit = false;
            } else {
                $emailX = new Test_data($_POST['email']);
                if (!$emailX->isVal_email()) {
                    $emailErr = true;
                    $submit = false;
                } else {
                    $email = (string) filter_var($emailX->return, FILTER_SANITIZE_EMAIL);
                    $sql = "SELECT ID FROM users WHERE Email='$email';";
                    $result = $connection->query($sql);
                    if ($result->num_rows > 0) {
                        $submit = false;
                        $emailExist = true;
                    }
                }
            }

            if (empty($_POST['username'])) {
                $usernameErr = true;
                $submit = false;
            } else {
                $userNameX = new Test_data($_POST['username']);
                if (!$userNameX->stringIsPlainAndValid()) {
                    $usernameErr = true;
                    $submit = false;
                } else {
                    $username = $userNameX->return;
                }
            }

            if (empty($_POST['dayOfBirth'])) {
                $day_of_birthErr = true;
                $submit = false;
            } else {
                $dayOfBirthX = new Test_data($_POST['dayOfBirth']);
                if (!$dayOfBirthX->isVal_num()) {
                    $day_of_birthErr = true;
                    $submit = false;
                } else {
                    $day_of_birth = $dayOfBirthX->return;
                }
            }

            if (empty($_POST['yearOfBirth'])) {
                $year_of_birthErr = true;
                $submit = false;
            } else {
                $yearOfBirthX = new Test_data($_POST['yearOfBirth']);
                if (!$yearOfBirthX->isVal_num()) {
                    $year_of_birthErr = true;
                    $submit = false;
                } else {
                    $year_of_birth = $yearOfBirthX->return;
                }
            }

            if (empty($_POST['monthOfBirth'])) {
                $month_of_birthErr = true;
                $submit = false;
            } else {
                $monthOfBirthX = new Test_data($_POST['monthOfBirth']);
                if (!$monthOfBirthX->stringIsPlainAndValid()) {
                    $month_of_birthErr = true;
                    $submit = false;
                } else {
                    $month_of_birth = $monthOfBirthX->return;
                }
            }

            if (empty($_POST['password'])) {
                $passwordErr = true;
                $submit = false;
            } else {
                $passwordX = new Test_data($_POST['password']);
                $password = $passwordX->encrypt_password();
            }

            if ($submit === true) {
                $keys = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                $userKey = @substr($email, 0, @strpos($email, '@'));
                $userKey = @str_replace('@', '', $userKey);

                for ($i = 0; $i < count($keys); ++$i) {
                    $index = (int) rand(0, count($keys) - 1);
                    $sql = "SELECT ID FROM users WHERE UserKey='$userKey';";
                    $result = $connection->query($sql);
                    $userKey .= $keys[$index];
                    if (!$result->num_rows > 0) {
                        break;
                    }
                }
                $userKey = '@'.$userKey;

                http_response_code(200);
                $SQL = 'INSERT INTO users(Email, UserName, DayOfBirth, YearOfBirth, MonthOfBirth, Password, UserKey) VALUES(?, ?,?,?,?,?,?);';
                $stmt = $connection->prepare($SQL);
                $stmt->bind_param('ssiisss', $v1, $v2, $v3, $v4, $v5, $v6, $v7);
                $v1 = $email;
                $v2 = $username;
                $v3 = $day_of_birth;
                $v4 = $year_of_birth;
                $v5 = $month_of_birth;
                $v6 = $password;
                $v7 = $userKey;
                $stmt->execute();
                http_response_code(201);
                $_SESSION['User'] = $email;
                $_SESSION['ID'] = $stmt->insert_id;
                $stmt->close();
                $connection->close();
                http_response_code(308);
            } else {
                $error = [
                    'email' => $emailErr,
                    'username' => $usernameErr,
                    'dayOfBirth' => $day_of_birthErr,
                    'yearOfBirth' => $year_of_birthErr,
                    'monthOfBirth' => $month_of_birthErr,
                    'password' => $passwordErr,
                    'emailExist' => $emailExist,
                ];
                echo json_encode($error);
                http_response_code(400);
            }
        }
    }
