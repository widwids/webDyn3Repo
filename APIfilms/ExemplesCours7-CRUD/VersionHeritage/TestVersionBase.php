<html>
    <head>
        <meta charset="utf-8">
        <title>Test du CRUD</title>
    </head>
    <body>
        <?php
            require_once("TableAuteur.php"); 
            require_once("TableArticle.php");

            //dans le constructeur, on créé la connexion à la BD qui sera utilisée par toutes les autres méthodes
            //de mon CRUD
            try
            {
                 //pour l'encodage utf8
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
                //connexion à la BD
                $connexion = new PDO("mysql:host=localhost;dbname=blog", "root", "root", $options);
    
            }
            catch(PDOException $e)
            {
                trigger_error("Erreur lors de la connexion : " . $e->getMessage());
            }     

            $dbAuteur = new TableAuteur($connexion); 
            $dbArticle = new TableArticle($connexion); 

            //on part avec un état vide 
            $dbAuteur->insere("gharvey", "Guillaume", "Harvey");
            $dbAuteur->insere("jmartel", "Jonathan", "Martel");

            echo "Deux auteurs ont été créés.";
            $auteurs = $dbAuteur->obtenir_tous();

            echo "<ul>";
            foreach($auteurs as $a)
            {
                echo "<li>" . $a["username"] . " - " . $a["prenom"] . " " . $a["nom"] . "</li>";
            }
            echo "</ul>";

            $dbAuteur->modifie("gharvey", "Guy", "Harvey");

            echo "Auteurs après modification.";
            echo "<ul>";
            $auteurs = $dbAuteur->obtenir_tous();

            foreach($auteurs as $a)
            {
                echo "<li>" . $a["username"] . " - " . $a["prenom"] . " " . $a["nom"] . "</li>";
            }
            echo "</ul>";


            //tests sur TableArticle
            $idPremierArticle = $dbArticle->insere("Premier article titre.", "Premier article texte.", "gharvey");
            $idSecondArticle = $dbArticle->insere("Deuxième article titre.", "Deuxième article texte.", "jmartel");

            $articles = $dbArticle->obtenir_tous();
        
            echo "<table>";
            echo "<tr><th>Titre</th><th>Texte</th><th>Auteur</th><th>id article</th></tr>";
            foreach($articles as $a)
            {
                echo "<tr><td>" . $a["titre"] . "</td><td>" . $a["texte"] . "</td><td>" . $a["idAuteur"] . "</td><td>" . $a["id"] . "</td></tr>";
            }
            echo "</table>";

            $dbArticle->modifie($idPremierArticle, "Modification 1 titre", "Modification 1 texte", "jmartel");

            echo "Articles après modification.";

            $articles = $dbArticle->obtenir_tous();

            echo "<table>";
            echo "<tr><th>Titre</th><th>Texte</th><th>Auteur</th><th>id article</th></tr>";
            foreach($articles as $a)
            {
                echo "<tr><td>" . $a["titre"] . "</td><td>" . $a["texte"] . "</td><td>" . $a["idAuteur"] . "</td><td>" . $a["id"] . "</td></tr>";
            }
            echo "</table>";

            echo "Suppression des deux articles.";
            $dbArticle->supprime($idPremierArticle);
            $dbArticle->supprime($idSecondArticle);

            echo "Suppression des deux auteurs.";
            $dbAuteur->supprime("gharvey");
            $dbAuteur->supprime("jmartel");


        ?>
    </body>
</html>     