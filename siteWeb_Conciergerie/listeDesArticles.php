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
        <?php include('accesBdd.php');?>
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
			<td><?php obtenirReferenceArticle();?></td>
			<td><?php obtenirDescriptionArticle();?></td>
			<td><?php obtenirPrixAchatArticle();?></td>
			<td><?php obtenirPrixVenteArticle();?></td>
			<td><?php obtenirFournisseurArticle();?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td>
				<button onclick="ouvrirFicheArticle()">Détails</button>
				<button>Supprimer</button>
			</td>
		</tr>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationArticle()">Ajouter un article</button>
	</div>
    </body>
</html>