<?php
    //ne pas afficher les erreurs -- commenter si vous voulez afficher les erreurs
    //error_reporting(0);

    //entêtes de réponse requises
    header("Access-Control-Allow-Origin: *");
    //spécifier que la réponse sera en JSON
    header("Content-Type: application/json; charset=UTF-8");

    //connexion à la BD
    require_once("crud/TableAuteur.php"); 

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

    //structure décisionnelle qui observe la méthode utilisée dans la requête
    switch($_SERVER["REQUEST_METHOD"])
    {
        case "POST":
            //create - création d'un auteur
            //obtenir le corps de la requête
            $dataJSON = file_get_contents("php://input");

            //on décode le JSON et ça nous donne un objet auteur
            $auteur = json_decode($dataJSON);
            if(isset($auteur->username, $auteur->prenom, $auteur->nom))
            {
                //procéder à l'insertion
                $retour = $dbAuteur->insere($auteur->username, $auteur->prenom, $auteur->nom);

                if($retour !== false)
                {
                    //l'ajout a fonctionné - retourner un code 201 ET afficher le json inséré
                    http_response_code(201);
                    echo $dataJSON;
                }
                else
                {
                    //l'ajout n'a pas fonctionné, une clé étrangère n'est pas respectée ou la clé primaire est déjà utilisée, etc.
                    //CONFLICT
                    http_response_code(409);
                }
            }
            else
            {
                //le JSON envoyé en paramètres ne contient pas les attributs nécessaires - MAUVAISE REQUETE BAD REQUEST 400
                http_response_code(400);
            }
        break;
        case "GET":
            if(isset($_GET["username"]))
            {
                $auteur = $dbAuteur->obtenir_par_id($_GET["username"]);

                if($auteur)
                {
                    echo json_encode($auteur);
                    http_response_code(200);
                }                
                else
                {
                    http_response_code(404);
                }
            }
            else
            {
                //read - lecture
                $resultat = $dbAuteur->obtenir_tous();
                $auteursTableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($auteursTableau);
                //code de retour approprié - 200 pour OK
                http_response_code(200);
            }
        break;
        case "PUT":
            //update - mise à jour
        break;
        case "DELETE":
            //delete - suppression
        break;

    }

?>