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
	<h1 align=center>Liste des articles</h1>
	<table border=2 align=center>
		<tr>
			<th>Référence</th>
			<th>Description</th>
			<th>Prix d'achat</th>
			<th>Prix de vente</th>
			<th>Fournisseur</th>
			<th>Lieux de stockage</th>
			<th>Quantité disponible</th>
			<th>Item status</th>
			<th>Actions</th>
		</tr>
		<tr>
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select referenceArticle, descriptionArticle, prixAchatArticle, prixVenteArticle, fournisseurArticle, lieuStock, quantiteStock, statutStock from article join stock using(idArticle); ");
          $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['referenceArticle']?></td>
			<td><?php echo $row['descriptionArticle']?></td>
			<td><?php echo $row['prixAchatArticle']?></td>
			<td><?php echo $row['prixVenteArticle']?></td>
			<td><?php echo $row['fournisseurArticle']?></td>
			<td><?php echo $row['lieuStock']?></td>
			<td><?php echo $row['quantiteStock']?></td>
			<td><?php echo $row['statutStock']?></td>
			<td>
				<button onclick="window.location.href='ficheArticle.php?referenceArticle=<?=$row['referenceArticle'];?>">Détails</button>
				<button onclick=<?php
										$requeteSup=$db->prepare("delete from article where referenceArticle=:reference;");
										$reference = $row['referenceArticle'];
										$requeteSup->bindValue(':reference', $reference);
										$requeteSup->execute();
								?>>>Supprimer</button>
			</td>
		</tr>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationArticle()">Ajouter un article</button>
	</div>
    </body>
</html>