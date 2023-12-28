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
    <meta name="description" content="Sign up for <?php echo $app_name; ?> account to discover people and chat them">
    <meta name="keywords" content="Signup, <?php echo $app_name; ?>, account, chat, friends">
    <title> <?php echo $app_name; ?> </title>
    <link rel="stylesheet" type="text/css" href="/app/assets/@i/bootstrap-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=_app.css"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=_signForm.css"/>
</head>
<body>

    <div class="signup">
        <div id="loader"><div><div></div></div></div>
        <?php @include $_SERVER['DOCUMENT_ROOT'] . "/".'app/paths/logo.php'; ?>
        <h1>Sign up</h1>
        <form method="post" action="" onsubmit="return false;">

            <div class="input text">
                <label for="email">Email address</label>
                <div>
                    <i class="bi bi-envelope"></i>
                    <input type="email" placeholder="Email" name="email" oninput="validateEmail();"/>
                </div>
            </div>

            <div class="input text">
                <label for="username">Username | Full Name</label>
                <div>
                    <i class="bi bi-person"></i>
                    <input type="text" placeholder="User" name="username" oninput="validateUsername();"/>
                </div>
            </div>

            <div class="input select number">
                <label for="yearOfBirth, dayOfBirth, monthOfBirth">Date of Birth</label>
                <div class="dateOfBirth">
                    <i class="bi bi-calendar-date"></i>
                    <input type="number" name="dayOfBirth" placeholder="Day" oninput="validateDayOfBirth();"/>
                    <input type="number" name="yearOfBirth" placeholder="Year" oninput="validateYearOfBirth();"/>
                    <select name="monthOfBirth" oninput="validateMonthOfBirth();">
                        <option value="january">January</option>
                        <option value="february">February</option>
                        <option value="march">March</option>
                        <option value="april">April</option>
                        <option value="may">May</option>
                        <option value="june">June</option>
                        <option value="july">July</option>
                        <option value="august">August</option>
                        <option value="september">September</option>
                        <option value="october">October</option>
                        <option value="november">November</option>
                        <option value="december">December</option>
                    </select>
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
                    <p>
                        By click <strong>next</strong>, you agree to our <a href="#">terms and conditions</a>.
                    </p>
                    <p>Have account? <a href="/app/account/signIn/">sign in</a></p>
                </div>
                <input type="submit" name="signup" value="next" onclick="createAccount();"/>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="./account_signup.js"></script>
</body>
</html>