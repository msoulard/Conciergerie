<!DOCTYPE html>
<?php
	$db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
	if(isset($_GET['numeroClient']) AND !empty($_GET['numeroClient'])){
		$numero =$_GET['numeroClient'];
		$recupDonnees=$db->prepare("SELECT nomClient, prenomClient, anniversaireClient, adresseClient,
			telClient, mailClient, fbClient, instaClient, nbPointsTotalClient FROM client WHERE numeroClient=?;");
		$recupDonnees->execute(array($numero));
		if($recupDonnees->rowCount()>0){
			$clientInfos=$recupDonnees->fetch();
			$nom=$clientInfos['nomClient'];
			$prenom=$clientInfos['prenomClient'];			
			$anniversaire=$clientInfos['anniversaireClient'];
			$adresse=$clientInfos['adresseClient'];
			$tel=$clientInfos['telClient'];
			$mail=$clientInfos['mailClient'];
			$fb=$clientInfos['fbClient'];
			$insta=$clientInfos['instaClient'];
			$nbPointsTotal=$clientInfos['nbPointsTotalClient'];
			
			$recupDonnees=$db->prepare("SELECT niveauFidelite FROM programmefidelite join client using(idProgrammeFidelite) WHERE numeroClient=:numero;");
			$recupDonnees->bindValue(':numero', $numero);
			$recupDonnees->execute();
			$clientInfos=$recupDonnees->fetch();
			$fidelite=$clientInfos['niveauFidelite'];
		}
		else{
			echo 'Aucun client trouvé';
		}
    }
	else{
		echo 'Aucun numéro de client trouvé';
	}
?>

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
		<h1 align=center>Fiche client</h1>
		<a>N° client : <? =$numero?></a>
		<br>
		<a>Nom : <? =$nom?></a>
		<br>
		<a>Prénom : <? =$prenom?></a>
		<br>
		<a>Anniversaire : <? =$anniversaire?></a>
		<br>
		<a>Adresse : <? =$adresse?></a>
		<br>
		<a>Facebook : <? =$fb?></a>
		<br>
		<a>Instagram : <? =$insta?></a>
		<br>
		<a>E-mail : <? =$mail?></a>
		<br>
		<a>Téléphone : <? =$tel?></a>
		<br>
		<br>
		<a>Programme de fidélité : <? =$fidelite?> avec <? =$nbPointsTotal?> points</a>
		<ul>
			<?                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteListe=$db->prepare("select  nbPoints, dateExpirationPoints from points join client using(idClient) where numeroClient=:numero; ");
          $requeteListe->bindValue(':numero', $numero);
		  $requeteListe->execute();
            while($row=$requeteListe->fetch()){
                ?>
				<li><?php echo $row['nbPoints']?> points expirent le <?php echo $row['dateExpirationPoints']?></li>
		</ul>
		<? }?>
		<br>
		<br>
		<a>Les commandes : </a>
		<ul>
			<?                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteListe=$db->prepare("select numeroCommande, pointsCommande from commande join commandepasseepar using(idCommande) join client using(idClient) where numeroClient=:numero;");
          $requeteListe->bindValue(':numero', $numero);
		  $requeteListe->execute();
            while($row=$requeteListe->fetch()){
                ?>
				<li><?php echo $row['numeroCommande']?> : <?php echo $row['pointsCommande']?> points</li>
		</ul>
		<? }?>
		<br>
		<button onclick="window.location.href='creationCommande.php?numeroClient=<?=$row['numeroClient'];?>'">Créer une commande</button>
		<button onclick="window.location.href='modificationClient.php?numeroClient=<?=$row['numeroClient'];?>'">Modifier</button>
		<button onclick="<?php
				$db = new PDO('mysql:host=localhost;dbname=conciergerie','root','');
				$requeteSup=$db->prepare('delete from client where numeroClient=:numero;');
				$numero = $row['numeroClient'];
				$requeteSup->bindValue(':numero', $numero);
				$requeteSup->execute();
				?>">
			Supprimer
		</button>
    </body>
</html>