<?php if (!defined('INCLUDE_APP_STARTER_0000000X3949472934938498_PACK')) {
    exit;
} ?>

<script>
    function chatSetting(userID, userKey, userPhoto, userName, close = false) {
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
                        <div class="icon" onclick="navigateProfile(${ userID });"><img id="iconInNavigation" src="/app/account/info/getFile.php?ft=${ userPhoto == "default" ? "default.png" : userPhoto }" width="30px" height="30px"/></div>
                        <h3>Chat Setting</h3>
                    </header>

                    <section class="chatSetting">
                        <div class="photo profile1">
                            <div class="inner">
                                <img id="profilePicture" src="/app/account/info/getFile.php?ft=<?php echo ((USER["Photo"] == "default")? "default.png" : USER["Photo"]); ?>" width="100" alt="Imag"/>
                            </div>
                        </div>
                        <div class="photo profile2">
                            <div class="inner">
                                <img id="profilePicture" src="/app/account/info/getFile.php?ft=${ userPhoto }" width="100" alt="Imag"/>
                            </div>
                        </div>
                        <br>
                        <div style="font-size:0.8em;text-align:center;">
                            <strong>
                                Note: if you block this user:<br>
                                This conversation will be deleted and all your existing chat history
                                will also delete, and you will not be able chat Him/Her...<br>
                                and this user will not be able to chat you or see your
                                profile and your activity history.
                            </strong>
                        </div>
                        <br>
                        <button onclick="blockThis('${ userKey }', ${ userID })" style="background-color:#f44;"><i class="bi bi-slash-circle"></i> Block ${ userName }</button>
                    </section>
                </div>
            `;
    
    
    
    
            viewBox.style.display = "block";
            viewRoot.innerHTML = template;
        }
        ajax.style.display = "none";
    }


    function blockThis(userKey, userID) {
        let confirm = window.confirm("Are you sure you want to block this user?", "");
        if(confirm) {
            let xmlHttpRequest = new XMLHttpRequest();
            xmlHttpRequest.onload = function() {
                if(this.readyState == 4 && this.status == 200) {
                    alert("User blocked");
                    chatSetting(null, null, null, null, true)
                    closeChat();
                    if(typeof fetch_all_chat_timer != "undefined") {
                        clearTimeout(fetch_all_chat_timer);
                    }
                    document.getElementById("chats").innerHTML = "";
                    chatsNavigate();
                } else {
                    alert("Unable to block user");
                }
                console.log("Code: " + this.status);
                console.log(this.responseText);
            };
            xmlHttpRequest.open("POST", "/app/chats/block.php");
            xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttpRequest.send("UserKey=" + userKey + "&UserID=" + userID);
        }
    }
</script>