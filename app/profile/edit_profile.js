let initiateOnce = true;
function updateAccount() {
    const userID = document.getElementsByName("userID")[0];
    const userName = document.getElementsByName("userName")[0];
    const yearOfBirth = document.getElementsByName("yearOfBirth")[0];
    const dayOfBirth = document.getElementsByName("dayOfBirth")[0];
    const monthOfBirth = document.getElementsByName("monthOfBirth")[0];
    const LINE = document.getElementsByName("LINE")[0];
    const loader = document.getElementById("ajax");

    const userIDLabel = userID.previousElementSibling;
    const userNameLabel = userName.previousElementSibling;
    const yearOfBirthLabel = yearOfBirth.previousElementSibling;
    const dayOfBirthLabel = dayOfBirth.previousElementSibling;
    const monthOfBirthLabel = monthOfBirth.previousElementSibling;
    const LINELabel = LINE.previousElementSibling;
    if (initiateOnce === true) {
        initiateOnce = false;
        sessionStorage.setItem("userIDLabel", userIDLabel.innerHTML);
        sessionStorage.setItem("userNameLabel", userNameLabel.innerHTML);
        sessionStorage.setItem("yearOfBirthLabel", yearOfBirthLabel.innerHTML);
        sessionStorage.setItem("dayOfBirthLabel", dayOfBirthLabel.innerHTML);
        sessionStorage.setItem("monthOfBirthLabel", monthOfBirthLabel.innerHTML);
        sessionStorage.setItem("LINELabel", LINELabel.innerHTML);
    }

    const userIDLabelDefaultText = sessionStorage.getItem("userIDLabel");
    const userNameLabelDefaultText = sessionStorage.getItem("userNameLabel");
    const yearOfBirthLabelDefaultText = sessionStorage.getItem("yearOfBirthLabel");
    const dayOfBirthLabelDefaultText = sessionStorage.getItem("dayOfBirthLabel");
    const monthOfBirthLabelDefaultText = sessionStorage.getItem("monthOfBirthLabel");
    const LINELabelDefaultText = sessionStorage.getItem("LINELabel");


    const userIDValue = userID.value.trim();
    const userNameValue = userName.value.trim();
    const yearOfBirthValue = yearOfBirth.value.trim();
    const monthOfBirthValue = monthOfBirth.value.trim();
    const dayOfBirthValue = dayOfBirth.value.trim();
    const LINEValue = LINE.value.trim();
    let preventUpdate = false;
    let errorColor = '#df0000';
    let initialColor = '#000';

    if (userIDValue.slice(1) == "") {
        userID.style.border = "1px solid " + errorColor;
        userIDLabel.innerHTML = "User ID must not be null";
        userIDLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (userIDValue.slice(1).search(/^[a-zA-Z0-9]*$/)) {
        userID.style.border = "1px solid " + errorColor;
        userIDLabel.innerHTML = "Invalid ID, only letters and numbers allowed";
        userIDLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (!userIDValue.startsWith("@")) {
        userID.style.border = "1 px solid " + errorColor;
        userIDLabel.innerHTML = "ID must start with @ symbol";
        userIDLabel.style.color = errorColor;
        preventUpdate = true;
    } else {
        userID.style.border = "none";
        userIDLabel.innerHTML = userIDLabelDefaultText;
        userIDLabel.style.color = initialColor;
    }

    if (userNameValue == "") {
        userNameLabel.innerHTML = "User Name must not be null";
        userName.style.border = "1px solid " + errorColor;
        userIDLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (userNameValue.search(/^[a-zA-Z ]+$/)) {
        userNameLabel.innerHTML = "User Name is invalid, only letters and white space allowed";
        userName.style.border = "1px solid " + errorColor;
        userNameLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (userNameValue.length > 30) {
        userNameLabel.innerHTML = "User Name is too long";
        userName.style.border = "1px solid " + errorColor;
        userNameLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (userNameValue.length < 3) {
        userNameLabel.innerHTML = "User Name is too short";
        userName.style.border = "1px solid " + errorColor;
        userNameLabel.style.color = errorColor;
        preventUpdate = true;
    } else {
        userName.style.border = "none";
        userNameLabel.style.color = initialColor;
        userNameLabel.innerHTML = userNameLabelDefaultText;
    }

    if (dayOfBirthValue.search(/^[0-9]+$/)) {
        dayOfBirth.style.border = "1px solid " + errorColor;
        dayOfBirthLabel.innerHTML = "Invalid birth date";
        dayOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (dayOfBirthValue > 32) {
        dayOfBirth.style.border = "1px solid " + errorColor;
        dayOfBirthLabel.innerHTML = "Notice birth date offset";
        dayOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (dayOfBirthValue < 1) {
        dayOfBirth.style.border = "1px solid " + errorColor;
        dayOfBirthLabel.innerHTML = "Invalid birth date";
        dayOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else {
        dayOfBirth.style.border = "none";
        dayOfBirthLabel.innerHTML = dayOfBirthLabelDefaultText;
        dayOfBirthLabel.style.color = initialColor;
    }

    if (yearOfBirthValue.search(/^[0-9]+$/)) {
        yearOfBirth.style.border = "1px solid " + errorColor;
        yearOfBirthLabel.innerHTML = "Invalid birth year";
        yearOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (yearOfBirthValue.length < 4) {
        yearOfBirth.style.border = "1px solid " + errorColor;
        yearOfBirthLabel.innerHTML = "Invalid birth year";
        yearOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (yearOfBirthValue < 18) {
        yearOfBirth.style.border = "1px solid " + errorColor;
        yearOfBirthLabel.innerHTML = "you are too yong";
        yearOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else {
        yearOfBirth.style.border = "none";
        yearOfBirthLabel.innerHTML = yearOfBirthLabelDefaultText;
        yearOfBirthLabel.style.color = initialColor;
    }

    if (monthOfBirthValue == "") {
        monthOfBirthLabel.innerHTML = "month of birth must not be null";
        monthOfBirth.style.border = "1px solid " + errorColor;
        userIDLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (monthOfBirthValue.search(/^[a-zA-Z]+$/)) {
        monthOfBirthLabel.innerHTML = "month of birth is invalid";
        monthOfBirth.style.border = "1px solid " + errorColor;
        monthOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (monthOfBirthValue.length > 10) {
        monthOfBirthLabel.innerHTML = "Invalid";
        monthOfBirth.style.border = "1px solid " + errorColor;
        monthOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else if (monthOfBirthValue.length < 3) {
        monthOfBirthLabel.innerHTML = "Invalid";
        monthOfBirth.style.border = "1px solid " + errorColor;
        monthOfBirthLabel.style.color = errorColor;
        preventUpdate = true;
    } else {
        monthOfBirth.style.border = "none";
        monthOfBirthLabel.style.color = initialColor;
        monthOfBirthLabel.innerHTML = monthOfBirthLabelDefaultText;
    }

    if (LINEValue != "") {
        if (LINEValue.length < 3) {
            LINELabel.innerHTML = "LINE is too short";
            LINE.style.border = "1px solid " + errorColor;
            LINELabel.style.color = errorColor;
            preventUpdate = true;
        } else if (LINEValue.length > 120) {
            LINELabel.innerHTML = "LINE is too long (120 characters)";
            LINE.style.border = "1px solid " + errorColor;
            LINELabel.style.color = errorColor;
            preventUpdate = true;
        } else {
            LINE.style.border = "none";
            LINELabel.style.color = initialColor;
            LINELabel.innerHTML = LINELabelDefaultText;
        }
    } else {
        LINE.style.border = "none";
        LINELabel.style.color = initialColor;
        LINELabel.innerHTML = LINELabelDefaultText;
    }


    if (preventUpdate === false) {
        const xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onreadystatechange = function () {
            //console.log(this.responseText);
            if(this.readyState == 4 && this.status == 308) {
                document.getElementById("popAlert").style.display = "block";
                console.log("Profile updated");
            }
            if (this.readyState == 4 && this.status == 200) {
                loader.style.display = "none";
                console.log(this.responseText);

            } else if (this.readyState == 4 && this.status == 400) {
                console.log(this.responseText);
            }
        }
        xmlHttpRequest.open("POST", "/app/account/update/updateProfile.php");
        xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttpRequest.send(`userID=${userIDValue}&userName=${userNameValue}&dayOfBirth=${dayOfBirthValue}&yearOfBirth=${yearOfBirthValue}&monthOfBirth=${monthOfBirthValue}&LINE=${LINEValue}`);

    }

}

// function validateURL(url) {
//     let givenURL;
//     try {
//         givenURL = new URL(url);
//     } catch (e) {
//         console.log("invalid url");
//         return false;
//     }
//     return givenURL.protocol === "http:" || givenURL.protocol === "https:";
// }