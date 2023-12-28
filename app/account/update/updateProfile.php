<?php
    header("Access-Control-Request-Method: POST");
    header("Cross-Origin-Resource-Policy: same-origin");
    use Data\Test_data;
    
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/__allow_include.php");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "config.php");
    @require($_SERVER['DOCUMENT_ROOT'] . "/" . "appStart/access.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["userID"])) {
            if($_POST["userName"] != USER["UserName"] || 
               $_POST["dayOfBirth"] != USER["DayOfBirth"] || 
               $_POST["yearOfBirth"] != USER["YearOfBirth"] || 
               $_POST["monthOfBirth"] != USER["MonthOfBirth"] || 
               $_POST["LINE"] != USER["LINE"]) {


                   $userName = $day_of_birth = $year_of_birth = $month_of_birth = $LINE = "";
                   $userNameErr = $day_of_birthErr = $year_of_birthErr = $month_of_birthErr = $BIOErr = $userIDExist = false;
                   $update = true;
                   http_response_code(102);
       
                   if(empty($_POST["userName"])) {
                       $userNameErr = true;
                       $update = false;
                   } else {
                       $userNameX = new Test_data($_POST["userName"]);
                       if(!$userNameX->stringIsPlainAndValid()) {
                           $userNameErr = true;
                           $update = false;
                       } else {
                           $userName = $userNameX->return;
                       }
                   }
       
                   if(empty($_POST["dayOfBirth"])) {
                       $day_of_birthErr = true;
                       $update = false;
                   } else {
                       $dayOfBirthX = new Test_data($_POST["dayOfBirth"]);
                       if(!$dayOfBirthX->isVal_num()) {
                           $day_of_birthErr = true;
                           $update = false;
                       } else {
                           $day_of_birth = $dayOfBirthX->return;
                       }
                   }
       
                   if(empty($_POST["yearOfBirth"])) {
                       $year_of_birthErr = true;
                       $update = false;
                   } else {
                       $yearOfBirthX = new Test_data($_POST["yearOfBirth"]);
                       if(!$yearOfBirthX->isVal_num()) {
                           $year_of_birthErr = true;
                           $update = false;
                       } else {
                           $year_of_birth = $yearOfBirthX->return;
                       }
                   }
       
                   if(empty($_POST["monthOfBirth"])) {
                       $month_of_birthErr = true;
                       $update = false;
                   } else {
                       $monthOfBirthX = new Test_data($_POST["monthOfBirth"]);
                       if(!$monthOfBirthX->stringIsPlainAndValid()) {
                           $month_of_birthErr = true;
                           $update = false;
                       } else {
                           $month_of_birth = $monthOfBirthX->return;
                       }
                   }
       
                   if(empty($_POST["LINE"])) {
                       $LINE = null;
                   } else {
                       $LINE = $_POST["LINE"];
                       $LINE = str_replace("&quot;", '"', $LINE);
                       $LINE = str_replace("&bsol;", "\\", $LINE);
                       $LINE = str_replace("&apos;", "'", $LINE);
                       $LINE = stripslashes($LINE);
                       $LINE = preg_replace("/\s+/", " ", $LINE);
                       $LINE = htmlspecialchars($LINE);
                       $LINE = trim($LINE);
                       if(strlen($LINE) > 120) {
                           $BIOErr = true;
                           $update = false;
                       } else {
                           $LINE = stripslashes($LINE);
                           $LINE = str_replace('"', "&quot;", $LINE);
                           $LINE = str_replace('\\', "&bsol;", $LINE);
                           $LINE = str_replace("'", "&apos;", $LINE);
                       }
                   }
       
       
       
                   if($update === true) {
       
                       http_response_code(200);
                       $SQL = "UPDATE users SET UserName=?, DayOfBirth=?, YearOfBirth=?, MonthOfBirth=?, LINE=? WHERE ID=?;";
                       $stmt = $connection->prepare($SQL);
                       $stmt->bind_param("siissi", $v1, $v2, $v3, $v4, $v5, $v6);
                       $v1 = $userName;
                       $v2 = $day_of_birth;
                       $v3 = $year_of_birth;
                       $v4 = $month_of_birth;
                       $v5 = $LINE;
                       $v6 = USER["ID"];
                       $stmt->execute();
                       $stmt->close();
                       $connection->close();
                       http_response_code(308);
       
       
                   } else {
                       $error = array(
                           "userID" => '',
                           "userName" => $userNameErr,
                           "dayOfBirth" => $day_of_birthErr,
                           "yearOfBirth" => $year_of_birthErr,
                           "monthOfBirth" => $month_of_birthErr,
                           "LINE" => $BIOErr,
                           "userIDExist" => $userIDExist
                       );
                       echo json_encode($error);
                       http_response_code(400);
                   }

            } else {
                echo "Same information";
            }

        }
    }
?>