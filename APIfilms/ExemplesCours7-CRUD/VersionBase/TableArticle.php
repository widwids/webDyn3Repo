<?php

    class TableArticle
    {
        //objet PDO contenant une connexion à la base de données
        private $db;

        public function __construct()
        {
            //dans le constructeur, on créé la connexion à la BD qui sera utilisée par toutes les autres méthodes
            //de mon CRUD
            try
            {
                 //pour l'encodage utf8
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
                //connexion à la BD
                $this->db = new PDO("mysql:host=localhost;dbname=blog", "root", "root", $options);
    
            }
            catch(PDOException $e)
            {
                trigger_error("Erreur lors de la connexion : " . $e->getMessage());
            }          
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
        //lecture (READ)
        public function obtenir_par_id($id)
        {
            $requete = "SELECT * FROM auteur WHERE username=:id";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":id", $id);
            $requetePreparee->execute();

            //on retourne l'identifiant de la dernière insertion
            return $requetePreparee->fetch();
        }

        public function obtenir_tous()
        {
            $requete = "SELECT * FROM article";
            $resultats = $this->db->query($requete);
            return $resultats;
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

            //on retourne le nombre de rangées affectées 
            return $requetePreparee->rowCount();
        }
        
        //suppression (DELETE)
        public function supprime($id)
        {
            $requete = "DELETE FROM article WHERE id=:id";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":id", $id);
            $requetePreparee->execute();

            //on retourne le nombre de rangées affectées 
            return $requetePreparee->rowCount();
        }
    }

?>