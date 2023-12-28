<?php if (!defined('INCLUDE_APP_STARTER_0000000X3949472934938498_PACK')) {
    exit;
} ?>
<?php $photo = (USER['Photo'] == 'default') ? 'app/account/info/getFile.php?ft=default.png' : 'app/account/info/getFile.php?ft='.USER['Photo']; ?>
<script>
    chatsNavigate();
    function chatsNavigate() {
        const tmpContainer = ["x", "y", "z"];
        var iterationLength = 0;
        document.getElementById("chats").innerHTML = "";

        const fetch_all_chat_timer = ()=> {
            let xmlHttpRequest = new XMLHttpRequest();
            xmlHttpRequest.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    if(this.responseText.length > 10) {
                        tmpContainer[0] = this.responseText;
                        //console.log(this.responseText);

                        const obj = JSON.parse(this.responseText);
                        //document.getElementById("chats").innerHTML = "";  
                        let totalChats = "";      
                        for(x in obj) {

                            let photo = (obj[x].Photo == "default") ? "default.png" : obj[x].Photo;
                            let userActiveTime = Date.parse(obj[x].ActiveStatus);
                            let dateFromActiveTime = new Date(userActiveTime);
                            let currentDate = new Date();
                            let activeStatus = "status-off";
                            let userName = obj[x].UserName;
                            let userID = obj[x].ID;
                            if(dateFromActiveTime.getFullYear() == currentDate.getFullYear() &&
                                dateFromActiveTime.getDate() == currentDate.getDate() &&
                                dateFromActiveTime.getHours() == currentDate.getHours()) {
                                    let minutes = Math.abs(currentDate.getMinutes() - dateFromActiveTime.getMinutes());
                                    if(minutes <= 4) {
                                        activeStatus = "status-on";
                                    }
                            }
    
    
                            const getLastMessagesXmlHttpRequest = new XMLHttpRequest();
                            let message = "You are now connected";
                            let time = "";
                            let readStatus = "";
                            let sendPrefix = "";
                            let reply = "";
                            let messageID = 0;
                            getLastMessagesXmlHttpRequest.onload = function() {
                                if(this.readyState == 4 && this.status == 200) {
                                    let statusX = 0;
                                    if(this.responseText.length > 0) {

                                        let messagesObj = JSON.parse(this.responseText);
                                        message = messagesObj[0].MessageBody;
                                        messageID = messagesObj[0].ID;
                                        time =  new Date(Date.parse(messagesObj[0].SentTime));
                                        time = time.getHours() + ":" + time.getMinutes();
                                        if(message.length > 100) {
                                            message = message.slice(0, 100);
                                        }
                                        if(messagesObj[0].MessageType != "text") {
                                            message = "<i class='bi bi-link' style='font-size:1.5em;'></i>";
                                        }
                                        
                                        if(messagesObj[0].HaveRead == "false") {
                                            messagesObj.forEach((value)=>{
                                                if(value.HaveRead == "false") {
                                                    statusX += 1;
                                                }
                                            });
                                            if(statusX > 9) {
                                                statusX = "9+";
                                            }
                                            readStatus = "<span>" + statusX + "</span>";
                                        }
                                        if(messagesObj[0].UserFrom == <?php echo USER['ID']; ?>) {
                                            sendPrefix = "You: "
                                            readStatus = "";
                                        } else {
                                            message = "<b>" + message + "</b>";
                                        }
                                        if(messagesObj[0].ReplyBody != null) {
                                            reply = "<sup>reply</sup>";
                                        }
                                    }
    
    
    
    

                                        const userTemplate = `
                                            <div>
                                                <span>
                                                    <div class="icon"><img src="/app/account/info/getFile.php?ft=${ photo }" width="40" height="40" alt="icon"/></div>
                                                    <span class="status ${ activeStatus }"></span>
                                                </span>
                                            </div>
                                            <div>
                                                <h3>${ userName }</h3>
                                                <div>
                                                    <p><b>${ sendPrefix }</b> ${ reply } ${ message }</p>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <div>
                                                <!--<span>1</span>-->
                                                ${ readStatus }
                                                <br>
                                                <time>${ time }</time>
                                            </div>
                                        `;
                                        let a = document.createElement("a");
                                        a.setAttribute("class", `user uniqueClass_${ userID }`);
                                        a.setAttribute("href", "javascript:void(0)");
                                        a.setAttribute("onclick", `messageNavigate(${ userID })`);
                                        a.setAttribute("id", `lastMsgID_${ messageID }`);
                                        a.innerHTML = userTemplate;

    
                                    if(tmpContainer[2] == "z") {

                                        document.querySelector("#chats").appendChild(a);

                                    } else {

                                        let last = document.querySelector(`.uniqueClass_${ userID }`);
                                        last.parentNode.replaceChild(a, last);
                                        //console.log("replaced: " + last + " with:" + a);

                                    }



                                    let users = document.getElementById("chats");
                                    try {
                                        var children = users.getElementsByTagName("a");
                                        var ids = [], obj, i, len;
                                        for(i = 0, len = children.length; i < len; i++) {
                                            obj  = {};
                                            obj.element = children[i];
                                            obj.idNum = parseInt(children[i].id.replace(/[^\d]/g, ""), 10);
                                            ids.push(obj);
                                        }
                                        ids.sort(function(b, a){ return(a.idNum - b.idNum); });
                                        for(i = 0; i < ids.length; i++) {
                                            //console.log(ids[i].element);
                                            users.appendChild(ids[i].element);
                                        }
                                    } catch(e) {
                                        console.log(e);
                                    }
    
                                }
                            }
                            getLastMessagesXmlHttpRequest.open("GET", "/app/chats/fetch_inline_messages.php?userFrom=" + obj[x].ID);
                            getLastMessagesXmlHttpRequest.send();
    
    
                            if(iterationLength == (obj.length)) {
                                tmpContainer[2] = "g";
                                //console.log("Reached.");
                            } else {
                                iterationLength += 1;
                                //console.log("looping...");
                            }

                        }
                        
                    } else {
                        document.getElementById("chats").innerHTML = `
                            <img src="/app/assets/getFile.php?ft=image-1.svg" width="100%" alt="Image">
                            <p style="text-align:center;">Add contacts to start chat with them</p>
                        `;
                    }
                }
                
            };
            xmlHttpRequest.open("GET", "/app/chats/fetch_chats.php");
            xmlHttpRequest.send();

            setTimeout(fetch_all_chat_timer, (1000 * (30)));
            //console.log("Requesting...");
        };
        fetch_all_chat_timer();
        

    }
    







</script>


