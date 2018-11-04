<?php
require_once("Connection.php");
$connexion=new Connection();
$PDO=$connexion->getConnection();
if (isset($_POST['ajouter'])) {
   $nom= $_POST['nom'];
   $age= $_POST['age'];
   $sexe= $_POST['sexe'];
   $nombreimage=0;
   $etat=0;
   $sql="INSERT INTO `user` ( `nom`, `etat`, `imagenumero`, `age`, `sexe`) VALUES ( '".$nom."', '0', '-1', '".$age."', '".$sexe."')";
    $stmt= $PDO->prepare($sql);
    $sonuc = $stmt->execute();
    $LAST_ID = $PDO->lastInsertId();
   header('Location: image_test.php?userid='.$LAST_ID);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="jquery-3.3.1.min.js"></script>
</head>
<body>

 <div id="divshowimage" style="text-align: center;">
    Creation d'un nouveau profil
 </div>

<div id="aff_images" >
    <form method="post" action="new_user.php">
        <div><label>Nom, prenom</label><input name="nom"></div>
        <div><label>Age</label><input name="age"></div>
        <div>Sexe<label>M</label><input type="radio" name="sexe" value="M"  /> <label>F</label><input type="radio" name="sexe" value="F" /></div>
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</div>

</body>
</html>
