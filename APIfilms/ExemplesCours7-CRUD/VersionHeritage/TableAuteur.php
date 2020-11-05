<?php
    require_once("TableBase.php");

    class TableAuteur extends TableBase
    {
        public function getNomTable()
        {
            return "auteur";
        }

        public function getClePrimaire()
        {
            return "username";
        }

        //création (CREATE)
        public function insere($username, $prenom, $nom)
        {
            $requete = "INSERT INTO auteur(username, prenom, nom) VALUES (:u, :p, :n)";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":u", $username);
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
        public function modifie($username, $prenom, $nom)
        {
            $requete = "UPDATE auteur SET prenom = :p, nom = :n WHERE username = :u";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":u", $username);
            $requetePreparee->bindParam(":p", $prenom);
            $requetePreparee->bindParam(":n", $nom);
            $requetePreparee->execute();

            //on retourne le nombre de rangées affectées 
            return $requetePreparee->rowCount();
        }
        
        
    }

?>