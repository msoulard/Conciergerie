<?php
    $server = "127.0.0.1";
    $user="";
    $pwd="";
    $db="conciergerie";
    $Connect = mysqli_connect($server, $user, $pwd, $db); 
    if(!$Connect){
		echo "Connexion à la base de données impossible";
    }
	else{
		echo "Connexion à la base de données réussie";
	}
?>