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
	<h1 align=center>Liste des commandes</h1>
	<table border=2 align=center>
		<tr>
			<th>N° commandes</th>
			<th>N° client</th>
			<th>Order date</th>
			<th>Prix total</th>
			<th>To deposite</th>
			<th>Order status</th>
			<th>Notes</th>
			<th>Actions</th>
		</tr>
		<tr>
		<?php                
          $db = new PDO("mysql:host=localhost;dbname=conciergerie","root","");
          $requeteTableau=$db->prepare("select numeroCommande, numeroClient, dateCreationCommande,
		  prixTotalCommande, statutCommande, notesCommande, toDepositeCommande 
		  from commande join commandepasseepar using(idCommande) join client using(idClient); ");
          $requeteTableau->execute();
            while($row=$requeteTableau->fetch()){
                ?>
			<td><?php echo $row['numeroCommande']?></td>
			<td><?php echo $row['numeroClient']?></td>
			<td><?php echo $row['dateCreationCommande']?></td>
			<td><?php echo $row['prixTotalCommande']?></td>
			<td><?php echo $row['toDepositeCommande']?></td>
			<td><?php echo $row['statutCommande']?></td>
			<td><?php echo $row['notesCommande']?></td>
			<td>
				<button onclick="window.location.href='ficheCommande.php?numeroCommande=<?=$row['numeroCommande'];?>">Détails</button>
				<button onclick=<?php
										$requeteSup=$db->prepare("delete from commande where numeroCommande=:numero;");
										$numero = $row['numeroCommande'];
										$requeteSup->bindValue(':numero', $numero);
										$requeteSup->execute();
								?>>Supprimer</button>
			</td>
		</tr>
	</table>
	<div align=center>
		<button onclick="ouvrirCreationCommande()">Créer une commande</button>
	</div>
    </body>
</html>