<?php if (!defined('INCLUDE_APP_STARTER_0000000X3949472934938498_PACK')) {
    exit;
} ?>
<script>
    function messageNavigate(userID, loadOffset = 0) {
        try {
            document.getElementById("ajax").style.display = "block";
            if(typeof getMessagesTimer !== 'undefined') {
                clearTimeout(getMessagesTimer);
            }
        } catch(e) {
            console.log(e);
        }
        const root = document.getElementById("root");
        const tmpContainer = ["x","y","z"];
        const userInfoXmlHttp = new XMLHttpRequest();
        userInfoXmlHttp.onload = function() {
            if(this.readyState == 4 && this.status == 200) {
                const obj = JSON.parse(this.responseText);
                photo = (obj[0].Photo == "default") ? "default.png" : obj[0].Photo;
                        let userActiveTime = Date.parse(obj[0].ActiveStatus);
                        let dateFromActiveTime = new Date(userActiveTime);
                        let currentDate = new Date();
                        let activeStatus = "status-off";
                        if(dateFromActiveTime.getFullYear() == currentDate.getFullYear() &&
                            dateFromActiveTime.getDate() == currentDate.getDate() &&
                            dateFromActiveTime.getHours() == currentDate.getHours()) {
                                let minutes = Math.abs(currentDate.getMinutes() - dateFromActiveTime.getMinutes());
                                if(minutes <= 2) {
                                    activeStatus = "status-on";
                                }
                        }
                        activeStatusText = (activeStatus == "status-on") ? "online" : "offline";
                const template = `
                    
                    <header>
                        <div>
                            <span>
                                <span class="back" style="display: none;">
                                    <i class="bi bi-reply" onclick="closeChat();"></i>
                                </span>
                            </span>
                            <span>
                                <div class="icon" onclick="navigateProfile(${ obj[0].ID });"><img src="/app/account/info/getFile.php?ft=${ photo }" width="40" height="40"/></div>
                                <span class="status ${ activeStatus }"></span>
                            </span>
                            <span class="name">${ obj[0].UserName }</span>
                        </div>
                        <div>
                            <button onclick="chatSetting(${ obj[0].ID }, '${ obj[0].UserKey }', '${ obj[0].Photo }', '${ obj[0].UserName }');"> <i class="bi bi-gear"></i> </button>
                        </div>
                    </header>
                    <section id="message"></section>
                        <div class="sendFile" id="sendFileBox" style="display:none;">
                            <div class="cancel">
                                <i class="bi bi-x-lg" onclick="this.parentElement.parentElement.style.display='none';"></i>
                            </div>
                            <div class="selector">
                                <form onsubmit="return false;" action="/" method="post" enctype="multipart/form-data">
                                    <input type="file" name="file" id="sendFile" oninput="shareFile(${ obj[0].ID });"/>
                                    <i class="bi bi-link-45deg"></i>
                                </form>
                            </div>
                        </div>
                        <div id="replyContainer" class="replyContainer">
                            <div id="replyText"></div>
                            <div class="replyCancel" onclick="cancelReply();">&times;</div>
                        </div>
                    <footer>
                        <div class="type">
                            <textarea placeholder="Type message here..." rows="1" id="messageText"></textarea>
                        </div>
                        <div class="send">
                            <button onclick="sendFile();"> <i class="bi bi-link-45deg"></i> </button>
                            <span></span>
                            <button onclick="sendMessage(${ obj[0].ID })"> <i class="bi bi-send"></i> </button>
                        </div>
                    </footer>


                `;
                root.innerHTML = template;
            }
        };
        userInfoXmlHttp.open("GET", "/app/message/fetch_person_to_chat_info.php?userID=" + userID);
        userInfoXmlHttp.send();



        const getMessages = ()=> {
            if(document.getElementById("message")) {
                const getMessagesXmlHttp = new XMLHttpRequest();
                getMessagesXmlHttp.onload = function() {
                    if(this.readyState == 4 && this.status == 200) {

                        if(this.responseText != tmpContainer[0]) {
                            tmpContainer[0] = this.responseText;
                            //console.log(this.responseText);

                            if(this.responseText.length > 50) {
                                const obj = JSON.parse(this.responseText);
                                if(obj.length > 0) {
                                    document.getElementById("message").innerHTML = "";
                                    let loadMore = "";
                                    let loadLess = "";
                                    if(obj.length >= 10) {
                                        loadMore = `
                                            <div style="text-align:center;"> 
                                                <button class="loadMoreButton" onclick="messageNavigate(${ userID },${ loadOffset + 10 })">Load more</button>
                                            </div>
                                        `;
                                    }
                                    if(loadOffset >= 10) {
                                        loadLess = `
                                            <div style="text-align:center;"> 
                                                <br>
                                                <br>
                                                <button class="loadMoreButton" onclick="messageNavigate(${ userID },${ loadOffset - 10 })">Previous</button>
                                            </div>
                                        `;
                                    }
                                    try {
                                        document.getElementById("message").innerHTML = `
                                            <div class="additionHeader">
                                                <p class="chatConnected">You have been connected</p><br>
                                                ${ loadMore }
                                            </div>
                                        `;
                                    } catch(e) {
                                        console.log("Unable to set load more button");
                                    }

                                    let dateInterval = "";
                                    let totalTemplate = "";
                                    for(x in obj) {
                                        const position = (obj[x].UserFrom == userID) ? "left" : "right"; 
                                        formPhoto = (obj[x].UserFrom == userID) ? photo : "<?php echo (USER['Photo'] == 'default') ? 'default.png' : USER['Photo']; ?>"; 
                                        let replyText = "";
                                        let replyClass = "";
                                        let time = obj[x].SentTime;
                                        let dateFromTime = new Date(Date.parse(time));
                                        let year = dateFromTime.getFullYear();
                                        let month = dateFromTime.getMonth();
                                        let date = dateFromTime.getDate();
                                        let hours = dateFromTime.getHours();
                                        let minutes = dateFromTime.getMinutes();
                                        let formedDate = `<div class="line"> <time>` + date + "/" + month + "/" + year + `</time> <hr/></div>`;
                                        let putImageIfLeft = (position == "left") ? `<div class="icon"><img src="/app/account/info/getFile.php?ft=${ formPhoto }" width="30" height="30"/></div>` : "";
                                        let putImageIfRight = (position == "right") ? `<div class="icon"><img src="/app/account/info/getFile.php?ft=${ formPhoto }" width="30" height="30"/></div>` : "";
                                        let amPm = hours >= 12 ? "PM" : "AM";
                                            hours = hours % 12;
                                            hours = hours ? hours : 12;
                                            minutes = minutes < 10 ? '0' + minutes : minutes;
                                            time = hours + ":" + minutes + "" + amPm;
                                            if(dateInterval == formedDate) {
                                                formedDate = "";
                                            } else {
                                                dateInterval = formedDate;
                                            }
                                            if(obj[x].ReplyBody != null) {
                                                replyClass = "isReply";
                                                replyText = `
                                                    <div class="replyTextMessage">
                                                        <strong>Reply:</strong>
                                                        <em>${ obj[x].ReplyBody }</em>
                                                    </div>
                                                `;
                                            }
                                            let _message = "";
                                            switch(obj[x].MessageType) {
                                                case "image":
                                                    _message = `
                                                        <div class="sharedImage">
                                                            <div>
                                                                <img src="/app/message/getFile.php?ft=${ obj[x].MessageBody }" onclick="previewImage(this);" width="100" alt="image"/>
                                                            </div>
                                                            <span>
                                                                <time>${ time }</time>
                                                                <i class="bi bi-check2-all"></i>
                                                            </span>
                                                        </div>
                                                    `;
                                                break;
                                                default:
                                                _message = obj[x].MessageBody;
                                                _message = `
                                                    <div class="replyTextBox">
                                                        ${ replyText }
                                                    </div>
                                                    <p>
                                                        ${ _message }
                                                        <span>
                                                            <span>
                                                                <i onclick='reply("${ _message }");' class="bi bi-reply" title="Reply"></i>
                                                            </span>
                                                            <span>
                                                                <time>${ time }</time>
                                                                <i class="bi bi-check2-all"></i>
                                                            </span>
                                                        </span>
                                                    </p>
                                                `;
                                            }

                                        const template = `

                                                ${ formedDate }
                                                <div>
                                                    <div class="message ${ position }">
                                                        ${ putImageIfLeft }
                                                        <div class="${ replyClass }">
                                                            ${ _message }
                                                        </div>
                                                        ${ putImageIfRight }
                                                    </div>
                                                </div>

                                        `;
                                        totalTemplate += template;
                                    }
                                    try {
                                        if(document.getElementById("message")) {
                                            document.getElementById("message").innerHTML += totalTemplate;
                                        } else {
                                            alert("Error");
                                        }
                                    } catch(e) {
                                        alert("Error");
                                        console.log(e);
                                    }
                                    let autoScrollMessagesTimer = setInterval(()=>{
                                        try {
                                            document.getElementById("message").innerHTML += loadLess;
                                            document.getElementById("message").scrollTop = document.getElementById("message").scrollHeight + 5000;
                                            clearInterval(autoScrollMessagesTimer);
                                        } catch(e) {
                                            console.log(e.message);
                                        }
                                    }, 200);
                
                                }
                            } else {
                                let emptyMessageHeaderTimer = setInterval(()=>{
                                    try {
                                        if(loadOffset === 0) {
                                            document.getElementById("message").innerHTML += `
                                                <div class="noChat">
                                                    <h3 class="chatConnected">Start a chat with this user</h3>
                                                    <p class="chatConnected">You have been connected</p>
                                                    <div class="time"><time><?php echo date('d/m/Y'); ?></time></div>
                                                </div>
                                            `;
                                        } else {
                                            document.getElementById("message").innerHTML += `
                                                <div class="noChat">
                                                    <p class="chatConnected">You are connected</p>
                                                    <div class="time"><time><?php echo date('d/m/Y'); ?></time></div>
                                                </div>
                                                <div style="text-align:center;"> 
                                                    <p style="text-align:center;">That's all...</p>
                                                    <br>
                                                    <br>
                                                    <button class="loadMoreButton" onclick="messageNavigate(${ userID },${ loadOffset - 10 })">Previous</button>
                                                </div>
                                            `;
                                        }
                                        clearInterval(emptyMessageHeaderTimer);
                                    } catch(e) {
                                        console.log(e.message);
                                    }
                                }, 200);
                            }
                        }
                        
        
                    }
                    document.getElementById("ajax").style.display = "none";
                };
                getMessagesXmlHttp.open("GET", "/app/message/fetch_messages.php?userID=" + userID + "&offset=" + loadOffset);
                getMessagesXmlHttp.send();
                getMessagesTimer = setTimeout(getMessages, 2500);
            }
        };
        try {
            let setMessages = setInterval(() => {
                if(document.getElementById("message")) {
                    getMessages();
                    clearInterval(setMessages);
                }
            }, (200));            
        } catch(e) {
            console.log(e);
        }

        document.getElementById("root").style.display = "block";
    }



    const closeChat = ()=> {
        const root = document.getElementById("root");
        root.innerHTML = "";
        root.style.display = "none";
        try {
            if(getMessagesTimer) {
                clearTimeout(getMessagesTimer);
            }
        } catch(e) {
            console.log(e);
        }
    };

    function sendFile() {
        let sendFileBox = document.getElementById("sendFileBox");
        if(sendFileBox.style.display == "flex") {
            sendFileBox.style.display = "none";
        } else {
            sendFileBox.style.display = "flex";
        }
    }

    function shareFile(userID) {
        const formData = new FormData();
        const fileId = document.getElementById("sendFile");
        formData.append("messageBody", fileId.files[0]);
        formData.append("userID", userID);
        formData.append("messageType", "image");
        fetch("/app/message/sendFileMessage.php", {
            method: "POST",
            body: formData
        }).then((response) => response.text()).then((result) => {
            console.log("Success: ", result);
        }).catch((error) => {
            console.log("error: ", error);
        });
        fileId.value = "";
        sendFile();
    }

    function previewImage(caller) {
        let viewBox = document.getElementById("viewBox");
        let viewRoot = document.getElementById("viewRoot");
        viewRoot.innerHTML = "<div class='ajax'><div></div></div>";
        if(viewBox.style.display == "block" || caller == null) {
            viewBox.style.display = "none";
            viewRoot.innerHTML = "";
        } else {
            let img = document.createElement("img");
            img.setAttribute("src", caller.src);
            img.setAttribute("onclick", "previewImage(null)");
            img.setAttribute("width", "100%");
            let div = document.createElement("div");
            div.setAttribute("class", "chatImagePreview");
            div.appendChild(img);
            viewRoot.appendChild(div);
            viewBox.style.display = "block";
            let imageLoadingTimer = setInterval(()=>{
                try {
                    let image = img;
                    //console.log("Check Ready State of Image: " + image.complete);
                    if(image.complete === true && image.naturalHeight > 0) {
                        clearInterval(imageLoadingTimer);
                        viewBox.getElementsByClassName("ajax").style.display = "none";
                    }

                } catch(e) {
                    console.log(e.message);
                }
            }, 1000);
        }
    }
    



    var sendOnce = true;
    function sendMessage(userID) {
        let messageBody = document.getElementById("messageText");
        let messageBox = document.getElementById("message");
        let replyContainer = document.getElementById("replyContainer");
        let replyText = document.getElementById("replyText")
        let message = messageBody.value.replace(/\s+/, " ");
        let tagReplyText = "";
            message = message.trim();
            if(replyContainer.style.display != "none") {
                if(replyText.innerHTML.toString().trim() != "" && replyText.innerHTML.toString().length <= 1000) {
                    tagReplyText = "&reply=" + replyText.innerHTML.toString().trim().replace("<br>", "");
                    //console.log(tagReplyText);
                }
                replyText.innerHTML = "";
                replyContainer.style.display = "none";
            }
        if(message != "") {
            if(message.length < 1 || message.length > 5000) {
                console.log("message length exceeded");
            } else {

                if(sendOnce === true) {
                    sendOnce = false;
                    //console.log("sent to: " + userID + " message: " + messageBody.value);
                    const xmlHttpRequest = new XMLHttpRequest();
                    xmlHttpRequest.onload = function() {
                        if(this.readyState == 4 && this.status == 200) {
                            //console.log("\nResponse: " + this.responseText + "\n");
                        }
                    }
                    xmlHttpRequest.open("POST", "/app/message/sendMessage.php");
                    xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlHttpRequest.send("userID=" + userID + "&messageBody=" + encodeURIComponent(message) + "&messageType=text" + encodeURIComponent(tagReplyText));
        
                    setTimeout(()=>{ sendOnce = true; }, 1000);
                    messageBox.scrollTop = messageBox.offsetHeight;
                }

            }
        }
        messageBody.value = "";
    }

    function reply(replyFrom) {
        let replyContainer = document.getElementById("replyContainer");
        let replyText = document.getElementById("replyText");
        replyFrom = replyFrom.toString();
        replyFrom.replace("<br>", "");
        replyFrom.replace('&quot;', '"');
        replyFrom.replace('&apos;', "'");
        replyText.innerHTML = replyFrom;
        replyContainer.style.display = "flex";
    }
    function cancelReply() {
        let replyContainer = document.getElementById("replyContainer");
        let replyText = document.getElementById("replyText");
        replyText.innerHTML = "";
        replyContainer.style.display = "none";
    }



</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/" . 'app/chats/settings.php'; ?>