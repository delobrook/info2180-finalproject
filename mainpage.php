
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugMe Issue Tracker</title>
    <script type='module' src="./page-view/scripts/index.js"></script>
    <link rel="stylesheet" href="./page-view/styles/mainpage.css">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/new_user.css">
    <link rel="stylesheet" href="styles/new_issue.css">
    <link rel="stylesheet" href="styles/issue.css">
</head>
<body>
    
    <?php require_once "page-view/header.php";?>
    <!--main section-->
        
    <!--side bar of the page-->
    <?php require_once "page-view/sidebar.php";?>
    
    <!--main section of the page-->
    <main>
        <section id="login">
            <h3>SIGN IN</h3>
            <div class="form-field">
                
                <input type="text" name="email" id="email" placeholder="Enter email"> 
            </div>
            <div class="form-field">
                
                <input type="password" name="password" id="password" placeholder="password">
            </div>
            <button id=login_button>Login</button>
            <p class="error-msg"></p>
            </div>
        </section>
    </main>
</body>
</html>