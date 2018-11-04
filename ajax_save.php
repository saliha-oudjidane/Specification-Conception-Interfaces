<?php
require_once("Connection.php");
$nombre=$_POST["nombre"];
$temp=$_POST["temp"];
$idimage=$_POST["idimage"];
$userid=$_POST["userid"];
$maximage=$_POST["maximage"];
$numtabimg=$_POST["numtabimg"];


 $connexion=new Connection();
 $PDO=$connexion->getConnection();
 $sql="INSERT INTO testresult (userid,combinaison, reponse, temps) VALUES ('".$userid."','".$idimage."','".$nombre."','". $temp."')";

 if($PDO->query($sql))
 	echo"ok";
 else
 	echo"non";
 if ($numtabimg<$maximage-1) {
	$etat=0;
}else
$etat=1;
$dd=new Connection();
$cc=$dd->getConnection();
   $sql="update `user` set `etat`='".$etat."', `imagenumero`= imagenumero+1 where id='".$userid."'";
    $stmt= $cc->prepare($sql);
    $sonuc = $stmt->execute();