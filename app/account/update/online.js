online();
function online() {
    const xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onload = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log("Active status updated: " + this.responseText);
            let t = Date.parse(this.responseText);
            let d = new Date(t);
            console.log(d.getFullYear());
        }
    };
    xmlHttpRequest.open("GET", "/app/account/update/online.php?time=" + (new Date()));
    xmlHttpRequest.send();
    setTimeout(online, (1000 * ((60 * 4) - 30)));
}