const email = document.getElementsByName("email")[0];
const password = document.getElementsByName("password")[0];
const loader = document.getElementById("loader");

const emailLabel = email.parentElement.previousElementSibling;
const passwordLabel = password.parentElement.previousElementSibling;

const emailLabelDefaultText = emailLabel.innerText;
const passwordLabelDefaultText = passwordLabel.innerText;

let errorColor = 'rgb(221, 75, 75)';
let initialColor = '#111';
let buttonColor = '#829ef3';
let buttonInitialColor = '#1238a8';
let fieldColor = '#111';

window.onload = ()=> {
    preventSubmitOnEmpty();
}


var a_call_once = true;
function validateEmail() {
    const email = document.getElementsByName("email")[0];
    const signIn = document.getElementsByName("signIn")[0];
    let emailValue = email.value.trim();

    if(emailValue == "") {
        email.style.color = errorColor;
        email.parentElement.style.borderBottom = "1px solid " + errorColor;
        signIn.disabled = true;
        signIn.style.backgroundColor = buttonColor;
        signIn.style.cursor = "not-allowed";
    } else {

        let emailDot = emailValue.lastIndexOf(".");
        let emailAt = emailValue.indexOf("@")
        
        if(emailAt < 1  || emailDot < emailAt + 2 || emailDot + 2 >= emailValue.length) {
            email.style.color = errorColor;
            email.parentElement.style.borderBottom = "1px solid " + errorColor;
            signIn.disabled = true;
            signIn.style.backgroundColor = buttonColor;
            signIn.style.cursor = "not-allowed";

            let text = "Please give us a valid email address";
            if(a_call_once == true) {
                a_call_once = false;
                let i = 0;
                let timer = setInterval(()=>{
                    if(i === 0) {
                        emailLabel.innerText = "";
                    }
                    if(i < text.length) {
                        emailLabel.style.color = errorColor;
                        emailLabel.innerHTML += text.charAt(i);
                        i++;
                    } else {
                        clearInterval(timer);
                        setTimeout(()=>{
                            emailLabel.style.color = fieldColor;
                            emailLabel.innerHTML = emailLabelDefaultText;
                            a_call_once = true;
                        }, 1500);
                    }
                }, 50);
            }

        } else {
            
            if(emailValue.length > 200) {
                email.style.color = errorColor;
                email.parentElement.style.borderBottom = "1px solid " + errorColor;
                signIn.disabled = true;
                signIn.style.backgroundColor = buttonColor;
                signIn.style.cursor = "not-allowed";
            } else {
                email.style.color = initialColor;
                email.parentElement.style.borderBottom = "1px solid " + initialColor;
                signIn.disabled = false;
                signIn.style.cursor = "pointer";
                signIn.style.backgroundColor = buttonInitialColor;
            }

        }
    }
    preventSubmitOnEmpty();
}


var b_call_once = true;
function validatePassword() {
    const password = document.getElementsByName("password")[0];
    const signIn = document.getElementsByName("signIn")[0];
    let passwordValue = password.value.trim();

    if(passwordValue == "") {
        password.style.color = errorColor;
        password.parentElement.style.borderBottom = "1px solid " + errorColor;
        signIn.disabled = true;
        signIn.style.backgroundColor = buttonColor;
        signIn.style.cursor = "not-allowed";
    } else {
        
        if(passwordValue.indexOf("\\") != -1) {
            password.style.color = errorColor;
            password.parentElement.style.borderBottom = "1px solid " + errorColor;
            signIn.disabled = true;
            signIn.style.backgroundColor = buttonColor;
            signIn.style.cursor = "not-allowed";

            let text = "Back slash is not allowed";
            if(b_call_once == true) {
                b_call_once = false;
                let i = 0;
                let timer = setInterval(()=>{
                    if(i === 0) {
                        passwordLabel.innerText = "";
                    }
                    if(i < text.length) {
                        passwordLabel.style.color = errorColor;
                        passwordLabel.innerHTML += text.charAt(i);
                        i++;
                    } else {
                        clearInterval(timer);
                        setTimeout(()=>{
                            passwordLabel.style.color = fieldColor;
                            passwordLabel.innerHTML = passwordLabelDefaultText;
                            b_call_once = true;
                        }, 1500);
                    }
                }, 50);
            }

        } else {
            
            if(passwordValue.replace("\\", "").length > 100) {
                password.style.color = errorColor;
                password.parentElement.style.borderBottom = "1px solid " + errorColor;
                signIn.disabled = true;
                signIn.style.backgroundColor = buttonColor;
                signIn.style.cursor = "not-allowed";

                let text = "Unsupported password string";
                if(b_call_once == true) {
                    b_call_once = false;
                    let i = 0;
                    let timer = setInterval(()=>{
                        if(i === 0) {
                            passwordLabel.innerText = "";
                        }
                        if(i < text.length) {
                            passwordLabel.style.color = errorColor;
                            passwordLabel.innerHTML += text.charAt(i);
                            i++;
                        } else {
                            clearInterval(timer);
                            setTimeout(()=>{
                                passwordLabel.style.color = fieldColor;
                                passwordLabel.innerHTML = passwordLabelDefaultText;
                                b_call_once = true;
                            }, 1500);
                        }
                    }, 50);
                }

            } else {
                password.style.color = initialColor;
                password.parentElement.style.borderBottom = "1px solid " + initialColor;
                signIn.disabled = false;
                signIn.style.cursor = "pointer";
                signIn.style.backgroundColor = buttonInitialColor;
            }

        }
    }

    preventSubmitOnEmpty();
}


function preventSubmitOnEmpty() {
    if(email.value === "" || password.value === "") {
        const signIn = document.getElementsByName("signIn")[0];
        signIn.disabled = true;
        signIn.style.backgroundColor = buttonColor;
        signIn.style.cursor = "not-allowed";
    }
}


function loginAccount() {
    if(email.value === "" || password.value === "") {
        const signIn = document.getElementsByName("signIn")[0];
        signIn.disabled = true;
        signIn.style.backgroundColor = buttonColor;
        signIn.style.cursor = "not-allowed";
    } else {
        loader.style.display = "block";
        

        const xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                //alert("Res: " + this.responseText);
                loader.style.display = "none";

            } else if(this.readyState == 4 && this.status == 308){
                loader.style.display = "block";
                loader.innerHTML = "<strong style='display:block;text-align:center;font-size:1em;'>Please wait...</strong>";
                window.location.replace("/");

            } else if(this.readyState == 4 && this.status == 400) {

                const error = JSON.parse(this.responseText);

                if(error.email === true) {  
                    let text = "Server: invalid email address";
                    if(a_call_once == true) {
                        a_call_once = false;
                        let i = 0;
                        let timer = setInterval(()=>{
                            if(i === 0) {
                                emailLabel.innerText = "";
                            }
                            if(i < text.length) {
                                emailLabel.style.color = errorColor;
                                emailLabel.innerHTML += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(timer);
                                setTimeout(()=>{
                                    emailLabel.style.color = fieldColor;
                                    emailLabel.innerHTML = emailLabelDefaultText;
                                    a_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }

                if(error.emailExist === false) {  
                    let text = "No user for this email";
                    if(a_call_once == true) {
                        a_call_once = false;
                        let i = 0;
                        let timer = setInterval(()=>{
                            if(i === 0) {
                                emailLabel.innerText = "";
                            }
                            if(i < text.length) {
                                emailLabel.style.color = errorColor;
                                emailLabel.innerHTML += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(timer);
                                setTimeout(()=>{
                                    emailLabel.style.color = fieldColor;
                                    emailLabel.innerHTML = emailLabelDefaultText;
                                    a_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }


                if(error.password === true) {  
                    let text = "Wrong password, please check password";
                    if(b_call_once == true) {
                        b_call_once = false;
                        let i = 0;
                        let timer = setInterval(()=>{
                            if(i === 0) {
                                passwordLabel.innerText = "";
                            }
                            if(i < text.length) {
                                passwordLabel.style.color = errorColor;
                                passwordLabel.innerHTML += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(timer);
                                setTimeout(()=>{
                                    passwordLabel.style.color = fieldColor;
                                    passwordLabel.innerHTML = passwordLabelDefaultText;
                                    b_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }


                console.log(error);
                loader.style.display = "none";
            }
        }
        xmlHttpRequest.open("POST", "./LoginAccount.php");
        xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttpRequest.send(`email=${ email.value }&password=${ password.value }&LoginAccount=true`);


    }
}