<?php
    function obtenirNumeroClient(){
		include('connexionBdd.php');
		$Query = "select numeroClient from client;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirNomClient(){
		include('connexionBdd.php');
		$Query = "select nomClient from client;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirPrenomClient(){
		include('connexionBdd.php');
		$Query = "select prenomClient from client;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirFideliteClient(){
		include('connexionBdd.php');
		$Query = "select nbPointsTotalClient, niveauFidelite from client join programmefidelite using(idprogrammefidelite);";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirReferenceArticle(){
		include('connexionBdd.php');
		$Query = "select referenceArticle from article;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirDescriptionArticle(){
		include('connexionBdd.php');
		$Query = "select descriptionArticle from article;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirPrixAchatArticle(){
		include('connexionBdd.php');
		$Query = "select prixAchatArticle from article;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirPrixVenteArticle(){
		include('connexionBdd.php');
		$Query = "select prixVenteArticle from article;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
	
	function obtenirFournisseurArticle(){
		include('connexionBdd.php');
		$Query = "select fournisseurArticle from article;";
		$Result = $Connect->query($Query);
		while($Data = mysqli_fetch_array($Result)){
            echo utf8_decode($Data[0]);
		}
		mysqli_close ($Connect);
    }
?>