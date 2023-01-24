<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Conciergerie</title>
		<script src="changerPage.js" type="text/javascript"></script>
    </head>
	<header>
		<h1 align=center>Conciergerie</h1>
		<div align=center>
		<button onclick="ouvrirListeDesClients()">Liste des clients</button>
		<button onclick="ouvrirListeDesCommandes()">Liste des commandes</button>
		<button onclick="ouvrirListeDesArticles()">Liste des articles</button>
		<button onclick="ouvrirListeDesConcierges()">Liste des concierges</button>
		</div>
	</header>
    <body>
		<h1 align=center>Création d'un client</h1>
		<form method="post">
		<label>N° client : </label>
		<input name="numero" id="numero">
		<br><br>
		<label>Nom : </label>
		<input name="nom" id="nom">
		<br><br>
		<label>Prénom : </label>
		<input name="prenom" id="prenom">
		<br><br>
		<label>Anniversaire : </label>
		<input name="anniversaire" id="anniversaire">
		<br><br>
		<label>Adresse : </label>
		<input name="adresse" id="adresse">
		<br><br>
		<label>Téléphone : </label>
		<input name="tel" id="tel">
		<br><br>
		<label>E-mail : </label>
		<input name="mail" id="mail">
		<br><br>
		<label>Facebook : </label>
		<input name="fb" id="fb">
		<br><br>
		<label>Instagram : </label>
		<input name="insta" id="insta">
		<br><br>
		<label>Points : </label>
		<input name="points" id="points">
		</form>
		<br>
		<br>
		<button onclick="<?php 
				$numero = $_POST['numero'];
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$anniversaire = $_POST['anniversaire'];
				$adresse = $_POST['adresse'];
				$tel = $_POST['tel'];
				$mail = $_POST['mail'];
				$fb = $_POST['fb'];
				$insta = $_POST['insta'];
				$points = $_POST['points'];				
				$db = new PDO('mysql:host=localhost;dbname=conciergerie','root','');
				if($points <= 300){
					$requetePFidelite=$db->prepare('select idProgrammeFidelite from programmefidelite where nbPointsMaxFidelite = 300;');
					$requetePFidelite->execute();
					$idFidelite = $requetePFidelite->fetch();
				}
				else if($points > 300 && $points <= 700){					
					$requetePFidelite=$db->prepare('select idProgrammeFidelite from programmefidelite where nbPointsMaxFidelite = 700;');
					$requetePFidelite->execute();
					$idFidelite = $requetePFidelite->fetch();
				}
				else{
					$requetePFidelite=$db->prepare('select idProgrammeFidelite from programmefidelite where nbPointsMinFidelite = 701;');
					$requetePFidelite->execute();
					$idFidelite = $requetePFidelite->fetch();
				}
				$requeteEnr=$db->prepare('insert into client (numeroClient, nomClient, prenomClient, anniversaireClient,
					adresseClient, telClient, mailClient, fbClient, instaClient, nbPointsTotalClient, idProgrammeFidelite,
					idEntreprise) values (:numero, :nom, :prenom, :anniversaire, :adresse, :tel, :mail, :fb, :insta, :points, ;id, 1);');
				$requeteEnr->bindValue(':numero', $numero);
				$requeteEnr->bindValue(':nom', $nom);
				$requeteEnr->bindValue(':prenom', $prenom);
				$requeteEnr->bindValue(':anniversaire', $anniversaire);
				$requeteEnr->bindValue(':adresse', $adresse);
				$requeteEnr->bindValue(':tel', $tel);
				$requeteEnr->bindValue(':mail', $mail);
				$requeteEnr->bindValue(':fb', $fb);
				$requeteEnr->bindValue(':insta', $insta);
				$requeteEnr->bindValue(':points', $points);
				$requeteEnr->bindValue(':id', $idFidelite);
				$requeteEnr->execute();?>">Enregistrer</button>
		<button onclick="ouvrirListeDesClients()">Annuler</button>
    </body>
</html>