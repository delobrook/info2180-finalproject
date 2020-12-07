import {AllIssues} from './home.js';

export default function login(element){

    element.addEventListener('click', () =>{

        const email = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;
        const request = new XMLHttpRequest();
        let key = "email="+email+"&password="+password;
        console.log(key); 

        sendRequest(request, key);

    });
}
function sendRequest(requestObj, key){
        
    requestObj.onreadystatechange = () => {
    
        console.log(requestObj.responseText);

        if(requestObj.readyState === 4){
            let respObj = JSON.parse(requestObj.responseText);
            let msgArea = document.querySelector("#login .error_msg");
            if(requestObj.status === 200){
                if(respObj["loggedIn"]){
                    const main = document.querySelector("main");
                    main.innerHTML = respObj['message'];
                    loadTableWithAllIssues('all-btn');
                }
                else{
                    msgArea.innerHTML = respObj['message'];
                }
            }else if(requestObj.status === 404){
                msgArea.innerHTML = "404 ERROR "; 
                
            }
        }
    }

    requestObj.open('GET', 'php/controller.php?'+key, true);
    requestObj.send();

}