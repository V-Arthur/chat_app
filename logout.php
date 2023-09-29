<?php
// Arthur Vartanian     Herkansing      Art&Tech
setcookie("GebruikerId", "", time()-1);
header('Location: login.php');
?>