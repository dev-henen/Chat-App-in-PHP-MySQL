<?php if (!defined('INCLUDE_APP_STARTER_0000000X3949472934938498_PACK')) {
    exit;
} ?>

<script>
    function settings(close = false) {
        let viewBox = document.getElementById("viewBox");
        let viewRoot = document.getElementById("viewRoot");
        let ajax = document.getElementById("ajax");
        ajax.style.display = "block";

        if(close === true) {
            viewRoot.innerHTML = "";
            viewBox.style.display = "none";
        } else {
            const template = `
                <div id="settings">
                    <header>
                        <div class="back"><i onclick="settings(true);" class="bi bi-reply"></i></div>
                        <div class="icon" onclick="navigateProfile(<?php echo USER['ID']; ?>);"><img id="iconInNavigation" src="/app/account/info/getFile.php?ft=<?php echo (USER['Photo'] == 'default') ? 'default.png' : USER['Photo']; ?>" width="30px" height="30px"/></div>
                        <h3>Settings</h3>
                    </header>

                    <section>
                        <ul>
                            <li> 
                                <i class="bi bi-person-circle"></i>
                                <a href="javascript:void(0)" onclick="navigateProfile(<?php echo USER['ID']; ?>);">Profile</a>
                            </li>
                            <li> 
                                <i class="bi bi-person-lines-fill"></i>
                                <a href="javascript:void(0)" onclick="navigateProfile(<?php echo USER['ID']; ?>);">Edit Profile</a>
                            </li>
                            <li> 
                                <i class="bi bi-person-bounding-box"></i>
                                <a href="javascript:void(0)" onclick="navigateProfile(<?php echo USER['ID']; ?>);">Change Profile Photo</a>
                            </li>
                            <li> 
                                <i class="bi bi-spellcheck"></i>
                                <a href="javascript:void(0)" onclick="navigateProfile(<?php echo USER['ID']; ?>);">Change Account ID</a>
                            </li>
                            <li> 
                                <i class="bi bi-door-open"></i>
                                <a href="javascript:void(0)" onclick="logout();">Log out</a>
                            </li>
                        </ul>
                    </section>
                </div>
            `;
    
    
    
    
            viewBox.style.display = "block";
            viewRoot.innerHTML = template;
        }
        ajax.style.display = "none";
    }

    function logout() {
        let confirm = window.confirm("Confirm you wants to logout", "");
        if(confirm) {
            window.location.replace("/app/account/settings/logout/");
        }
    }
</script>