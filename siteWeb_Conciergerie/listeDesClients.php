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
	<h1 align=center>Liste des clients</h1>
	<table border=2 align=center>
		<tr>
			<th>Numéro</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Fidélité</th>
			<th>Actions</th>
		</tr>
		<tr>
			<td><?php obtenirNumeroClient();?></td>
			<td><?php obtenirNomClient();?></td>
			<td><?php obtenirPrenomClient();?></td>
			<td><?php obtenirFideliteClient();?></td>
			<td>
				<button onclick="ouvrirFicheClient()">Détails</button>
				<button>Supprimer</button>
			</td>
		</tr>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationClient()">Ajouter un client</button>
	</div>
    </body>
</html>