<?php
	//démarrage de la session 
	require_once("PanierAchat.php");

	session_start();
	if(isset($_SESSION["panier"]))
	{
		//obtenir le panier existant
		$panier = $_SESSION["panier"];
	}
?>
<html>
<body>
<h1>Affichage du panier</h1>
<?php
	
	//Cette section n'est pas aussi élégante que l'on voudrait. 
	//En effet, il faut tout d'abord appeler getProduits pour obtenir 
	//le tableau de produits et ensuite utiliser ce tableau dans la boucle. 
	//On voudrait plutôt traiter directement le panier comme un tableau! 
	//On implémentera donc Iterator, Countable et ArrayAccess pour cette raison! 
	//si le panier existe dans la session
	if(isset($panier))
	{
		//obtenir tous les produits dans le panier
		$tabProduits = $panier->getProduits();

		//s'il y a plus que zéro produit dans le panier
		if(count($tabProduits) > 0)
		{
			//affichage des produits dans le panier, avec lien vers TraitePanier pour enlever ou ajouter.
			echo "<ul>";
			foreach($tabProduits as $p)
			{
				echo "<li>";
				echo $p['produit']->getNom();
				echo " Prix : " . $p['produit']->getPrix() ;
				echo " Quantité : " . $p['qt'] ;
				echo " <a href='TraitePanier.php?cmd=enlever&idProduit=" .$p['produit']->getId() . "'>-</a>";
				echo " <a href='TraitePanier.php?cmd=ajout&idProduit=" . $p['produit']->getId() . "'>+</a>";
				echo "</li>";
			}
			echo "</ul>";
		}
		else
			echo "<li>Le panier est vide.</li>";
	}
	else
		echo "<li>Le panier est vide.</li>";

	echo "<h1>Avec Countable et ArrayAccess</h1>";
	echo "Votre test va ici...";
	//boucle for, utilisation de count
	
	//Tester le nouveau panier ici!
	echo "<h1>Avec Iterator</h1>";
	echo "Votre test va ici...";


	//foreach...


	
?>
<br>
<a href="AfficheProduits.php">Afficher la liste des produits</a>
</body>
</html>