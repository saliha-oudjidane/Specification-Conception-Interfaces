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
require_once("Connection.php");
$connexion=new Connection();
 $PDO=$connexion->getConnection();
 try{
    $stmt = $PDO->query('SELECT * FROM user');
    $rows = $stmt->fetchAll();
}
catch(Exception $e)
{
    exit('<b>Catched exception at line '. $e->getLine() .' (code : '. $e->getCode() .') :</b> '. $e->getMessage());
}

?>
<a href="new_user.php">Ajouter</a>
<table>
<tr>
    <td>Nom</td>
    <td>Age</td>
    <td>Sexe</td>
    <td></td>
</tr>

<?php

foreach($rows as $row) {
    ?>
    <tr>
        <td><?= $row[1]?></td>
        <td><?= $row[4]?></td>
        <td><?= $row[5]?></td>
        <td>
            <?php 
                if ($row[2]==0) {
                    echo '<a href="image_test.php?userid='.$row[0].'">Continuer le teste</a>';
                }
                else
                    echo '<a href="user_stat.php?userid='.$row[0].'">Resultat</a>';
            ?>
        </td>
    </tr>
<?php
    
}
 ?>
 </table>

</body>
</html>
