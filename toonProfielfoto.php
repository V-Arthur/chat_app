<?php
// Arthur Vartanian     Art&Tech
$id = $_GET['id'];
// $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");
$mysqli = new mysqli("localhost", "root", "", "socialenetwerksite");

if($mysqli->connect_error){
    die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if($query = $mysqli->query("SELECT profielfoto FROM Gebruikers WHERE gebruikerid = '$id'")){
    if($query ->num_rows > 0){
        $profielfoto = $query->fetch_object();
    }
}

header("content-type: image/jpeg");
echo $profielfoto->profielfoto;

$mysqli->close();
?>