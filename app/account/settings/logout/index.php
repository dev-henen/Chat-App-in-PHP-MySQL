
<?php 
    session_start();
    if(isset($_SESSION["ID"]) && isset($_SESSION["User"])) {
        unset($_SESSION["ID"]);
        unset($_SESSION["User"]);
        session_destroy();
        header("Location: /app/account/signIn/");
    } else {
        header("Location: /error.html");
    }
?>