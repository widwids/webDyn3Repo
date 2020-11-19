<?php
	require_once('TableBase.php');
	class TableProduit extends TableBase
	{
		public function getNomTable()
		{
			return "produit";
		}

		public function getClePrimaire()
		{
			return "id";
		}
	}
?>