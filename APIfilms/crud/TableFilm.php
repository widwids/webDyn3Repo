<?php
    require_once("TableBase.php");
    class TableFilm extends TableBase
    {
        public function getNomTable()
        {
            return "film";
        }

        public function getClePrimaire()
        {
            return "id";
        }

        //création (CREATE)
        public function insere($titre, $idRealisateur, $genre, $duree, $annee)
        {
            $requete = "INSERT INTO film(titre, idRealisateur, genre, duree, annee) VALUES (:t, :idR, :g, :d, :a)";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":t", $titre);
            $requetePreparee->bindParam(":idR", $idRealisateur);
            $requetePreparee->bindParam(":g", $genre);
            $requetePreparee->bindParam(":d", $duree);
            $requetePreparee->bindParam(":a", $annee);
            $requetePreparee->execute();

            //on retourne l'identifiant de la dernière insertion
            return $this->db->lastInsertId();

        }
       
        //mise à jour (UPDATE)
        public function modifie($id, $titre, $idRealisateur, $genre, $duree, $annee)
        {
            $requete = "UPDATE film SET titre = :t, idRealisateur = :idR, genre = :g, duree = :d, annee = :a WHERE id = :id";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":t", $titre);
            $requetePreparee->bindParam(":idR", $idRealisateur);
            $requetePreparee->bindParam(":g", $genre);
            $requetePreparee->bindParam(":d", $duree);
            $requetePreparee->bindParam(":a", $annee);
            $requetePreparee->bindParam(":id", $id);
            $requetePreparee->execute();

            //on retourne l'identifiant de la dernière insertion
            if($requetePreparee->rowCount() > 0)
                return $this->db->lastInsertId();
            else
                return false;
        }
        
    }

?>