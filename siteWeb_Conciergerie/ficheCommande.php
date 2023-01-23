<!DOCTYPE html>
<?php
	$db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
	if(isset($_GET['numeroCommande']) AND !empty($_GET['numeroCommande'])){
		$numeroCommande =$_GET['numeroCommande'];
		$recupDonnees=$db->prepare("SELECT dateCreationCommande, prixTotalCommande, pointsCommande, statutCommande,
dateExpeditionCommande, dateArriveeCommande, notesCommande, fraisServiceCommande, fraisLivraisonCommande, promotionCommande,
toDepositeCommande, toPayCommande FROM commande WHERE numeroCommande=?;");
		$recupDonnees->execute(array($numeroCommande));
		if($recupDonnees->rowCount()>0){
			$commandeInfos=$recupDonnees->fetch();
			$dateCreation=$commandeInfos['dateCreationCommande'];
			$prixTotal=$commandeInfos['prixTotalCommande'];
			$points=$commandeInfos['pointsCommande'];
			$statut=$commandeInfos['statutCommande'];
			$dateExpedition=$commandeInfos['dateExpeditionCommande'];
			$dateArrivee=$commandeInfos['dateArriveeCommande'];
			$notes=$commandeInfos['notesCommande'];
			$fraisService=$commandeInfos['fraisServiceCommande'];
			$fraisLivraison=$commandeInfos['fraisLivraisonCommande'];
			$promotion=$commandeInfos['promotionCommande'];
			$toDeposite=$commandeInfos['toDepositeCommande'];
			$toPay=$commandeInfos['toPayCommande'];
		}
		else{
			echo 'Aucune commande trouvée';
		}
		$recupDonnees=$db->prepare("select numeroConcierge from concierge join commandePasseePar using(idConcierge) join commande using (idCommande) where numeroCommande=:numeroCommande;");
		$recupDonnees->bindValue(':numeroCommande', $numeroCommande);
		$recupDonnees->execute();
		if($recupDonnees->rowCount()>0){
			$commandeInfos=$recupDonnees->fetch();
			$numeroConcierge = $commandeInfos['numeroCommande'];
		}
		else{
			echo 'aucun concierge trouvé';
		}
		$recupDonnees=$db->prepare("select numeroClient from client join commandePasseePar using(idClient) join commande using (idCommande) where numeroCommande=:numeroCommande;");
		$recupDonnees->bindValue(':numeroCommande', $numeroCommande);
		$recupDonnees->execute();
		if($recupDonnees->rowCount()>0){
			$commandeInfos=$recupDonnees->fetch();
			$numeroClient = $commandeInfos['numeroClient'];
		}
		else{
			echo 'aucun client trouvé';
		}
    }
	else{
		echo "Aucun numéro de commande trouvé";
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
		<h1 align=center>Fiche commande</h1>
		<a>N° commande : <? =$numeroCommande?></a>
		<br>
		<a>N° client : <? =$numeroClient?></a>
		<br>
		<a>N° concierge : <? =$numeroConcierge?></a>
		<br>
		<a>Date de création : <? =$dateCreation?></a>
		<br>
		<a>Dates de modification : </a>
		<table border=2 align=center>
		<tr>
			<th>Date</th>
			<th>N° concierge</th>
		</tr>
		<tr>
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select dateModification, numeroConcierge from concierge join commandeModifieePar using(idConciergeModifie) join commande using(idCommande)  where numeroCommande=:numeroCommande; ");
          $requeteTableau->bindValue(':numeroCommande', $numeroCommande);
		  $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['dateModification']?></td>
			<td><?php echo $row['numeroConcierge']?></td>
		</tr>
			<?php }?>
	</table>
		<br>
		<a>Date d'expédition : <? =$dateExpedition?></a>
		<br>
		<a>Date d'arrivée : <? =$dateArrivee?></a>
		<br>
		<a>Prix total : <? =$prixTotal?></a>
		<br>
		<a>Montant payé : <? =$toDeposite?></a>
		<br>
		<a>Reste à payer : <? =$toPay?></a>
		<br>
		<a>Points : <? =$points?></a>
		<br>
		<a>Frais de livraison : <? =$fraisLivraison?></a>
		<br>
		<a>Frais de service : <? =$fraisService?></a>
		<br>
		<a>Notes : <? =$notes?></a>
		<br>
		<br>
		<a>Paiement : </a>
		<table border=2 align=center>
		<tr>
			<th>Mode de paiement</th>
			<th>Montant</th>
			<th>Date</th>
		</tr>
		<tr>
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select typeModePaiement, datePaiement, montantPour from modepaiement join paiement using(idModePaiement) join paiementPour using(idPaiement) join commande using(idCommande) where numeroCommande=:numeroCommande; ");
          $requeteTableau->bindValue(':numeroCommande', $numeroCommande);
		  $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['typeModePaiement']?></td>
			<td><?php echo $row['datePaiement']?></td>
			<td><?php echo $row['montantPour']?></td>
		</tr>
			<?php }?>
	</table>	
		<br>
		<br>
		<a>Les articles : </a>
		<table border=2 align=center>
		<tr>
			<th>Quantité</th>
			<th>Description</th>
			<th>Prix</th>
		</tr>
		<tr>
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select descriptionArticle, quantiteArticleAjouteDans, prixTotalArticleAjouteDans from article join articleajoutedans using(idArticle) join commande using(idCommande) where numeroCommande=:numeroCommande; ");
          $requeteTableau->bindValue(':numeroCommande', $numeroCommande);
		  $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['quantiteArticleAjouteDans']?></td>
			<td><?php echo $row['descriptionArticle']?></td>
			<td><?php echo $row['prixTotalArticleAjouteDans']?></td>
		</tr>
			<?php }?>
	</table>
	</table>	
		<br>
		<br>
		<a>Les factures : </a>
		<table border=2 align=center>
		<tr>
			<th>N° facture</th>
			<th>Date</th>
		</tr>
		<tr>
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select numeroFacture, dateFacture from facture join commande using(idCommande) where numeroCommande=:numeroCommande; ");
          $requeteTableau->bindValue(':numeroCommande', $numeroCommande);
		  $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['numeroFacture']?></td>
			<td><?php echo $row['dateFacture']?></td>
		</tr>
			<?php }?>
	</table>
		<br>
		<br>
		<button>Editer la facture</button>
		<button onclick="window.location.href='modificationCommande.php?numeroCommande=<?=$row['numeroCommande'];?>'">Modifier</button>
		<button onclick=<?php
				$requeteSup=$db->prepare("delete from commande where numeroCommande=:numeroCommande;");
				$requeteSup->bindValue(':numeroCommande', $numeroCommande);
				$requeteSup->execute();
				?>>
			Supprimer
		</button>
    </body>
</html>