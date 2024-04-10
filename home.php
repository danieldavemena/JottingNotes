<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" type="text/css" href="/css/materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <title>Jotting.com</title>
</head>
<body>
    
    <div class="centerClass">
        <div>
            <h1>Jotting.com</h1>
        </div>
        <div class="accBtn">
            <div class="signup btn " name="signup">Sign up</div>
            <div class="login btn " name="login">Log in</div>
        </div>
    </div>

    
    <div class="accForms">
        <!-- FOR SIGNUP -->
        <form class="signupForm hide" action="index.php" method="POST">
            <div class="closeBtn"><i class="material-icons">close</i></div>
            <label for="username">Username: </label>
            <input type="text" name="username"><br>
            <label for="email">Email Address: </label>
            <input type="text" name="email"><br>
            <label for="password">Password: </label>
            <input type="password" name="password"><br>
            <input type="hidden" name="pageCounter" value="<?php $pageCounter ?>">
            <input class="submits btn" type="submit" name="signupSubmit">


        </form>

        <!-- FOR LOGIN -->
        <form class="loginForm hide" action="index.php" method="POST">
            <div class="closeBtn"><i class=" material-icons">close</i></div>
            <label for="username">Username: </label>
            <input type="text" name="username"><br>
            <label for="password">Password: </label>
            <input type="password" name="password"><br>
            <input type="hidden" name="uiMode" value="light">
            <input class="submits btn" type="submit" name="loginSubmit">
        </form>

    </div>

    
    <!-- UI MODE BUTTON -->
    <div class="buttons">
        <div class="darkmode"><i class="material-icons">dark_mode</i></div>
        <div class="lightmode hide"><i class="material-icons">light_mode</i></div>
    </div>
    
    
<script type="text/javascript" src="/css/materialize/js/materialize.js"></script>
<script type="text/javascript" src="/css/materialize/js/jquery.js"></script>

<script type="text/javascript">

    // UI MODE
    $(".darkmode").click(function() {
        $("body").css({"background-color": "#444", "color": "#e2e7b9"});
        $(this).addClass("hide");
        $(".accBtn div").css({"background-color":"#e2e7b9", "color": "#444"});
        $(".lightmode").removeClass("hide");
        $('input[name="uiMode"]').val('dark');
        $("form").css({"background-color": "#e2e7b9", "color": "#444"});
        $("label, input, .closeBtn").css({"color": "#444"});
        $("form .btn").css({"background-color": "#444", "color": "#e2e7b9"});
    })

    $(".lightmode").click(function() {
        $("body").css({"background-color": "#e2e7b9", "color": "#444"});
        $(".accBtn div").css({"background-color": "#444", "color": "#e2e7b9"});
        $(this).addClass("hide");
        $(".darkmode").removeClass("hide");
        $('input[name="uiMode"]').val('light');
        $("form").css({"background-color": "#444", "color": "#e2e7b9"});
        $("label, input, .closeBtn").css({"color": "#e2e7b9"});
        $("form .btn").css({"background-color": "#e2e7b9", "color": "#444"});
    })

    // FORMS
    $(".signup").click(function() {
        $(".signupForm").removeClass("hide");
    })

    $(".login").click(function() {
        $(".loginForm").removeClass("hide");
    })

    $(".closeBtn").click(function() {
        $("form").addClass("hide");
    })


</script>
</body>
</html>