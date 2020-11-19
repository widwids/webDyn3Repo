<?php
	require_once("ConnexionDB.php");
	require_once("TableProduit.php");
	require_once("Produit.php");
	require_once("PanierAchat.php");

	//démarrage de la session 
	session_start();
	
	if(isset($_SESSION["panier"]))
	{
		//obtenir le panier existant
		$panier = $_SESSION["panier"];
	}
	else
	{
		//le panier n'a pas été créé
		$panier = new PanierAchat();
		$_SESSION["panier"] = $panier;	
	}
	
	if(isset($_GET["cmd"]))
	{
		switch($_GET["cmd"])
		{
			case "ajout":
				//ajouter le produit au panier
				if(isset($_GET["idProduit"]))
				{
					//obtenir le produit de la BD et le mettre dans le panier
					$produitDB = new TableProduit($db);
					$resultat = $produitDB->obtenir_par_id($_GET["idProduit"]);
					$produit = new Produit($resultat["id"], $resultat["nom"], $resultat["prix"]);
					$panier->ajouteProduit($produit);
				}
								
				//redirection vers AffichePanier.php
				header("Location: AffichePanier.php");
				break;
			case "enlever":
				//enlever le produit du panier
				if(isset($_GET["idProduit"]))
				{
					$produitDB = new TableProduit($db);
					$resultat = $produitDB->obtenir_par_id($_GET["idProduit"]);
					$produit = new Produit($resultat["id"], $resultat["nom"], $resultat["prix"]);
					$panier->enleveProduit($produit);
				}
				header("Location: AffichePanier.php");
				break;
			default:
				header("Location: AffichePanier.php");
		}	
	}	
?>