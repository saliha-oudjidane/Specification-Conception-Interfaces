<?php
 $userid=0;
if (!isset($_GET['userid'])) {
    header('Location: index.php');
    
}
$userid=$_GET['userid'];
require_once("Connection.php");
$connexion=new Connection();
$PDO=$connexion->getConnection();
try{
    $stmt = $PDO->query('SELECT * FROM user where id="'.$userid.'"');
    $row = $stmt->fetch();
}
catch(Exception $e)
{
    exit('<b>Catched exception at line '. $e->getLine() .' (code : '. $e->getCode() .') :</b> '. $e->getMessage());
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="jquery-3.3.1.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />    
</head>
<body>
<?php

 ?>

 
 <div id="divshowimage" style="text-align: center;">
    <h1  style="text-align: center; color: #5365d6; margin-top: 60px;">Perception de la profondeur en gestion de fenêtres </h1>
    <img src="img/clic-ici.jpg" id="showimage" style="padding-top: 120px;"/>
 </div>

<div id="aff_images" style="text-align: center;display: none;">
    <img id="image" src="img/img1.jpg" style="width:100%;height:100%">
    <div id="counter"></div>
</div>

<div id="sais_nb" style="display: none;text-align: center; margin-top: 280px">
    <span style="font-size: 18px; font-weight:  bold;">Nombre de couches : </span>
     <!--input id="nbcouche" name="nbcouche" value="5" style="padding: 5px;"/-->
    <select id="nbcouche" name="nbcouche" value="5" style="padding: 5px;" >
        <option> 0 </option>
        <option> 1 </option>
        <option> 2 </option>
        <option> 3 </option>
        <option> 4 </option>
        <option> 5 </option>
        <option> 6 </option>
        <option> 7 </option>
        <option> 8 </option>
        <option> 9 </option>
    </select>
    <input type="button" id="send" value="OK" style="padding: 5px;background: #568e43;color: #fff;border: 2px solid #568e43;">
    
</div>

<script>
    var initcounter=5; // temp d'affichage de l'image
    var varCounter = initcounter;
    var temprep = 0;
    var userid=<?php echo $userid ?>;
    var idimagetable=<?php echo $row[3] ?>+1;
    var maximage=36;
    var intervalId,temprepId;
    var imageliste=["aucun_2_5.jpg","aucun_2_9.jpg","aucun_2_11.jpg","aucun_3_5.jpg","aucun_3_9.jpg","aucun_3_11.jpg","aucun_5_5.jpg","aucun_5_9.jpg","aucun_5_11.jpg",
                    "flou_2_5.jpg","flou_2_9.jpg","flou_2_11.jpg","flou_3_5.jpg","flou_3_9.jpg","flou_3_11.jpg","flou_5_5.jpg","flou_5_9.jpg","flou_5_11.jpg",
                    "ombre_2_5.jpg","ombre_2_9.jpg","ombre_2_11.jpg","ombre_3_5.jpg","ombre_3_9.jpg","ombre_3_11.jpg","ombre_5_5.jpg","ombre_5_9.jpg","ombre_5_11.jpg",
                    "lum_2_5.jpg","lum_2_9.jpg","lum_2_11.jpg","lum_3_5.jpg","lum_3_9.jpg","lum_3_11.jpg","lum_5_5.jpg","lum_5_9.jpg","lum_5_11.jpg"]
    var imagelistecode=[9,4,12,30,11,21,31,7,27,22,1,19,5,24,17,32,2,13,29,10,3,0,35,8,15,26,3,20,18,34,23,6,14,33,16,28];// index de la liste des images
    $(document).ready(function () {
       $("#image").attr("src","images/"+imageliste[imagelistecode[idimagetable]]);
        $("#showimage").on('click',function () { 
            timeer();
            $("#divshowimage").hide();
            $("#image").attr("src","images/"+imageliste[imagelistecode[idimagetable]]);
            $("#nbcouche").val(0);
            $("#aff_images").show();
        });
        $("#send").on('click',function () {
            clearInterval(temprepId);
            
            $("#aff_images").hide();
            $("#sais_nb").hide();
            $("#divshowimage").show();
            $.ajax({
                url : 'ajax_save.php', // La ressource ciblée
                type : 'POST', // Le type de la requête HTTP.
                data:{
                    nombre: $("#nbcouche").val(), // Second add quotes on the value.
                    temp:temprep,
                    idimage:imageliste[imagelistecode[idimagetable]],
                    numtabimg:idimagetable,
                    userid:userid,
                    maximage:maximage
                },
            })
            .done(function( data ) {
                idimagetable=idimagetable+1;
                if (idimagetable<maximage) 
                {
                    $("#image").attr("src","images/"+imageliste[imagelistecode[idimagetable]]);
                }
                else
                    window.location.href ="bye.php";
                   
            
            });
        });

        $("#send2").on('click',function () {
            $("#aff_images").show();
            $("#sais_nb").hide();
            timeer();

        })
    });
    function timeer() {
        varCounter = initcounter;
        $("#counter").html(varCounter);
        intervalId = setInterval(decompte, 1000);

        };
    function decompte() {
        varCounter=varCounter-1;
        $("#counter").html(varCounter);
        if(varCounter==0) {
            $("#aff_images").hide();
            $("#sais_nb").show();
            clearInterval(intervalId);
            temprep=0;
            temprepId = setInterval(function(){temprep=temprep+1;}, 1000);
        }

    }

    function nouvelleimage()
    {
        timeer();
    }



</script>
</body>
</html>
