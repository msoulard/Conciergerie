<?php
    $server = "http://e-srv-lamp";
    $user="e2103704";
    $pwd="Ybb239ay";
    $db="e2103704";
    $Connect = mysqli_connect($server, $user, $pwd, $db); 
    if(!$Connect){
		echo "Connexion à la base de données impossible";
    }
	else{
		echo "Connexion à la base de données réussie";
	}
?>