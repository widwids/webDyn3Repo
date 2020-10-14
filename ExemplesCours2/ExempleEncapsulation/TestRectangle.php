<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
    <?php
        require_once("Rectangle.php");
        //appel du constructeur avec deux paramètres
        $rectangle1 = new Rectangle(20, 15);

        //appel du constructeur avec un seul paramètre (ce sera un carré)
        $rectangle2 = new Rectangle(25);
        //appel du constructeur avec aucun paramètre (ce sera un carré de 1x1)
        $petitCarre = new Rectangle();

        
       // $rectangle1->setLongueur("bonjour");
       // $rectangle1->setLargeur(20);
        
       // $rectangle2->setLongueur(25);
       // $rectangle2->setLargeur(25);
        
        //faire afficher la longueur et la largeur de chacune des instances
        echo "La longueur du rectangle 1 est " . $rectangle1->getLongueur() . " et sa largeur est " . $rectangle1->getLargeur() . "<br>";
        
        //avec concaténation implicite
        echo "La longueur du rectangle 2 est " . $rectangle2->getLongueur() . " et sa largeur est " . $rectangle2->getLargeur() . "<br>";
        
        //tester la méthode getAire avec chacune de vos instances.
        echo "L'aire du rectangle 1 est : " . $rectangle1->getAire() . "<br>";
        echo "L'aire du rectangle 2 est : " . $rectangle2->getAire() . "<br>";
        //tester la méthode getPerimetre
         echo "Le périmètre du rectangle 1 est : " . $rectangle1->getPerimetre() . "<br>";
        echo "Le périmètre du rectangle 2 est : " . $rectangle2->getPerimetre() . "<br>";
        //tester la méthode estCarre
        if($rectangle1->estCarre())
            echo "Le rectangle 1 est carré.<br>";
        
        if($rectangle2->estCarre())
            echo "Le rectangle 2 est carré.<br>";
        //tester la méthode getDescription
        echo "<br>";
        echo "<br>";
        echo $rectangle1->getDescription();
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo $rectangle2->getDescription();
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo $petitCarre->getDescription();
        ?>
    </body>
</html>    
        