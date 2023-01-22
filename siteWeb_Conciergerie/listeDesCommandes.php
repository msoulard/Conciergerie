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
	<h1 align=center>Liste des commandes</h1>
	<table border=2 align=center>
		<tr>
			<th>N° commandes</th>
			<th>N° client</th>
			<th>Order date</th>
			<th>Articles</th>
			<th>Paiement</th>
			<th>Prix total</th>
			<th>Order status</th>
			<th>Notes</th>
			<th>Actions</th>
		</tr>
		<tr>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td>
				<button onclick="ouvrirFicheCommande()">Détails</button>
				<button>Supprimer</button>
			</td>
		</tr>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationCommande()">Créer une commande</button>
	</div>
    </body>
</html>