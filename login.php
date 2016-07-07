<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Kris De Winter">
    <title>Instellingenscherm</title>
<style>
    body {
    font-family: Montserrat, Calibri, sans-serif;
    }
    h1 {
        margin-left: 25px;
    }
    .loginform {
        width: 320px;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        border-top: 5px solid #77cbf0;
        border-left: 1px solid #9a9797;
        border-right: 1px solid #9a9797;
        border-bottom: 1px solid #9a9797;
        margin-left: 25px;
    }
    .loginform h3 {
        text-align: center;
        color: #000;
        font-size: 18px;
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 20px;
    }
    .loginform p {
        text-align: left;
        color: #000;
        font-size: 12px;
        margin-top: 0;
        margin-bottom: 20px;
    }
    label {
        padding-right: 10px;
    }
    input {
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 14px;
        padding: 0 20px 0 5px;
        outline: none;
    }
    .submit {
        width: 100%;
        height: 40px;
        background: #77cbf0;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
        font-family: Montserrat;
        outline: none;
        cursor: pointer;
    }
    .submit:hover {
    background: #55bcea;
}
</style>

</head>
<body>
<h1>Bepaal de inhoud van de carrousel</h1>
    <div class="loginform">
    <h3>Login</h3>
    <p>Geef eerst je wachtwoord in om toegang te krijgen tot het configuratieformulier</p>
    
    <form method="post">
    <label>Wachtwoord</label><input type="text" name="login">
    <input type="submit" class="submit">
    </form>
    </div>

<?php 
    if (isset ($_POST["login"])) 
    {
        $login = $_POST["login"];
        if ($login == "") // vul tussen de aanhalingstekens een wachtwoord naar keuze in
        {
            session_start();
            $_SESSION["userbibapiding"]="ingelogdeBADgebruiker";
            header("location:config.php");      
        }
    }
        
?>
    
</body>
</html>