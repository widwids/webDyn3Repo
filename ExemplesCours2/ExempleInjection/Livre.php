<?php

    class Auteur
    {
        private $prenom;
        private $nom;
        private $dateNaissance;
        private $ville;

        public function __construct($p, $n, $d, $v)
        {
            $this->prenom = $p;
            $this->nom = $n;
            $this->dateNaissance = $d;
            $this->ville = $v;

        }

        //on ajouterait getters and setters....

        public function getDescription()
        {
            $description = "Prénom de l'auteur : " . $this->prenom . "<br>";
            $description .= "Nom de l'auteur : " . $this->nom . "<br>";
            $description .= "Date de naissance de l'auteur : " . $this->dateNaissance . "<br>";
            $description .= "Ville de naissance de l'auteur : " . $this->ville . "<br>";
            return $description;
        }
    }

    class Livre
    {
        private $titre;
        private $prix;
        private $auteur;

        //le paramètre $a doit absolument être de type Auteur pour créer un objet Livre
        public function __construct($t, $p, Auteur $a)
        {
            $this->setTitre($t);
            $this->setPrix($p);
           
            //autre validation possible avec instanceof
            if($a instanceof Auteur)
                $this->auteur = $a;
            else   
                die("Le troisième paramètre doit être une instance de la classe Auteur.");
        }

        public function getTitre()
        {
            return $this->titre;
        }
        
        public function setTitre($t)
        {
            $this->titre = $t;
        }
        
        public function getPrix()
        {
            return $this->prix;
        }
        
        public function setPrix($p)
        {
            if(is_numeric($p))
                $this->prix = $p;
            else
                die("Le prix doit être numérique.");
        }

        public function getDescription()
        {
            $description = "Titre du livre : " . $this->titre . "<br>";
            $description .= "Prix du livre : " . $this->prix . "<br>";
            $description .= "Auteur du livre : " . $this->auteur->getDescription() . "<br>";
            return $description;

        } 

    }

    class LivreAvecAuteursMultiples
    {
        private $titre;
        private $prix;
        private $auteurs;

        //le paramètre $a doit absolument être de type Auteur pour créer un objet Livre
        public function __construct($t, $p, array $a)
        {
            $this->setTitre($t);
            $this->setPrix($p);
            $this->setAuteurs($a);
        }

        public function getTitre()
        {
            return $this->titre;
        }
        
        public function setTitre($t)
        {
            $this->titre = $t;
        }
        
        public function getPrix()
        {
            return $this->prix;
        }
        
        public function setPrix($p)
        {
            if(is_numeric($p))
                $this->prix = $p;
            else
                die("Le prix doit être numérique.");
        }
        
        public function getAuteurs()
        {
            return $this->auteurs;
        }

        public function setAuteurs(array $tabAuteurs)
        {
            //déterminer que $a est un tableau d'Auteurs (et non pas un tableau d'entiers ou de chaines)
            foreach($tabAuteurs as $a)
            {
                if(!($a instanceof Auteur))
                    die("Chaque auteur dans le tableau doit être une instance de la classe Auteur");
            }

            $this->auteurs = $tabAuteurs;
        }

        public function getDescription()
        {
            $description = "Titre du livre : " . $this->titre . "<br>";
            $description .= "Prix du livre : " . $this->prix . "<br>";
            $description .= "Auteurs du livre : <br> "; 
            foreach($this->auteurs as $a)
                $description .=  $a->getDescription() . "<br>";

            return $description;

        } 

    }

    //mauvaise façon de faire -- on a de fortes dépendances entre la classe Livre et la classe Auteur

    /*class Livre
    {
        private $titre;
        private $prix;
        private $auteur;

        //dépendance problématique dans la signature du constructeur - si le nombre de paramètres change dans la classe Auteur, il changera ici aussi!
        public function __construct($t, $p, $pr, $n, $d, $v)
        {
            $this->titre = $t;
            $this->prix = $p;
            $this->auteur = new Auteur($pr, $n, $d, $v);
        }

        public function getDescription()
        {
            $description = "Titre du livre : " . $this->titre . "<br>";
            $description .= "Prix du livre : " . $this->prix . "<br>";
            $description .= "Auteur du livre : " . $this->auteur->getDescription() . "<br>";
            return $description;

        } 

    }*/