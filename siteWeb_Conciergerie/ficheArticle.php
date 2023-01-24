<!DOCTYPE html>
<?php
	$db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
	if(isset($_GET['referenceArticle']) AND !empty($_GET['referenceArticle'])){
		$reference =$_GET['referenceArticle'];
		$recupDonnees=$db->prepare("SELECT referenceArticle, descriptionArticle, prixAchatArticle, prixVenteArticle,
			fournisseurArticle FROM article WHERE referenceArticle=?;");
		$recupDonnees->execute(array($reference));
		if($recupDonnees->rowCount()>0){
			$articleInfos=$recupDonnees->fetch();
			$reference=$articleInfos['referenceArticle'];
			$description=$articleInfos['descriptionArticle'];
			$prixAchat=$articleInfos['prixAchatArticle'];
			$prixVente=$articleInfos['prixVenteArticle'];
			$fournisseur=$articleInfos['fournisseurArticle'];
		}
		else{
			echo 'Aucun article trouvé';
		}
    }
	else{
		echo "Aucune référence d'article trouvée";
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
		<h1 align=center>Fiche article</h1>
		<a>Référence : <? =$reference?></a>
		<br>
		<a>Description : <? =$description?></a>
		<br>
		<a>Prix d'achat : <? =$prixAchat?></a>
		<br>
		<a>Prix de vente : <? =$prixVente?></a>
		<br>
		<a>Fournisseur : <? =$fournisseur?></a>
		<br>
		<br>
		<a>Stock : </a>
		<table border=2 align=center>
		<tr>
			<th>Quantité</th>
			<th>Lieu</th>
			<th>Statut</th>
		</tr>
		<tr>
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select quantiteStock, lieuStock, statutStock from stock join article using(idArticle) where referenceArticle=:reference; ");
          $requeteTableau->bindValue(':reference', $reference);
		  $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['quantiteStock']?></td>
			<td><?php echo $row['lieuStock']?></td>
			<td><?php echo $row['statutStock']?></td>
		</tr>
			<?php }?>
	</table>
		<br>
		<br>
		<button onclick="window.location.href=modificationArticle.php?reference=<?=$row['referenceArticle'];?>">Modifier</button>
		<button onclick="<?php
				$db = new PDO('mysql:host=localhost;dbname=conciergerie','root','');
				$requeteSup=$db->prepare('delete from article where referenceArticle=:reference;');
				$requeteSup->bindValue(':reference', $reference);
				$requeteSup->execute();
				?>">
			Supprimer
		</button>
    </body>
</html>