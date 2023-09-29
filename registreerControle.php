<?php
// Arthur Vartanian     Herkansing      Art&Tech
if(!isset($_POST["postcheck"])){
    header("Location: registreer.php");
}

// voor bestand te controleren
$bestandNaam = $_FILES["bestand"]["name"];
$bestandType = $_FILES["bestand"]["type"];
$bestandGrootte = $_FILES["bestand"]["size"];
$bestandError = $_FILES["bestand"]["error"];
$bestandTemp = $_FILES["bestand"]["tmp_name"];

// voor insert into
$voornaam = filter_input(INPUT_POST, "voornaam");
$familienaam = filter_input(INPUT_POST, "familienaam");
$gebruikernaam = filter_input(INPUT_POST, "gebruikernaam");
$wachtwoord = filter_input(INPUT_POST, "wachtwoord");
$wachtwoordBevestigen = filter_input(INPUT_POST, "wachtwoordBevestigen");
$geboortedatum = filter_input(INPUT_POST, "geboortedatum");
$geslacht = filter_input(INPUT_POST, "geslacht");
$profielfoto = addslashes(file_get_contents($bestandTemp));

// controleren of alle velden zijn ingevuld
$required = ['voornaam', 'familienaam', 'gebruikernaam', 'wachtwoord', 
    'wachtwoordBevestigen', 'geboortedatum', 'geslacht'];

$error = false;
$error2 = false;
foreach($required as $field){
    if(empty($_POST[$field])){
        $error = true;
    }
}

if($error){
    echo "Vul alle velden in!<br>";
    echo 'Je wordt automatisch teruggestuurd...';
    header("Refresh: 3; registreer.php");
}
else{
    if($bestandError > 0){
        die("Fout: kon bestand niet uploaden, probeer het opnieuw.<br>");
        $error2 = true;
    }
    else{
        if($bestandType != "image/jpeg" || $bestandGrootte > 1000000){
            die("Fout: Uw profielfoto moet van het type jpeg zijn en mag niet groter zijn dan 1MB.<br>"
                    . "De maximum breedte is 150px en maximum hoogte is 150px");
            $error2 = true;
        }
        
        $grootte = getimagesize($bestandTemp);
        if($grootte[0] > 150 || $grootte[1] > 200){
            die("Fout: Uw profielfoto moet van het type jpeg zijn en mag niet groter zijn dan 1MB.<br>"
                    . "De maximum breedte is 150px en maximum hoogte is 150px");
            $error2 = true;
        }
        
    }
    
    if(strcmp($wachtwoord, $wachtwoordBevestigen) != 0){
        die("Wachtwoorden komen niet overeen, probeer opnieuw.<br>");
        $error2 = true;
    }
    
    if(strlen($wachtwoord) < 6){
        die("Uw wachtwoord moet minstens 6 tekens bevatten!<br>");
        $error2 = true;
    }
    
    // $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");
    $mysqli = new mysqli("localhost", "root", "", "socialenetwerksite");

    if($mysqli->connect_error){
        die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        $error2 = true;
    }
    
    if($controleid = $mysqli->query("SELECT gebruikernaam FROM Gebruikers "
            . "WHERE gebruikernaam = '$gebruikernaam'")){
        if($controleid->num_rows > 0){
            echo "Gebruikernaam bestaat al!";
            $error2 = true;
            //header("Refresh: 3; registreer.php");
        }
    }
    
    if(!$error2){
        $sql = "INSERT INTO Gebruikers (voornaam, familienaam, gebruikernaam, "
                . "wachtwoord, geboortedatum, geslacht, profielfoto) "
                . "VALUES ('$voornaam', '$familienaam', '$gebruikernaam', "
                . "'$wachtwoord', '$geboortedatum', '$geslacht', '$profielfoto')";
        
        if ($mysqli->query($sql) === TRUE) {
            if($query = $mysqli->query("SELECT gebruikerid, gebruikernaam FROM Gebruikers WHERE gebruikernaam='$gebruikernaam'")){
                $gebruiker = $query->fetch_object();
                echo "Yay! U bent succesvol geregistreerd. Welkom, " . $gebruiker->gebruikernaam . "!<br> Bezig met inloggen...";
                setcookie("GebruikerId", $gebruiker->gebruikerid, time()+60*60*24*1);
                header("Refresh: 3; index.php");
            }
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
    
    $mysqli->close();
}
?>