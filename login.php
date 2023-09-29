<?php
// Arthur Vartanian     Herkansing      Art&Tech
$controleCookie = filter_input(INPUT_COOKIE, "GebruikerId");
if(isset($controleCookie)){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Erasmus chat login</title>
        <link href="css/erasmuschat.css" rel="stylesheet" type="text/css">
        <link href="css/login.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section id="wrapper">
            <header>
                <h1 id="paginaTitel">Erasmus chat</h1>
            </header>
            
            <section id="content">
                <form id="loginform" action="loginControle.php" method="POST" autocomplete="on">
                    <fieldset>
                        <legend>Login gegevens</legend>
                        <label>Gebruikernaam <input class="input" type="text" name="gebruikernaam" value=""></label> <br>
                        <label>Wachtwoord <input class="input" type="password" name="wachtwoord" value=""></label><br>
                        <input type="hidden" name="postcheck" value="true"/>
                        <input id="submit" type="submit" value="Log in">
                    </fieldset>
                </form>
                <a href="registreer.php">Nog geen account? Registreer je nu!</a>
            </section>
        </section>
    </body>
</html>
