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
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select numeroConcierge, nomConcierge, prenomConcierge, telConcierge,
				mailConcierge from concierge; ");
          $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['numeroConcierge']?></td>
			<td><?php echo $row['nomConcierge']?></td>
			<td><?php echo $row['prenomConcierge']?></td>
			<td><?php echo $row['telConcierge']?></td>
			<td><?php echo $row['mailConcierge']?></td>
			<td>
				<button onclick="window.location.href='ficheConcierge.php?numeroConcierge=<?=$row['numeroConcierge'];?>">Détails</button>
				<button onclick="<?php
										$requeteSup=$db->prepare('delete from concierge where numeroConcierge=:numero;');
										$numero = $row['numeroConcierge'];
										$requeteSup->bindValue(':numero', $numero);
										$requeteSup->execute();
								?>">Supprimer</button>
			</td>
		</tr>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationConcierge()">Ajouter un concierge</button>
	</div>
    </body>
</html>