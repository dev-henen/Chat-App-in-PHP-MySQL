<?php 
    header("Cross-Origin-Resource-Policy: same-origin");
    if(!isset($_SESSION["User"]) || !isset($_SESSION["ID"])) {
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        unset($_SESSION["User"]);
        unset($_SESSION["ID"]);
        @session_destroy();
        @header("Location: /app/account/signIn/");
    } else {
        $SQL = "SELECT ID, Email, UserName, DayOfBirth, YearOfBirth, MonthOfBirth, Photo, RegDate, UserKey, LINE FROM users WHERE ID=? AND Email=?;";
        $STMT = $connection->prepare($SQL);
        $STMT->bind_param("is", $v1, $v2);
        $v1 = (int) $_SESSION["ID"];
        $v2 = (String) $_SESSION["User"];
        $STMT->execute();
        $result = $STMT->get_result();
        if(!$result->num_rows > 0) {
            unset($_SESSION["User"]);
            unset($_SESSION["ID"]);
            session_destroy();
            @header("Location: /?unRegSW=458034859402942");
        } else {
            define("USER", $result->fetch_assoc());
        }
    }
?>