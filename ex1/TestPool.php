 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex1 Pool</title>
</head>
<body>
    <?php
        require_once("Pool.php");

        $joueur1 = new Joueur("George", "Vincent", 9000, 9000);
        $participant1 =new Participant("Vincent", "VanGogh", $joueur1);
        
        var_dump($joueur1);
        var_dump($participant1);


        echo $joueur1->getDescription();

        $joueur2 = new Joueur("Andy", "Warhol", 1, 2);
        $tableauJoueurs = [$joueur1, $joueur2];

        $participant2 =new ParticipantAvecJoueursMultiples("Kevin", "Bacon", $tableauJoueurs);
        
        var_dump($joueurs2);
        var_dump($participant2);
        echo $participant2->getDescription();
        
    ?>
</body>
</html>