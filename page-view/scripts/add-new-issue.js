import login from './login.js';
export default function addIssue(element){

    element.addEventListener("click", function(){
        const request = new XMLHttpRequest();
        let key = "add_issue=yes";
        console.log(key); 

        request.onreadystatechange = function(){
            
            console.log(this.responseText);

            if(request.readyState === 4){
                let respObj = JSON.parse(this.responseText);
                if(request.status === 200){
                    const main = document.querySelector("main");
                    if(respObj["loggedIn"]){
                        main.innerHTML = respObj['message'];
                        loadUsersInMenu(respObj['users']);
                        onSubmitNewIssue();
                    }
                    else{
                        main.innerHTML = respObj['message'];
                        const loginButton = document.querySelector("#login_button");
                        login(loginButton);
                    }
                }
                if(request.status === 404){
                    msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        }
        request.open('GET', 'php/controller.php?'+key, true);
        //request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send();
    });

}

function onSubmitNewIssue(){
    const submitIssue = document.getElementById('submit-issue-btn');
    submitIssue.addEventListener("click", function(){
        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let assignedTo = document.getElementById('assigned_to').value;
        let type = document.getElementById('type').value;
        let priority = document.getElementById('priority').value;
        const request = new XMLHttpRequest();
        let key = "title="+title+"&description="+description+"&assigned_to="+assignedTo+"&type="+type+"&priority="+priority;
        console.log(key); 

        request.onreadystatechange = function(){
            
            console.log(this.responseText);

            if(request.readyState === 4){
                // let respObj = JSON.parse(this.responseText);
                if(request.status === 200){
                    if(respObj["status"]){
                        const msg = document.querySelector(".msg");
                        msg.innerHTML = respObj['message'];
                    }
                    else{
                        msg.innerHTML = respObj['message'];
                    }
                }
                if(request.status === 404){
                    msg.innerHTML = "404 ERROR"; 
                }
            }
        };
        request.open('POST', 'php/controller.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send(key);
    });
}

function loadUsersInMenu(users){

    const assignedToField = document.getElementById('assigned_to');
    let userList = JSON.parse(users);
    console.log(userList);
    let option;
    userList.forEach(element => {
        option = document.createElement('option');
        option.textContent = element.firstname+" "+element.lastname;
        option.value = element.id;
        assignedToField.appendChild(option);
    });


}