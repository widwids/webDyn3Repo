<?php
    //connexion à la BD
	try
	{
		//pour l'encodage utf8
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		);
		
		//connexion à la base de données
		$db = new PDO("mysql:host=localhost;dbname=inventaire", "root", "root", $options);
		
		//forcer PDO à générer des exceptions pour les requêtes SQL
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		trigger_error("Erreur de la connexion : " . $e->getMessage());
	}
?>