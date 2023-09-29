<?php
// Arthur Vartanian     Art&Tech
class indexData{
    var $id;
            
    function setId($gebruikerid){
        $this->id = $gebruikerid;
    }
    
    function getGebruikernaam($gebruikerid){
        // $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");
        $mysqli = new mysqli("localhost", "root", "", "socialenetwerksite");
        
        if($mysqli->connect_error){
            die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }
        
        if($query = $mysqli->query("SELECT * FROM Gebruikers WHERE gebruikerid = '$gebruikerid'")){
            if($query ->num_rows > 0){
                $gebruikernaam = $query->fetch_object();
                return $gebruikernaam->gebruikernaam;
            }
        }
        $mysqli->close();
    }
    
    function getBerichten(){
        // $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");
        $mysqli = new mysqli("localhost", "root", "", "socialenetwerksite");
        
        if($mysqli->connect_error){
            die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }
        
        $array = array();
        if($query = $mysqli->query("SELECT * FROM Berichten ORDER BY berichtid DESC")){
            if($query ->num_rows > 0){
                while($row = mysqli_fetch_array($query)){
                    $gebruikernaam = $this->getGebruikernaam($row['gebruikerid']);
                    //$datum = date("d-m-y", strtotime($row['datum']));
                    $result = '<p class="berichten">door ' . $gebruikernaam . ' op ' 
                            . $row['datum'] . '<br>' . $row['inhoud'] . '</p>';
                    array_push($array, $result);
                }
            }
        }
        $mysqli->close();
        return $array;
    }
    
    function getAantalBerichten(){
        // $mysqli = new mysqli("dt5.ehb.be", "BDEV018", "79463521", "BDEV018");
        $mysqli = new mysqli("localhost", "root", "", "socialenetwerksite");
        
        if($mysqli->connect_error){
            die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }
        
        if($query = $mysqli->query("SELECT * FROM Berichten")){
            if($query ->num_rows > 0){
                $aantal = $query->num_rows;
                return $aantal;
            }
        }
        $mysqli->close();
        
    }
    
}
