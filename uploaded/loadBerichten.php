<?php
Header('Content-type: text/xml');
if (isset($_POST["postcheck"])) {
    $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");

    if($mysqli->connect_error){
        die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    $aantal;

    if($query = $mysqli->query("SELECT * FROM Berichten")){
        if($query ->num_rows > 0){
            $aantal = $query->num_rows;
        }
    }

    $xml = new SimpleXMLElement('<xml/>');

    for ($i = 0; $i < $aantal; $i++) {
        if($select = $mysqli->query("SELECT * FROM Berichten LIMIT $i, 1")){
            if($select ->num_rows > 0){
                $bericht = $select->fetch_object();
                $gebruikerid = $bericht->gebruikerid;

                if($naam = $mysqli->query("SELECT * FROM Gebruikers WHERE gebruikerid = '$gebruikerid'")){
                    if($naam ->num_rows > 0){
                        $gebruikernaam = $naam->fetch_object();

                        $post = $xml->addChild('bericht');
                        $post->addChild('gebruikernaam', $gebruikernaam->gebruikernaam);
                        $post->addChild('datum', $bericht->datum);
                        $post->addChild('inhoud', $bericht->inhoud);
                    }
                }

            }
        }
    }
    print($xml->saveXML());
    $mysqli->close();
}
?>