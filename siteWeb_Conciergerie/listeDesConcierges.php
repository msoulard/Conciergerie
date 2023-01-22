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
	<h1 align=center>Liste des concierges</h1>
	<table border=2 align=center>
		<tr>
			<th>Numéro</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Téléphone</th>
			<th>E-mail</th>
			<th>Actions</th>
		</tr>
		<tr>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td>
				<button onclick="ouvrirFicheConcierge()">Détails</button>
				<button>Supprimer</button>
			</td>
		</tr>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationConcierge()">Ajouter un concierge</button>
	</div>
    </body>
</html>