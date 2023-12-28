<?php @require $_SERVER['DOCUMENT_ROOT'] . "/".'appStart/__allow_include.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/".'config.php';
    if (isset($_SESSION['User']) && isset($_SESSION['ID'])) {
        header('Location: /');
        exit;
    }

?>
<!DOCTYPE html>
<html lang="<?php echo $app_lang; ?>">
<head>
    <meta charset="<?php echo $app_charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login in to your <?php echo $app_name; ?> account to chat new friends">
    <meta name="keywords" content="Login, <?php echo $app_name; ?>, account, chat, friends">
    <title> <?php echo $app_name; ?> </title>
    <link rel="stylesheet" type="text/css" href="/app/assets/@i/bootstrap-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=_app.css"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=_signForm.css"/>
</head>
<body>

    <div class="signup">
        <div id="loader"><div><div></div></div></div>
        <?php @include $_SERVER['DOCUMENT_ROOT'] . "/".'app/paths/logo.php'; ?>
        <h1>Sign in</h1>
        <form method="post" action="" onsubmit="return false;">

            <div class="input text">
                <label for="email">User</label>
                <div>
                    <i class="bi bi-person"></i>
                    <input type="email" placeholder="Email, Username, ID" name="email" oninput="validateEmail();"/>
                </div>
            </div>

            <div class="input password">
                <label for="password">Password</label>
                <div>
                    <i class="bi bi-key"></i>
                    <input type="password" placeholder="Password" name="password" oninput="validatePassword();"/>
                </div>
            </div>
            
            <div class="footer">
                <div>
                    <br/>
                    <p>Don't have account? <a href="/app/account/signup/">sign up</a></p>
                    <br/>
                    <br/>
                </div>
                <input type="submit" name="signIn" value="next" onclick="loginAccount();"/>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="./account_signIn.js"></script>
</body>
</html>