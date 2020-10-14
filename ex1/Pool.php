<?php    

    class Joueur
    {
    
        //private $equipe;
        private $prenom;
        private $nom;
        private $passe;
        private $but;
        // methode calculePoints();

        public function __construct($p, $n, $nbp, $nbb) 
        {
            $this->prenom = $p;
            $this->nom = $n;
            $this->passe = $nbp;
            $this->but = $nbb;

        }

        public function getDescription()
        {
            $description = "Prénom du joueur : " . $this->prenom . "<br>";
            $description .= "Nom du joueur : " . $this->nom . "<br>";
            $description .= "Nombre de passes du joueur : " . $this->passe . "<br>";
            $description .= "Nombre de buts du joueur : " . $this->but . "<br>";
            return $description;
        }
    }




    class Participant
    {
        private $prenom;
        private $nom;        
        private $joueurs;

        public function __construct($p, $n, Joueur $j)
        {
            $this->setPrenom($p);
            $this->setNom($n);

            if($j instanceof Joueur)
                $this->joueur = $j;
            else   
                die("Le troisième paramètre doit être une instance de la classe Joueur.");
        }

        public function getPrenom()
        {
            return $this->prenom;
        }

        public function setPrenom($p)
        {
            $this->prenom = $p;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function setNom($n)
        {
            $this->nom = $n;
        }

        public function getDescription()
        {
            $description = "Prenom du participant : " . $this->prenom . "<br>";
            $description .= "Nom du participant : " . $this->nom . "<br>";
            $description .= "Joueur selectionne : " . $this->joueur->getDescription() . "<br>";
            return $description;
        }    

    }






    class ParticipantAvecJoueursMultiples
    {   
        private $prenom;
        private $nom;        
        private $joueurs;

        public function __construct($p, $n, array $j)
        {
            $this->setPrenom($p);
            $this->setNom($n);
            $this->setJoueurs($j);

        }

        public function getPrenom()
        {
            return $this->prenom;
        }

        public function setPrenom($p)
        {
            $this->prenom = $p;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function setNom($n)
        {
            $this->nom = $n;
        }
        
        public function getJoueurs()
        {
            return $this->joueurs;
        }

        public function setJoueurs(array $tabJoueurs)
        {
            foreach($tabJoueurs as $j)
            {
                if(!($j instanceof Joueurs))
                echo("Chaque joueur dans le tableau doit être une instance de la classe Joueurs");
                //die("Chaque joueur dans le tableau doit être une instance de la classe Joueurs");
            }

            $this->joueurs = $tabJoueurs;
        }

        public function getDescription()
        {
            $description = "Prenom du participant : " . $this->prenom . "<br>";
            $description .= "Nom du participant : " . $this->nom . "<br>";
            $description .= "Joueurs selectionnes : ";
            foreach($this->joueurs as $j);
                $description .= $j->getDescription() . "<br>";   

            return $description;

        } 
    }

    
    
    class Equipe
    {

    }




?>