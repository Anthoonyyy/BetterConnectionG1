<?php
//Contrôleur frontal


//Chargement des dépendances

require_once("../config.php");
require_once("../model/CategoryModel.php");
require_once("../model/NewsModel.php");

try {
    //Instanciation de la connexion PDO
    $db = new PDO(MY_DB_DRIVER . ":host=" . MY_DB_HOST . ";dbname=" . MY_DB_NAME . ";port=" . MY_DB_PORT . ";charset=" . MY_DB_CHARSET, MY_DB_LOGIN, MY_DB_PWD);

    // on mets l'attribut en fetch_assoc
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die($e->getMessage());
}


// chargement des catégories pour le menu
$menuSlug = getAllCategoriesBySlug($db);

//var_dump($titleDescription);

// router temporaire
if(isset($_GET['section'])){

        // récupération/ protection de la variable slug de category
        $categ = htmlspecialchars(strip_tags(trim($_GET['section'])),ENT_QUOTES);

        $category = getCategoryBySlug($db,$categ);

        // si on récupere du texte
        if(is_string($category)){
            //on a une erreur sql, on peut l'afficher mais pas nécessaire
            $message = $category;
            //si on récupere false, la rubrique n'existe pas
        }elseif($category===false){
            $message = "Rubrique inconnue";
            include_once "../view/404.view.php";
            //fermeture de connexio,
            $db = null;
            //arrêt du script
            exit();
        }

        //chargement des news de la catégorie actuelle via son slug
        $newsInfoSection = getNewsFromCategorySlug($db,$categ);
        if(empty($newsInfoSection)){
            $message = "Pas encore d'articles dans cette section";
        }
        /*
        Appel de la vue
        */
        include_once "../view/section.view.php";
}else{
/*
homepage
*/
        

        // chargement des news pour la page d'accueil
        $newsHomepage = getAllNewsHomePage($db);

        // var_dump($menuSlug);
        // var_dump($newsHomepage);

        /*
        Appel de la vue
        */
        include_once "../view/homepage.view.php";
}

//Fermeture de connexion

$db = null;