<html>
<body>
<h1>Liste des produits</h1>
<ul>
<?php
	require_once("Produit.php");
	require_once("TableProduit.php");
	require_once("ConnexionDB.php");
	

	$produitDB = new TableProduit($db);
	$resultats = $produitDB->obtenir_tous();
	$inventaire = array();

	//hydratation
	foreach($resultats as $p)
	{
		$inventaire[] = new Produit($p["id"], $p["nom"], $p["prix"]);
	}
	
	//affichage des produits 
	foreach($inventaire as $produit)
	{
		echo "<li>" . $produit->getNom() . " Prix : " . $produit->getPrix() . " <a href='TraitePanier.php?cmd=ajout&idProduit=" . $produit->getId() . "'>Ajouter ce produit au panier</a></li>";
	}	

?>
</ul>
<a href="AffichePanier.php">Afficher le contenu du panier</a>
</body>
</html>