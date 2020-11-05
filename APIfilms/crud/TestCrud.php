<html>
    <head>
        <meta charset="utf-8">
        <title>Test du CRUD</title>
    </head>
    <body>
        <?php
            require_once("TableRealisateur.php"); 
            require_once("TableFilm.php");

            //dans le constructeur, on créé la connexion à la BD qui sera utilisée par toutes les autres méthodes
            //du CRUD
            try
            {
                 //pour l'encodage utf8
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
                //connexion à la BD
                $connexion = new PDO("mysql:host=localhost;dbname=apifilms", "root", "", $options);
    
            }
            catch(PDOException $e)
            {
                trigger_error("Erreur lors de la connexion : " . $e->getMessage());
            }     

            $dbRealisateur = new TableRealisateur($connexion); 
            $dbFilm = new TableFilm($connexion); 

            //on part avec un état vide 
            $dbRealisateur->insere("007", "James", "Bond");

            $dbRealisateur->insere("69", "Bat", "Man");

            echo "Deux realisateurs ont été créés.";
            $realisateurs = $dbRealisateur->obtenir_tous();

            echo "<ul>";
            foreach($realisateurs as $r)
            {
                echo "<li>" . $r["id"] . " - " . $r["prenom"] . " " . $r["nom"] . "</li>";
            }
            echo "</ul>";

            $dbRealisateur->modifie("007", "Jesus", "Bond");

            echo "Realisateurs après modification : ";
            echo "<ul>";
            $realisateurs = $dbRealisateur->obtenir_tous();

            foreach($realisateurs as $r)
            {
                echo "<li>" . $r["id"] . " - " . $r["prenom"] . " " . $r["nom"] . "</li>";
            }
            echo "</ul>";


            //tests sur TableFilm
            $idPremierFilm = $dbFilm->insere("Premier film titre", "007", "Premier film genre", "Premier film duree", "1234");
            $idSecondFilm = $dbFilm->insere("Deuxième film titre", "69", "Deuxième film genre", "Deuxième film duree", "2020");

            $films = $dbFilm->obtenir_tous();
        
            echo "<table>";
            echo "<tr><th>ID</th><th>Titre</th><th>Durée</th><th>Année</th><th>Realisateur</th><th>Genre</th></tr>";
            foreach($films as $r)
            {
                echo "<tr><td>" . $r["id"] . "</td><td>" . $r["titre"] . "</td><td>" . $r["duree"] . "</td><td>" . $r["annee"] . "</td><td>" . $r["idRealisateur"] . "</td><td>" . $r["genre"] . "</td></tr>";
            }
            echo "</table><br>";

            $dbFilm->modifie($idPremierFilm, "Mod premier film titre", "007", "Mod premier film genre", "Mod premier film duree", "1337");
            


            echo "Films après modification : ";

            $films = $dbFilm->obtenir_tous();

            echo "<table>";
            echo "<tr><th>ID</th><th>Titre</th><th>Durée</th><th>Année</th><th>Realisateur</th><th>Genre</th></tr>";
            foreach($films as $r)
            {
                echo "<tr><td>" . $r["id"] . "</td><td>" . $r["titre"] . "</td><td>" . $r["duree"] . "</td><td>" . $r["annee"] . "</td><td>" . $r["idRealisateur"] . "</td><td>" . $r["genre"] . "</td></tr>";
            }
            echo "</table><br>";

            echo "Suppression des deux films.";
            $dbFilm->supprime($idPremierFilm);
            $dbFilm->supprime($idSecondFilm);

            echo "Suppression des deux realisateurs.";
            $dbRealisateur->supprime("007");
            $dbRealisateur->supprime("69");


        ?>
    </body>
</html>     