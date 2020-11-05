<?php

    class TableAuteur
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
        public function insere($username, $prenom, $nom)
        {
            $requete = "INSERT INTO auteur(username, prenom, nom) VALUES (:u, :p, :n)";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":u", $username);
            $requetePreparee->bindParam(":p", $prenom);
            $requetePreparee->bindParam(":n", $nom);
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
            $requete = "SELECT * FROM auteur";
            $resultats = $this->db->query($requete);
            return $resultats;
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
        
        //suppression (DELETE)
        public function supprime($id)
        {
            $requete = "DELETE FROM auteur WHERE username=:id";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":id", $id);
            $requetePreparee->execute();

            //on retourne le nombre de rangées affectées 
            return $requetePreparee->rowCount();
        }
    }

?>