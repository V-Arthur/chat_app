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
        <title>Erasmus chat registreer</title>
        <link href="css/erasmuschat.css" rel="stylesheet" type="text/css">
        <link href="css/registreer.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section id="wrapper">
            <header>
                <h1 id="paginaTitel">Erasmus chat</h1>
            </header>
            
            <section id="content">
                <form id="registreerform" action="registreerControle.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Vul uw gegevens in</legend>
                        <label>Velden aangeduid met een * zijn verplicht.</label> <br>
                        <label for="voornaam">Voornaam*</label> <input type="text" id="voornaam" name="voornaam" value=""><br>
                        <label for="familienaam">Familienaam*</label> <input type="text" id="familienaam" name="familienaam" value=""><br>
                        <label for="gebruikernaam">Loginnaam*</label> <input type="text" id="gebruikernaam" name="gebruikernaam" value=""><br>
                        <label for="wachtwoord">Wachtwoord*</label> <input type="password" id="wachtwoord" name="wachtwoord" value=""><br>
                        <label for="wachtwoordBevestigen">Wachtwoord bevestigen*</label> <input type="password" id="wachtwoordBevestigen" name="wachtwoordBevestigen" value=""><br>
                        <label for="geboortedatum">Geboortedatum*</label> <input type="date" id="geboortedatum" name="geboortedatum" value=""><br>

                        <label id="geslacht">Geslacht*</label> <input type="radio" name="geslacht" id="m" value="m"><span class="geslacht">Man</span><br>
                        <input type="radio" name="geslacht" id="v" value="v"><span class="geslacht">Vrouw</span> <br>

                        <label id="profielfoto">Profiel foto*</label><input type="file" name="bestand" id="bestand"><br>
                        <input type="hidden" name="postcheck" value="true"/>
                        <input id="submit" type="submit" value="Registreer">
                    </fieldset>
                </form>
                <a href="login.php">Terug naar login</a>
            </section>
        
        </section>
    </body>
</html>
