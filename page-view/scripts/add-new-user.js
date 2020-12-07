import login from './login.js';
export default function addUser(element){

    element.addEventListener("click", ()=>{

        const request = new XMLHttpRequest();
        let key = "new-user=query";
        console.log(key); 

        request.onreadystatechange = function(){
            
            console.log(this.responseText);

            if(request.readyState === 4){
                let respObj = JSON.parse(this.responseText);
                if(request.status === 200){
                    const main = document.querySelector("main");
                    if(respObj["loggedIn"]){
                        main.innerHTML = respObj['message'];
                        onSubmitNewUser();
                    }
                    else{
                        main.innerHTML = respObj['message'];
                        let loginButto = document.querySelector("#login_button");
                        login(loginButto);
                    }
                }
                if(request.status === 404){
                    msgArea.innerHTML = "404 ERROR"; 
                }
            }
        }
        request.open('GET', 'controller/controller.php?'+key, true);
        //request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send();
    });
}

function onSubmitNewUser(){
    
}