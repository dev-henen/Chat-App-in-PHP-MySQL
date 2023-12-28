const email = document.getElementsByName("email")[0];
const username = document.getElementsByName("username")[0];
const yearOfBirth = document.getElementsByName("yearOfBirth")[0];
const dayOfBirth = document.getElementsByName("dayOfBirth")[0];
const monthOfBirth = document.getElementsByName("monthOfBirth")[0];
const password = document.getElementsByName("password")[0];
const loader = document.getElementById("loader");

const emailLabel = email.parentElement.previousElementSibling;
const usernameLabel = username.parentElement.previousElementSibling;
const yearOfBirthLabel = yearOfBirth.parentElement.previousElementSibling;
const dayOfBirthLabel = dayOfBirth.parentElement.previousElementSibling;
const monthOfBirthLabel = monthOfBirth.parentElement.previousElementSibling;
const passwordLabel = password.parentElement.previousElementSibling;

const emailLabelDefaultText = emailLabel.innerText;
const usernameLabelDefaultText = usernameLabel.innerText;
const yearOfBirthLabelDefaultText = yearOfBirthLabel.innerText;
const dayOfBirthLabelDefaultText = dayOfBirthLabel.innerText;
const monthOfBirthLabelDefaultText = monthOfBirthLabel.innerText;
const passwordLabelDefaultText = passwordLabel.innerText;

let errorColor = 'rgb(221, 75, 75)';
let initialColor = '#829ef3';
let labelColor = '#111';
let fieldColor = '#111';
let buttonColor = '#1238a8';

window.onload = ()=> {
    preventSubmitOnEmpty();
}


var a_call_once = true;
function validateEmail() {
    const email = document.getElementsByName("email")[0];
    const signup = document.getElementsByName("signup")[0];
    let emailValue = email.value.trim();

    if(emailValue == "") {
        email.style.color = errorColor;
        email.parentElement.style.borderBottom = "1px solid " + errorColor;
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
    } else {

        let emailDot = emailValue.lastIndexOf(".");
        let emailAt = emailValue.indexOf("@")
        
        if(emailAt < 1  || emailDot < emailAt + 2 || emailDot + 2 >= emailValue.length) {
            email.style.color = errorColor;
            email.parentElement.style.borderBottom = "1px solid " + errorColor;
            signup.disabled = true;
            signup.style.backgroundColor = initialColor;
            signup.style.cursor = "not-allowed";

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
                            emailLabel.style.color = labelColor;
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
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
            } else {
                email.style.color = fieldColor;
                email.parentElement.style.borderBottom = "1px solid " +  fieldColor;
                signup.disabled = false;
                signup.style.cursor = "pointer";
                signup.style.backgroundColor = buttonColor;
            }

        }
    }
    preventSubmitOnEmpty();
}

var b_call_once = true;
function validateUsername() {
    const username = document.getElementsByName("username")[0];
    const signup = document.getElementsByName("signup")[0];
    let usernameValue = username.value.trim();

    if(usernameValue == "") {
        username.style.color = errorColor;
        username.parentElement.style.borderBottom = "1px solid " + errorColor;
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
    } else {
        
        if(usernameValue.search(/^[A-Za-z ]+$/)) {
            username.style.color = errorColor;
            username.parentElement.style.borderBottom = "1px solid " + errorColor;
            signup.disabled = true;
            signup.style.backgroundColor = initialColor;
            signup.style.cursor = "not-allowed";

            let text = "Only letters and white space, allowed";
            if(b_call_once == true) {
                b_call_once = false;
                let i = 0;
                let timer = setInterval(()=>{
                    if(i === 0) {
                        usernameLabel.innerText = "";
                    }
                    if(i < text.length) {
                        usernameLabel.style.color = errorColor;
                        usernameLabel.innerHTML += text.charAt(i);
                        i++;
                    } else {
                        clearInterval(timer);
                        setTimeout(()=>{
                            usernameLabel.style.color = labelColor;
                            usernameLabel.innerHTML = usernameLabelDefaultText;
                            b_call_once = true;
                        }, 1500);
                    }
                }, 50);
            }

        } else {
            
            if(usernameValue.length > 30) {
                username.style.color = errorColor;
                username.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";

                let text = "Username | Full Name is too long";
                if(b_call_once == true) {
                    b_call_once = false;
                    let i = 0;
                    let timer = setInterval(()=>{
                        if(i === 0) {
                            usernameLabel.innerText = "";
                        }
                        if(i < text.length) {
                            usernameLabel.style.color = errorColor;
                            usernameLabel.innerHTML += text.charAt(i);
                            i++;
                        } else {
                            clearInterval(timer);
                            setTimeout(()=>{
                                usernameLabel.style.color = labelColor;
                                usernameLabel.innerHTML = usernameLabelDefaultText;
                                b_call_once = true;
                            }, 1500);
                        }
                    }, 50);
                }

            } else if(usernameValue.length < 3){
                username.style.color = errorColor;
                username.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";

                let text = "Username | Full Name is too short";
                if(b_call_once == true) {
                    b_call_once = false;
                    let i = 0;
                    let timer = setInterval(()=>{
                        if(i === 0) {
                            usernameLabel.innerText = "";
                        }
                        if(i < text.length) {
                            usernameLabel.style.color = errorColor;
                            usernameLabel.innerHTML += text.charAt(i);
                            i++;
                        } else {
                            clearInterval(timer);
                            setTimeout(()=>{
                                usernameLabel.style.color = labelColor;
                                usernameLabel.innerHTML = usernameLabelDefaultText;
                                b_call_once = true;
                            }, 1500);
                        }
                    }, 50);
                }

            } else {
                username.style.color = fieldColor;
                username.parentElement.style.borderBottom = "1px solid " +  fieldColor;
                signup.disabled = false;
                signup.style.cursor = "pointer";
                signup.style.backgroundColor = buttonColor;
            }

        }
    }
    preventSubmitOnEmpty();
}


var c_call_once =  true;
function validateYearOfBirth() {
    const yearOfBirth = document.getElementsByName("yearOfBirth")[0];
    const signup = document.getElementsByName("signup")[0];
    let yearOfBirthValue = yearOfBirth.value.trim();

    if(yearOfBirthValue == "") {
        yearOfBirth.style.color = errorColor;
        yearOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
    } else {
        
        if(yearOfBirthValue.search(/^[0-9]+$/)) {
            yearOfBirth.style.color = errorColor;
            yearOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
            signup.disabled = true;
            signup.style.backgroundColor = initialColor;
            signup.style.cursor = "not-allowed";
        } else {
            
            if(yearOfBirthValue.length > 4) {
                yearOfBirth.style.color = errorColor;
                yearOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
            } else if(yearOfBirthValue.length < 4){
                yearOfBirth.style.color = errorColor;
                yearOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
            } else if(Math.abs(yearOfBirthValue - (new Date().getFullYear())) < 18){
                yearOfBirth.style.color = errorColor;
                yearOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
                let text = "You are too young";
                if(c_call_once == true) {
                    c_call_once = false;
                    let i = 0;
                    let timer = setInterval(()=>{
                        if(i === 0) {
                            yearOfBirthLabel.innerText = "";
                        }
                        if(i < text.length) {
                            yearOfBirthLabel.style.color = errorColor;
                            yearOfBirthLabel.innerHTML += text.charAt(i);
                            i++;
                        } else {
                            setTimeout(()=>{
                                yearOfBirthLabel.style.color = labelColor;
                                yearOfBirthLabel.innerHTML = yearOfBirthLabelDefaultText;
                                c_call_once = true;
                            }, 1500);
                            clearInterval(timer);
                        }
                    }, 50);
                }
                
            } else {
                yearOfBirth.style.color = fieldColor;
                yearOfBirth.parentElement.style.borderBottom = "1px solid " +  fieldColor;
                signup.disabled = false;
                signup.style.cursor = "pointer";
                signup.style.backgroundColor = buttonColor;
            }

        }
    }
    preventSubmitOnEmpty();
}

var d_call_once = true;
function validateDayOfBirth() {
    const dayOfBirth = document.getElementsByName("dayOfBirth")[0];
    const signup = document.getElementsByName("signup")[0];
    let dayOfBirthValue = dayOfBirth.value.trim();

    if(dayOfBirthValue == "") {
        dayOfBirth.style.color = errorColor;
        dayOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
    } else {
        
        if(dayOfBirthValue.search(/^[0-9]+$/)) {
            dayOfBirth.style.color = errorColor;
            dayOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
            signup.disabled = true;
            signup.style.backgroundColor = initialColor;
            signup.style.cursor = "not-allowed";
        } else {
            
            if(dayOfBirthValue.length > 2) {
                dayOfBirth.style.color = errorColor;
                dayOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
            } else if(new Number(dayOfBirthValue) < 1){
                dayOfBirth.style.color = errorColor;
                dayOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
            } else if(new Number(dayOfBirthValue) > 32){
                dayOfBirth.style.color = errorColor;
                dayOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
                let text = "Please notice day offset";
                if(d_call_once == true) {
                    d_call_once = false;
                    let i = 0;
                    let timer = setInterval(()=>{
                        if(i === 0) {
                            dayOfBirthLabel.innerText = "";
                        }
                        if(i < text.length) {
                            dayOfBirthLabel.style.color = errorColor;
                            dayOfBirthLabel.innerHTML += text.charAt(i);
                            i++;
                        } else {
                            clearInterval(timer);
                            setTimeout(()=>{
                                dayOfBirthLabel.style.color = labelColor;
                                dayOfBirthLabel.innerHTML = dayOfBirthLabelDefaultText;
                                d_call_once = true;
                            }, 1500);
                        }
                    }, 50);
                }
                
            } else {
                dayOfBirth.style.color = fieldColor;
                dayOfBirth.parentElement.style.borderBottom = "1px solid " +  fieldColor;
                signup.disabled = false;
                signup.style.cursor = "pointer";
                signup.style.backgroundColor = buttonColor;
            }

        }
    }
    preventSubmitOnEmpty();
}


function validateMonthOfBirth() {
    const monthOfBirth = document.getElementsByName("monthOfBirth")[0];
    const signup = document.getElementsByName("signup")[0];
    let monthOfBirthValue = monthOfBirth.value.trim();

    if(monthOfBirthValue == "") {
        monthOfBirth.style.color = errorColor;
        monthOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
    } else {
        
        if(monthOfBirthValue.search(/^[A-Za-z]+$/)) {
            monthOfBirth.style.color = errorColor;
            monthOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
            signup.disabled = true;
            signup.style.backgroundColor = initialColor;
            signup.style.cursor = "not-allowed";
        } else {
            
            if(monthOfBirthValue.length > 10) {
                monthOfBirth.style.color = errorColor;
                monthOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
            } else if(monthOfBirthValue.length < 3){
                monthOfBirth.style.color = errorColor;
                monthOfBirth.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";
            } else {
                monthOfBirth.style.color = fieldColor;
                monthOfBirth.parentElement.style.borderBottom = "1px solid " +  fieldColor;
                signup.disabled = false;
                signup.style.cursor = "pointer";
                signup.style.backgroundColor = buttonColor;
            }

        }
    }
    preventSubmitOnEmpty();
}


var f_call_once = true;
function validatePassword() {
    const password = document.getElementsByName("password")[0];
    const signup = document.getElementsByName("signup")[0];
    let passwordValue = password.value.trim();

    if(passwordValue == "") {
        password.style.color = errorColor;
        password.parentElement.style.borderBottom = "1px solid " + errorColor;
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
    } else {
        
        if(passwordValue.indexOf("\\") != -1) {
            password.style.color = errorColor;
            password.parentElement.style.borderBottom = "1px solid " + errorColor;
            signup.disabled = true;
            signup.style.backgroundColor = initialColor;
            signup.style.cursor = "not-allowed";

            let text = "Back slash is not allowed";
            if(f_call_once == true) {
                f_call_once = false;
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
                            passwordLabel.style.color = labelColor;
                            passwordLabel.innerHTML = passwordLabelDefaultText;
                            f_call_once = true;
                        }, 1500);
                    }
                }, 50);
            }

        } else {
            
            if(passwordValue.replace("\\", "").length > 100) {
                password.style.color = errorColor;
                password.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";

                let text = "Password is too long, you may forget it";
                if(f_call_once == true) {
                    f_call_once = false;
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
                                passwordLabel.style.color = labelColor;
                                passwordLabel.innerHTML = passwordLabelDefaultText;
                                f_call_once = true;
                            }, 1500);
                        }
                    }, 50);
                }

            } else if(passwordValue.replace("\\", "").length < 8){
                password.style.color = errorColor;
                password.parentElement.style.borderBottom = "1px solid " + errorColor;
                signup.disabled = true;
                signup.style.backgroundColor = initialColor;
                signup.style.cursor = "not-allowed";

                let text = "Password is too short, others may guess it easily";
                if(f_call_once == true) {
                    f_call_once = false;
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
                                passwordLabel.style.color = labelColor;
                                passwordLabel.innerHTML = passwordLabelDefaultText;
                                f_call_once = true;
                            }, 1500);
                        }
                    }, 50);
                }

            } else {
                password.style.color = fieldColor;
                password.parentElement.style.borderBottom = "1px solid " +  fieldColor;
                signup.disabled = false;
                signup.style.cursor = "pointer";
                signup.style.backgroundColor = buttonColor;
            }

        }
    }

    preventSubmitOnEmpty();
}


function preventSubmitOnEmpty() {
    if(email.value === "" ||  username.value === "" || 
    dayOfBirth.value === "" ||  yearOfBirth.value === "" || 
    monthOfBirth.value === "" || password.value === "") {
        const signup = document.getElementsByName("signup")[0];
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
    }
}


function createAccount() {
    if(email.value === "" ||  username.value === "" || 
    dayOfBirth.value === "" ||  yearOfBirth.value === "" || 
    monthOfBirth.value === "" || password.value === "") {
        const signup = document.getElementsByName("signup")[0];
        signup.disabled = true;
        signup.style.backgroundColor = initialColor;
        signup.style.cursor = "not-allowed";
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
                    let text = "Server: Email field is invalid";
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
                                    emailLabel.style.color = labelColor;
                                    emailLabel.innerHTML = emailLabelDefaultText;
                                    a_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }

                if(error.emailExist === true) {  
                    let text = "Sorry! another person owns this email";
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
                                    emailLabel.style.color = labelColor;
                                    emailLabel.innerHTML = emailLabelDefaultText;
                                    a_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }

                if(error.username === true) {  
                    let text = "Server: Username | Full Name field is invalid";
                    if(b_call_once == true) {
                        b_call_once = false;
                        let i = 0;
                        let timer = setInterval(()=>{
                            if(i === 0) {
                                usernameLabel.innerText = "";
                            }
                            if(i < text.length) {
                                usernameLabel.style.color = errorColor;
                                usernameLabel.innerHTML += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(timer);
                                setTimeout(()=>{
                                    usernameLabel.style.color = labelColor;
                                    usernameLabel.innerHTML = usernameLabelDefaultText;
                                    b_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }

                if(error.dayOfBirth === true) {  
                    let text = "Server: Day of birth field is invalid";
                    if(c_call_once == true) {
                        c_call_once = false;
                        let i = 0;
                        let timer = setInterval(()=>{
                            if(i === 0) {
                                dayOfBirthLabel.innerText = "";
                            }
                            if(i < text.length) {
                                dayOfBirthLabel.style.color = errorColor;
                                dayOfBirthLabel.innerHTML += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(timer);
                                setTimeout(()=>{
                                    dayOfBirthLabel.style.color = labelColor;
                                    dayOfBirthLabel.innerHTML = dayOfBirthLabelDefaultText;
                                    c_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }

                if(error.yearOfBirth === true) {  
                    let text = "Server: Year of birth field is invalid";
                    if(c_call_once == true) {
                        c_call_once = false;
                        let i = 0;
                        let timer = setInterval(()=>{
                            if(i === 0) {
                                yearOfBirthLabel.innerText = "";
                            }
                            if(i < text.length) {
                                yearOfBirthLabel.style.color = errorColor;
                                yearOfBirthLabel.innerHTML += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(timer);
                                setTimeout(()=>{
                                    yearOfBirthLabel.style.color = labelColor;
                                    yearOfBirthLabel.innerHTML = yearOfBirthLabelDefaultText;
                                    c_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }

                if(error.monthOfBirth === true) {  
                    let text = "Server: Month of birth field is invalid";
                    if(c_call_once == true) {
                        c_call_once = false;
                        let i = 0;
                        let timer = setInterval(()=>{
                            if(i === 0) {
                                monthOfBirthLabel.innerText = "";
                            }
                            if(i < text.length) {
                                monthOfBirthLabel.style.color = errorColor;
                                monthOfBirthLabel.innerHTML += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(timer);
                                setTimeout(()=>{
                                    monthOfBirthLabel.style.color = labelColor;
                                    monthOfBirthLabel.innerHTML = monthOfBirthLabelDefaultText;
                                    c_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }

                if(error.password === true) {  
                    let text = "Server: password field is invalid";
                    if(c_call_once == true) {
                        c_call_once = false;
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
                                    passwordLabel.style.color = labelColor;
                                    passwordLabel.innerHTML = passwordLabelDefaultText;
                                    c_call_once = true;
                                }, 1500);
                            }
                        }, 50);
                    }
                }


                console.log(error);
                loader.style.display = "none";
            }
        }
        xmlHttpRequest.open("POST", "./CreateAccount.php");
        xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttpRequest.send(`email=${ email.value }&username=${ username.value }&dayOfBirth=${ dayOfBirth.value }&yearOfBirth=${ yearOfBirth.value }&monthOfBirth=${ monthOfBirth.value }&password=${ password.value }&CreateAccount=true`);


    }
}