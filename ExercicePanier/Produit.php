<?php
	class Produit
	{
		private $id;
		private $nom;
		private $prix;
		
		public function __construct($id = 0, $nom = "", $prix = "")
		{
			if(!isset($this->id))
			{
				$this->setNom($nom);
				$this->setPrix($prix);
				$this->setId($id);
			}				
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function getNom()
		{
			return $this->nom;
		}
		
		public function getPrix()
		{
			return $this->prix;
		}
		
		public function setId($id)
		{
			$this->id = $id;
		}
		
		public function setNom($nom)
		{
			$this->nom = $nom;
		}
		
		public function setPrix($prix)
		{
			$this->prix = $prix;
		}
		
		public function affiche()
		{
			echo "<h1>Description d'un produit</h1>";
			echo "<ul>";
			echo "<li>Nom :" . $this->getNom() . "</li>";
			echo "<li>Prix :" . $this->getPrix() . "</li>";
			echo "</ul>";
		}
	}
?>