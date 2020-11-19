<?php

require_once("Produit.php");
class PanierAchat
{
	protected $position;
	// Un tableau qui stocke tous les produits dans le panier 
	protected $produits = array();

	// Un tableau qui stocke les identifiants des produits dans le panier... sera utile pour les interfaces!
	protected $ids = array();

    // Le constructeur initialise les tableaux
    function __construct() {
		$this->produits = array();
		$this->ids = array();
    }

	// Ajoute un nouveau produit dans le panier 
	public function ajouteProduit(Produit $produit) {
	
		$id = $produit->getId();
	
		// ajoute dans le panier ou modifie la quantité si le produit existe déjà dans le panier :
		if (isset($this->produits[$id])) {
			$this->produits[$id]['qt']++;
		} else {
			// on ajoute dans le tableau produit une nouvelle rangée, qui est aussi un tableau, contenant le produit en question, ainsi que sa quantité (1 au départ)!
			// on le classe à la position appartenant à son id
			$this->produits[$id] = array('produit' => $produit, 'qt' => 1);
			$this->ids[] = $id; // on stocke l'id dans le tableau des identifiants
		}
	
	} 

	//Enlève un produit dans le panier
	public function enleveProduit(Produit $produit) {

		$id = $produit->getId();

		// On supprime ou on change la quantité. 
		if (isset($this->produits[$id]) && $this->produits[$id]['qt'] == 1) {
				//il reste seulement un item de ce produit dans le panier, on l'enlève et on enlève le produit dans le panier
				unset($this->produits[$id]);
		
				//on enlève aussi la case du tableau qui contient cet id
				$index = array_search($id, $this->ids);
				unset($this->ids[$index]);

				//recréer le tableau pour éviter d'avoir un tableau troué Ex: on enlève le produit 2 et on se retrouve avec un tableau du genre [0 => id1, 1 => id24, 3 => id29]... il est préférable de recréer le tableau pour avoir [0 => id1, 1 => id24, 2 => id29]
				$this->ids = array_values($this->ids);
		
		}	
		else  
			$this->produits[$id]['qt']--;
		
	} 


	//fonction qui retourne le tableau de produit... elle est là temporairement pour que ça fonctionne, mais lorsque vous aurez implémenté Iterator et ArrayAccess, vous n'en n'aurez plus besoin!
	public function getProduits()
	{
		return $this->produits;
	}

	
} 