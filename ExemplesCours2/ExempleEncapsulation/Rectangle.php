<?php

    //a) créer une classe Rectangle avec deux attributs : longueur et largeur
    class Rectangle
    {
        //attributs
        private $longueur;
        private $largeur;

        //constructeur de la classe Rectangle (les deux paramètres sont facultatifs, 
        //si un seul paramètre est présent, on créé un carré)
        //si aucun paramètre n'est présent, on créé un carré de 1x1
        public function __construct($lon = 1, $lar = null)
        {

            $this->setLongueur($lon);
            
            //si la largeur n'a pas été spécifiée, 
            //mettre la longueur dans la largeur pour créer un rectangle carré.
            if($lar == null)
                $this->setLargeur($lon);
            else    
                $this->setLargeur($lar);
        }
        
        //méthodes d'accès pour longueur (getter et setter)
        public function getLongueur()
        {
            return $this->longueur;
        }

        public function setLongueur($l)
        {
            if(is_numeric($l) && $l > 0)
                $this->longueur = $l;
            else
                die("Création d'un rectangle invalide. La longueur doit être un nombre positif.");
        }


         //méthodes d'accès pour largeur (getter et setter)
         public function getLargeur()
         {
             return $this->largeur;
         }
 
         public function setLargeur($l)
         {
            if(is_numeric($l) && $l > 0)
                $this->largeur = $l;
            else
                die("Création d'un rectangle invalide. La largeur doit être un nombre positif.");
         }

        // méthode getAire permettant de calculer et de RETOURNER l'aire du rectangle
        public function getAire()
        {
            return $this->longueur * $this->largeur;
        }
        
        //méthode getPerimetre permettant de calculer et de retourner le périmètre du rectangle
        public function getPerimetre()
        {
            return 2 * ($this->longueur + $this->largeur);
        }
        
        //méthode estCarre qui retourne vrai si le rectangle est aussi un carré, faux sinon
        public function estCarre()
        {
            if($this->longueur == $this->largeur)
                return true;
            else
                return false;
        }

        //méthode getDescription qui retourne une chaine de caractères contenant la description du rectangle, 
        //c'est à dire sa longueur, sa largeur, son aire, son périmètre ainsi qu'une courte phrase disant si 
        //c'est un carré ou pas. Le tout dans la même chaine. 
        public function getDescription()
        {
            $description = "Le rectangle a une longueur de $this->longueur et une largeur de $this->largeur.";
            
            $description .= "L'aire de ce rectangle est " . $this->getAire() . "<br>";
            
            $description .= "Le périmètre de ce rectangle est : " . $this->getPerimetre() . "<br>";
            
            if($this->estCarre())
                $description .= "Le rectangle est aussi un carré.<br>";
            else
                $description .= "Le rectangle n'est pas un carré.<br>";
            
            return $description;
        }
        
    }
    

   

?>