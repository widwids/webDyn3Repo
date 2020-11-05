<?php
    require_once("TableBase.php");

    class TableRealisateur extends TableBase
    {
        public function getNomTable()
        {
            return "realisateur";
        }

        public function getClePrimaire()
        {
            return "id";
        }

        //création (CREATE)
        public function insere($id, $prenom, $nom)
        {
            $requete = "INSERT INTO realisateur(id, prenom, nom) VALUES (:i, :p, :n)";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":i", $id);
            $requetePreparee->bindParam(":p", $prenom);
            $requetePreparee->bindParam(":n", $nom);
            $requetePreparee->execute();

            //on retourne l'identifiant de la dernière insertion
            if($requetePreparee->rowCount() > 0)
                return $this->db->lastInsertId();
            else
                return false;

        }
        

        //mise à jour (UPDATE)
        public function modifie($id, $prenom, $nom)
        {
            $requete = "UPDATE realisateur SET prenom = :p, nom = :n WHERE id = :i";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":i", $id);
            $requetePreparee->bindParam(":p", $prenom);
            $requetePreparee->bindParam(":n", $nom);
            $requetePreparee->execute();

            //on retourne le nombre de rangées affectées 
            return $requetePreparee->rowCount();
        }
        
        
    }

?>