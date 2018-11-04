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

$PDO=$connexion->getConnection();
try{
    $stmt = $PDO->query('SELECT * FROM testresult where userid="'.$userid.'"');
    $results = $stmt->fetchAll();
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
</head>
<body>

 <div  style="text-align: center;">
    informations utilisateur
 </div>
 <div  >
    <label>Nom : </label><?= $row[1];?>
 </div>
 <div  >
    <label>Age : </label><?= $row[4];?>
 </div> 
 <div  >
    <label>Civilite : </label><?= $row[5];?>
 </div>

<table border=1>
    <tr>
        <td>nom image</td>
        <td>nombre de couches</td>
        <td>temps de reponse</td>
    </tr>
    <?php
        foreach ($results as $reponse) {
           echo "<tr><td>".$reponse[2]."</td>
                   <td>".$reponse[3]."</td>
                   <td>".$reponse[4]."</td></tr>";
            # code...
        }
    ?>
</table>

</body>
</html>
