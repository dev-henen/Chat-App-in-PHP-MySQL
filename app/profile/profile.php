<?php if (!defined('INCLUDE_APP_STARTER_0000000X3949472934938498_PACK')) {
    exit;
} ?>
<script>
    function navigateProfile(userID) {
        document.getElementById("viewBox").style.display = "block";
        document.getElementById("ajax").style.display = "block";
        try {

            const xmlHttpRequest = new XMLHttpRequest();
            xmlHttpRequest.onload = function() {
                if(this.readyState == 4 && this.status == 200) {
                    const obj = JSON.parse(this.responseText);
                    console.log(obj);
                    let photo = (obj.Photo == "default") ? "default.png" : obj.Photo;
                    let joinDate = new Date(Date.parse(obj.RegDate));
                    let editMyProfileButton = "";
                    let line = (obj.ID == <?php echo USER['ID']; ?>) ? "You do not have a LINE" : `${ obj.UserName } do not have a LINE`;
                    if(obj.LINE != null) {
                        line = obj.LINE
                    }
                    if(obj.ID == <?php echo USER['ID']; ?>) {
                        editMyProfileButton = `
                            <button onclick="document.getElementById('updatePhotoBox').style.display='flex';" style="background-color:royalblue;">Update photo</button>
                            <br>
                            <br>
                            <button onclick="editMyProfile('${ obj.MonthOfBirth }');">Edit profile</button>
                        `;
                    }

                    const template = `
                        <div class="myProfile">
                            <header>
                                <div>
                                    <div>
                                        <h1>Profile</h1>
                                    </div>
                                    <div>
                                        <button onclick="closeProfile();"> <i class="bi bi-x-lg"></i> </button>
                                    </div>
                                </div>
                            </header>
                            
                            <section>
                            
                                <div>
                                    <div class="photo">
                                        <div class="inner">
                                            <img id="profilePicture" src="/app/account/info/getFile.php?ft=${ photo }" width="100" alt="Image of ${ obj.UserName }" onclick="initialImageViewer(this);"/>
                                        </div>
                                    </div>
                                    <h1>${ obj.UserName }</h1>
                                    <div>
                                        <time>${ obj.DayOfBirth }/${ obj.MonthOfBirth }</time>
                                        <time>joined/${ joinDate.getDate() }-${ joinDate.getMonth() }-${ joinDate.getFullYear() }</time>
                                    </div>
                                </div>
                                <div>
                                    <div class="quote">
                                        <q> ${ line } </q>
                                    </div>
                                    <div class="sect">
                                        <address>${ obj.UserKey }</address>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="set">
                                        ${ editMyProfileButton }
                                    </div>
                                </div>
                            
                            </section>
    
    
                        </div>


                        
                        <div id="editMyProfile" class="editMyProfile" style="display:none;">
                            <header>
                                <div>
                                    <div>
                                        <h1>Edit Profile</h1>
                                    </div>
                                    <div>
                                        <button onclick="closeEditProfile();"> <i class="bi bi-x-lg"></i> </button>
                                    </div>
                                </div>
                            </header>
                        
                           <section>
                        
                                <div>
                                    <img src="/app/assets/getFile.php?ft=dashboard-default.a489a8b3e11835af82f9b07c997b7dd5.svg" width="100%" alt="image"/>
                                    <form method="post" action="/">
                                        <label for="userName">User Name</label>
                                         <input type="text" name="userName" value="${ obj.UserName }"/>
                                         <label for="dayOfBirth">Day of birth</label>
                                         <input type="number" name="dayOfBirth" value="${ obj.DayOfBirth }"/>
                                         <label for="yearOfBirth">Year of birth</label>
                                         <input type="number" name="yearOfBirth" value="${ obj.YearOfBirth }"/>
                                         <label for="monthOfBirth">Month of birth</label>
                                         <select name="monthOfBirth">
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
                                        <label for="userID">User ID</label>
                                        <input type="text" name="userID" value="${ obj.UserKey }" disabled/>
                                        <label for="LINE">LINE</label>
                                        <textarea name="LINE" placeholder="LINE">${ (obj.LINE == null) ? "" : obj.LINE }</textarea>
                                        
                                    </form>
                                </div>
                                <div>
                                    <div class="sect">
                                        
                                    </div>
                                    <br>
                                    <div class="set">
                                        <button onclick="updateAccount();">Done</button>
                                    </div>
                                </div>
                            </section>
                                <div class="pop-alert" id="popAlert">
                                    <span onclick="this.parentElement.style.display='none';">&gt; OK</span>
                                    <div>Your profile have been saved
                                    <br>Note: It may take few minutes for changes to show up</div>
                                </div>
                        </div>


                        <div class="updatePhoto" id="updatePhotoBox" style="display:none;">
                            <div class="cancel">
                                <i class="bi bi-x-lg" onclick="this.parentElement.parentElement.style.display='none';"></i>
                            </div>
                            <div class="selector">
                                <form onsubmit="return false;" action="/" method="post" enctype="multipart/form-data">
                                    <input type="file" name="file" id="photoToUpdate" oninput="updatePhoto();"/>
                                    <i class="bi bi-image"></i>
                                </form>
                            </div>
                        </div>
                    `;
                    
                    let openProfileTimer = setInterval(()=>{
                        try {
                            let profileRoot = document.getElementById("viewRoot");
                            profileRoot.innerHTML = template;
                            profileRoot.style.display = "block";
            
                            clearInterval(openProfileTimer);
                        } catch(e) {
                            console.log(e.message);
                        }
                    }, 500);

                }
                document.getElementById("ajax").style.display = "none";
            };
            xmlHttpRequest.open("GET", "/app/account/info/user.php?userID=" + userID);
            xmlHttpRequest.send();

        } catch(e) {
            console.log(e.message);
        }

    }



    function closeProfile() {
        let viewRoot = document.getElementById("viewRoot");
        let viewBox = document.getElementById("viewBox");
        viewRoot.innerHTML = "";
        viewBox.style.display = "none";
    }

    function closeEditProfile() {
        let editMyProfile = document.getElementById("editMyProfile");
        editMyProfile.style.display = "none";
    }


    function editMyProfile(month) {
        let editMyProfile = document.getElementById("editMyProfile");
        
        editMyProfile.style.display = "block";
        try {
            autoSelectMonthOfBirth(month);
        } catch(e) {
            console.log(e.message);
        }
    }

    function autoSelectMonthOfBirth(month) {
        let select = document.getElementsByTagName("select");
        for(let i = 0; i < select.length; i++) {
            if(select[i].name == "monthOfBirth") {
                for(let x = 0; x < select[i].options.length; x++) {
                    if(select[i].options[x].value == month) {
                        select[i].options[x].setAttribute("selected", true);
                        break;
                    }
                }
                break;
            }
        }
    }
    

    
    function updatePhoto() {
        const formData = new FormData();
        const fileId = document.getElementById("photoToUpdate");
        formData.append("image", fileId.files[0]);
        fetch("/app/account/update/updatePhoto.php", {
            method: "POST",
            body: formData
        }).then((response) => response.text()).then((result) => {
            if(!result.toString().search(/^[a-zA-Z0-9 _ .]/)) {
                let imageInNavigation = document.getElementById("iconInNavigation");
                let profilePicture = document.getElementById("profilePicture");
                imageInNavigation.src = "/app/account/info/getFile.php?ft=" + result.toString().trim();
                profilePicture.src = "/app/account/info/getFile.php?ft=" + result.toString().trim();
            }
            // console.log("Success: ", result);
            // caches.keys().then(function(names){
            //   for(let name of names) {
            //       caches.delete(name);
            //   }
            //  });
        }).catch((error) => {
            console.log("error: ", error);
        });
        fileId.value = "";
        document.getElementById("updatePhotoBox").style.display = "none";
    }
    



    function initialImageViewer(caller) {
        //alert("viewed");
        let div1 = document.createElement("div");
        let div2 = document.createElement("div");
        div1.setAttribute("class", "view-box");
        div1.setAttribute("id", "initialImageView");
        div1.setAttribute("style", "display: block;");
        div2.setAttribute("class", "view");
        div2.innerHTML = "<div class='ajax'><div></div></div>";
        if(document.getElementById("initialImageView") || caller == null) {
            document.getElementById("initialImageView").outerHTML = "";
        } else {
            let img = document.createElement("img");
            img.setAttribute("src", caller.src);
            img.setAttribute("onclick", "initialImageViewer(null)");
            img.setAttribute("width", "100%");
            let div = document.createElement("div");
            div.setAttribute("class", "chatImagePreview");
            div.appendChild(img);
            div2.appendChild(div);
            div1.appendChild(div2);
            document.body.appendChild(div1);
            let imageLoadingTimer = setInterval(()=>{
                try {
                    let image = img;
                    //console.log("Check Ready State of Image: " + image.complete);
                    if(image.complete === true && image.naturalHeight > 0) {
                        clearInterval(imageLoadingTimer);
                        document.getElementsByClassName("ajax").style.display = "none";
                    }

                } catch(e) {
                    console.log(e.message);
                }
            }, 1000);
        }
    }

</script>
<script><?php echo @file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/".'app/profile/edit_profile.js'); ?></script>