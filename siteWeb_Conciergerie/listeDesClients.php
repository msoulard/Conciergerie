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
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select numeroClient, nomClient, prenomClient, nbPointsTotalClient, niveauFidelite from client join programmefidelite using(idProgrammeFidelite); ");
          $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['numeroClient']?></td>
			<td><?php echo $row['nomClient']?></td>
			<td><?php echo $row['prenomClient']?></td>
			<td><?php echo $row['niveauFidelite']
					  echo $row['nbPointsTotalClient']?></td>
			<td>
				<button onclick="window.location.href='ficheClient.php?numeroClient=<?=$row['numeroClient'];?>">Détails</button>
				<button onclick=<?php
										$requeteSup=$db->prepare("delete from client where numeroClient=:numero;");
										$numero = $row['numeroClient'];
										$requeteSup->bindValue(':numero', $numero);
										$requeteSup->execute();
								?>>
					Supprimer
				</button>
			</td>
		</tr>
			<?php }?>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationClient()">Ajouter un client</button>
	</div>
    </body>
</html>