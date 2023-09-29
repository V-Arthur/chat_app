<?php
// Arthur Vartanian     Herkansing      Art&Tech
$gebruikerid = filter_input(INPUT_COOKIE, "GebruikerId");

if(!isset($gebruikerid)){
    header("Location: login.php");
}

require_once("indexData.php");

$indexData = new IndexData();
$indexData->setId($gebruikerid);
$gebruikernaam = $indexData->getGebruikernaam($gebruikerid);

$berichten = $indexData->getBerichten();
foreach ($berichten as $bericht) {
    echo "$bericht";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Erasmus chat</title>
        <link href="css/erasmuschat.css" rel="stylesheet" type="text/css">
        <link href="css/index.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".berichten").appendTo("#berichten");
                
                $("#verzenden").click(function(e){
                    e.preventDefault();
                    
                    var bericht = $("#bericht").val();
                    
                    if(bericht !== ""){
                        $.ajax({
                            type: "POST",
                            url: "doindex.php",
                            data: {bericht: bericht, postcheck: true},
                            success: function(data){
                                if(data.status == 'success'){
                                    //$("#berichten").prepend("<p>" + bericht + "<p>");
                                    $("#berichten").prepend('<p class="berichten">' + data.message + '</p>');
                                }
                            }
                        });
                    }
                    $('#bericht').val('');
                    
                });
            });
        </script>
    </head>
    <body>
        <section id="wrapper">
            <header>
                <h1 id="paginaTitel">Erasmus chat</h1>
            </header>
            
            <div id="rechts">
                <div id="berichten"></div>

                <form action="doindex.php" method="post">
                    <textarea id="bericht" rows="10" cols="50" maxlength="500" name="bericht"></textarea> <br>
                    <input type="hidden" name="postcheck" value="true"/>
                    <input type="submit" id="verzenden" value="Post">
                </form>
            </div>
            
            <div id="links">
                <div id="gegevens">
                    <label id="profielfoto"><img src="<?php echo "toonProfielfoto.php?id=" . $gebruikerid ?>" 
                                alt="Profielfoto"/></label> <br>
                    <label id="gebruikernaam"><?php echo $gebruikernaam; ?></label> <br>
                    <a href="logout.php">Afmelden</a>
                </div>
            </div>
        </section>
    </body>
</html>
