<?php @require $_SERVER['DOCUMENT_ROOT'] . "/" . 'appStart/__allow_include.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/" . 'config.php';
    @require $_SERVER['DOCUMENT_ROOT'] . "/" . 'appStart/access.php';

    $layout = '_web.css';
    if (DEVICE == 'mobile') {
        $layout = '_mobile.css';
    }

?>
<!DOCTYPE html>
<html lang="<?php echo $app_lang; ?>">
<head>
    <meta charset="<?php echo $app_charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $app_name; ?> </title>
    <link rel="stylesheet" type="text/css" href="/app/assets/@i/bootstrap-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=_app.css"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=<?php echo $layout; ?>"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=_profile.css"/>
    <link rel="stylesheet" type="text/css" href="/app/assets/getFile.php?ft=_settings.css"/>
</head>
<body>

<div id="fly"><div><h1 class="LOGO" style="text-align:center !important;"><?php echo $app_name; ?></h1><div id="loading"><span></span></div></div></div>
<script type="text/javascript" defer>
     let stopLoad = setInterval(()=>{
        try {
            if(document.readyState == "complete") {
                setTimeout(()=>{
                    document.getElementById("fly").style.display = "none";
                    clearInterval(stopLoad);
                }, 2000);
            }
        } catch(e) {
            console.log(e.message);
        }
    }, 1000);
    setTimeout(()=>{
        clearInterval(stopLoad);
    }, 1000 * (60 * 2));
</script>
<div class="left top">
    <div class="in-left">
        <a href="/" title="<?php echo $_SERVER["HTTP_HOST"]; ?>"><i class="bi bi-chat-dots-fill"></i></a>
    </div>
    <nav class="in-left"> <?php @include $_SERVER['DOCUMENT_ROOT'] . "/".'app/paths/navigation.php'; ?> </nav>
    <div class="in-left">
        <div class="icon" onclick="navigateProfile(<?php echo USER['ID']; ?>);"><img id="iconInNavigation" src="/app/account/info/getFile.php?ft=<?php echo (USER['Photo'] == 'default') ? 'default.png' : USER['Photo']; ?>" width="30px" height="30px" alt="icon"/></div>
        <div> <i class="bi bi-three-dots"></i> </div>
    </div>
</div>

<div class="middle">
    <div>
        <header>
            <h2>Chats</h2>
            <form method="post" action="" onsubmit="return false;">
                <button title="Search"><i class="bi bi-search"></i></button>
                <input type="search" name="search" placeholder="Search in chat.." oninput="searchChat(this);" autocomplete="off">
                <div class="result" id="chats-search-result-main">
                    <b>Search result:</b><br/>
                    <ul id="chats-search-result"></ul>
                </div>
            </form>
        </header>

        <div class="chats" id="chats"></div>


    </div>
</div>

<div class="right" id="root">
    <?php if(DEVICE != "mobile") { ?>
        <img src="/app/assets/getFile.php?ft=security-page-account-access.515954bdc01de2fefb0e221ee93ac7a0.svg" alt="Image" width="100%" id="rootBanner"/> 
    <?php } ?>
</div>
<div class="view-box" id="viewBox"><div class="view" id="viewRoot"></div></div>
<div class="ajax" id="ajax"><div class="loader"></div></div>
<script>
    let viewBox = document.getElementById("viewBox");
    let viewRoot = document.getElementById("viewRoot");
    window.addEventListener("click", (event)=>{
        if(event.target == viewBox) {
            viewRoot.innerHTML = "";
            viewBox.style.display = "none";
        }
    });
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/".'app/chats/chats.php';
    include $_SERVER['DOCUMENT_ROOT'] . "/".'app/message/message.php';
    include $_SERVER['DOCUMENT_ROOT'] . "/".'app/profile/profile.php';
    include $_SERVER['DOCUMENT_ROOT'] . "/".'app/account/settings/settings.php';
?>
<script src="/app/chats/add.js"></script>
<script src="/app/account/update/online.js"></script>
<script src="/app/chats/search.js"></script>
</body>
</html>