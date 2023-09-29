<?php
// Arthur Vartanian     Art&Tech
header('Content-type: application/json');

if (isset($_POST["postcheck"])) {
    $gebruikerid = filter_input(INPUT_COOKIE, "GebruikerId");
    $bericht = filter_input(INPUT_POST, "bericht");
    
    $datum = date("Y/m/d");
    
    $response = array();
    
    if(trim($bericht) != ""){
        // $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");
        $mysqli = new mysqli("localhost", "root", "", "socialenetwerksite");

        if($mysqli->connect_error){
            die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
            $response['status'] = 'error';
            $response['message'] = 'FOUT - Kon bericht niet verzenden, probeer het opnieuw.';
        }

        if($query = $mysqli->query("INSERT INTO Berichten (gebruikerid, inhoud, datum) "
                . "VALUES ('$gebruikerid', '$bericht', '$datum')")){
            
            if($select = $mysqli->query("SELECT * FROM Gebruikers WHERE gebruikerid = '$gebruikerid'")){
                if($select ->num_rows > 0){
                    $gebruikernaam = $select->fetch_object();
                    $response['status'] = 'success';
                    $response['message'] = "Door " . $gebruikernaam->gebruikernaam . " op " . $datum . ": <br>" . $bericht;
                }
            }
            else{
                $response['status'] = 'error';
                $response['message'] = 'FOUT - Kon bericht niet verzenden, probeer het opnieuw.';
            }
            
        }
        else{
            $response['status'] = 'error';
            $response['message'] = 'FOUT - Kon bericht niet verzenden, probeer het opnieuw.';
        }
        echo json_encode($response);
        $mysqli->close();
    }
    
}
//header("location:index.php");
?>