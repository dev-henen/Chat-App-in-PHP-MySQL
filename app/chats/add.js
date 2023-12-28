function addChat(userkey = '') {
    let viewBox = document.getElementById("viewBox");
    let viewRoot = document.getElementById("viewRoot");
    let ajax = document.getElementById("ajax");
    ajax.style.display = "block";
    let template = `
        <section class="addChat">
            <div class="banner">
                <img src="/app/assets/images/image-1.svg" width="100%" alt="Image"/>
            </div>
            <h4>Add New Chat</h4>
            <div class="error" id="UserKeyError">
            </div>
            <div class="form">
                <form method="post" action="/" onsubmit="return false;">
                    <input type="text" name="UserKey" id="addUserKeyInput" placeholder="e.g. @example" value="${userkey}"/>
                    <input type="submit" name="submit" value="add" onclick="addThis();"/>
                </form>
                <button onclick="closeAdd();">Cancel</button>
            </div>
        </section>
    `;
    viewBox.style.display = "block";
    viewRoot.innerHTML = template;
    ajax.style.display = "none";
}
function addThis() {
    let input = document.getElementById("addUserKeyInput");
    let error = document.getElementById("UserKeyError");
    let viewBox = document.getElementById("viewBox");
    let viewRoot = document.getElementById("viewRoot");
    let inputValue = input.value;
    inputValue = inputValue.trim();
    if(inputValue !== "") {
        if(!inputValue.startsWith("@")) {
            error.innerText = "ID must start with @ (at symbol)";
        } else {
            error.innerText = "";
            let removeAt = inputValue.slice(1);
            if(!/^[A-Za-z0-9]*$/.test(removeAt)) {
                error.innerText = "invalid ID";
            } else {
                if(removeAt.length > 200 || removeAt.length < 1) {
                    error.innerText = "Invalid ID"
                } else {
                    error.innerText = "";

                    let addChatXmlHttpRequest = new XMLHttpRequest();
                    addChatXmlHttpRequest.onload = function() {
                        if(this.readyState == 4 && this.status == 200) {
                           error = "";
                           console.log("200: " + this.responseText);
                        } else if(this.readyState == 4 && this.status == 404) {
                            error.innerText = "User not found";
                        } else if(this.readyState == 4 && this.status == 502) {
                            error.innerText = "Invalid data submitted";
                        } else if(this.readyState == 4 && this.status == 451){
                            error.innerHTML = "You can't chat your self.";
                        } else if(this.readyState == 4 && this.status == 409){
                            error.innerText = "You already started chat with this user";
                        } else if(this.readyState == 4 && this.status == 201){
                            viewRoot.innerHTML = "";
                            viewBox.style.display = "none";
                            messageNavigate(Number(this.responseText));
                            if(typeof fetch_all_chat_timer != "undefined") {
                                clearTimeout(fetch_all_chat_timer);
                            }
                            chatsNavigate();
                            //console.log(this.responseText);
                        } else {
                            console.log(this.responseText);
                        }
                    };
                    addChatXmlHttpRequest.open("POST", "/app/chats/add.php");
                    addChatXmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    addChatXmlHttpRequest.send("UserKey=" + inputValue);
                }
            }
        }
    }
}

function closeAdd() {
    document.getElementById('viewRoot').innerHTML = '';
    document.getElementById('viewBox').style.display = 'none';
}