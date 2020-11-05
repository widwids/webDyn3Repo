<?php
    require_once("TableBase.php");
    class TableArticle extends TableBase
    {
        public function getNomTable()
        {
            return "article";
        }

        public function getClePrimaire()
        {
            return "id";
        }

        //création (CREATE)
        public function insere($titre, $texte, $idAuteur)
        {
            $requete = "INSERT INTO article(titre, texte, idAuteur) VALUES (:ti, :te, :idA)";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":ti", $titre);
            $requetePreparee->bindParam(":te", $texte);
            $requetePreparee->bindParam(":idA", $idAuteur);
            $requetePreparee->execute();

            //on retourne l'identifiant de la dernière insertion
            return $this->db->lastInsertId();

        }
       
        //mise à jour (UPDATE)
        public function modifie($id, $titre, $texte, $idAuteur)
        {
            $requete = "UPDATE article SET titre = :ti, texte = :te, idAuteur = :idA WHERE id = :id";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":ti", $titre);
            $requetePreparee->bindParam(":te", $texte);
            $requetePreparee->bindParam(":idA", $idAuteur);
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