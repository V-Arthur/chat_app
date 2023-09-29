<?php
// Arthur Vartanian     Art&Tech
if(!isset($_POST["postcheck"])){
    header("Location: login.php");
}

$required = array('gebruikernaam', 'wachtwoord');

$error = false;
foreach($required as $field){
    if(empty($_POST[$field])){
        $error = true;
    }
}
if($error){
    echo "Vul alle velden in!<br>";
    echo 'Je wordt automatisch teruggestuurd...';
    header("Refresh: 3; login.php");
}
else{
                        // server, username, password, database
    // $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");
    // standaard localhost login gebruikersnaam is "root" en paswoord is ""
    $mysqli = new mysqli("localhost", "root", "", "socialenetwerksite");
    
    $gebruikernaam = $_POST["gebruikernaam"];
    $wachtwoord = $_POST["wachtwoord"];
    
    if($mysqli->connect_error){
        die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    if($query = $mysqli->query("SELECT gebruikerid, gebruikernaam, wachtwoord "
            . "FROM Gebruikers WHERE gebruikernaam='$gebruikernaam' AND wachtwoord='$wachtwoord'")){
        if($query->num_rows > 0){
            $gebruiker = $query->fetch_object();
            echo "Welkom, " . $gebruiker->gebruikernaam . "!<br>Je word automatisch doorgestuurd...";
            setcookie("GebruikerId", $gebruiker->gebruikerid, time()+60*60*24*1);
            header("Refresh: 3; index.php");
        }
        else{
            echo "Je gebruikernaam of wachtwoord zijn verkeerd, probeer opnieuw. "
            . "<br> Je word automatisch teruggestuurd...";
            header("Refresh: 3; login.php");
        }
    }
    $mysqli->close();

}
?>
