<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
    <?php
    require_once("Livre.php");

    //mauvaise façon de procéder -- envoyer tous les paramètres pour créer 
    //l'auteur lors de la création du livre
    //$monLivre = new Livre("The Stand", 20, "Stephen", "King", "15/03/1949", "Boston");
    //echo $monLivre->getDescription();

    //bonne façon de procéder, on créé la "dépendance" (l'objet Auteur) pour 
    //ensuite l'injecter dans l'objet qui la contient
    $nouvelAuteur = new Auteur("Stephen", "King", "15/03/1949", "Boston");
    $nouveauLivre = new Livre("The Stand", 20, $nouvelAuteur);

    echo $nouveauLivre->getDescription();

    //avec plusieurs auteurs, on créé le tableau ici et on injecte lors de la création de $livreADeux
    $deuxiemeAuteur = new Auteur("Cormac", "McCarthy", "10/04/1939", "Houston");
    $tableauAuteurs = [$nouvelAuteur, $deuxiemeAuteur];

    $livreADeux = new LivreAvecAuteursMultiples("The New Book", 30, $tableauAuteurs);
    echo $livreADeux->getDescription();

?>
</body>
</html>