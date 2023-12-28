var resultMain = document.getElementById('chats-search-result-main');
var result = document.getElementById('chats-search-result');
function searchChat(input) {
    const stripInput = input.value.replace(/[^a-zA-Z0-9 ]/gm, '');
    const xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onload = function() {
        if(this.status == 200 && this.responseText.trim() != '') {
            let template = '';
            let searchResult = JSON.parse(this.responseText);
            for(let i = 0; i < searchResult.length; i++) {

                let singleResult = searchResult[i];
                let profilePhto = (singleResult.Photo == 'default')? '/uploads/photo_4598749587394875934593874/default.png' : '/uploads/photo_4598749587394875934593874/' + singleResult.Photo;

                template += `
                <li>
                <div class="left">
                    <span class="icon">
                        <img src="${profilePhto}" alt="icon" width="40"/>
                    </span>
                </div>
                <div class="center">
                    <b class="title">${singleResult.UserName}</b><br/>
                    <i class="userkey">${singleResult.UserKey}</i>
                </div>
                <div class="right">
                    <button class="button" onclick="addChat('${singleResult.UserKey}');addThis();">Add</button>
                </div>
                </li>
                `;

            }

            resultMain.style.display = 'block';
            result.innerHTML = template;
            
        } else {
            result.innerHTML = "No result";
            resultMain.style.display = 'none';
        }
    }
    xmlHttpRequest.open('GET', '/app/chats/search.php?q='+ encodeURIComponent(stripInput));
    xmlHttpRequest.send();
}