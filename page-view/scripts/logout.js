import login from './login.js';
export default function logout(element){

    element.addEventListener("click", ()=>{
        
        const request = new XMLHttpRequest();
        let key = "logout=query";
        request.onreadystatechange = function(){
            console.log(request.responseText)
            if(request.readyState === 4){
                if(request.status === 200){
                    const main = document.querySelector("main");
                    main.innerHTML = request.responseText;
                    const loginButton = document.querySelector("#login_button");
                    login(loginButton);
                }
                if(request.status === 404){
                    alert("404 ERROR");
                
                }
            }
        };
        request.open('GET', 'php/controller.php?'+key, true);
        request.send();
    });
}