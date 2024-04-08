<?php

<<<<<<< HEAD
function getAllNewsHomePage(PDO $connect): array|string
{
    $sql = "SELECT n.`title`, n.`slug`, SUBSTRING(n.`content`, 1, 280) AS content, n.`date_published`, 
                   u.`login`, u.`thename`
	FROM `news` n
	LEFT JOIN `user` u
		ON n.`user_iduser` = u.`iduser`
-- on va sélectionner les champs title (as categ_title) et slug (as categ_slug) de la table category qu'il y ait des catégories ou pas

    

-- Condition de récupération
    WHERE n.`is_published` = 1
    ORDER BY n.`date_published` DESC

        ;";

    try{
    
    $query = $connect->query($sql);

    // si pas de résultats () : string
    if(!$query->rowCount()) return "Pas encore de message";
    
    $result = $query->fetchAll();

    $query->closeCursor();

    return $result; // : array

    }catch(Exception $e){
        return $e->getMessage(); // : string
    }

}
=======
function getAllNews(PDO $db): array|string
{
    $sql = "SELECT slug, news.title, news.content,user.thename, news.date_published 
    FROM news INNER JOIN user
    ON news.user_iduser = user.iduser
    --On va séléctionner les champs title (as categTitle) et slug ( as categSlug) de la table catégory qu'il y ait des catégories ou pas
    WHERE news.is_published = 1
    ORDER BY news.date_published DESC";
    try{
     $query = $db->query($sql);
     // si pas de résultats () : string
     if(!$query->rowCount()) return "Pas encore de message";

     $result = $query->fetchAll(PDO::FETCH_ASSOC);

     $query->closeCursor();

     return $result; // : array

    }catch(Exception $e){
        return $e->getMessage(); // string
    }
}

>>>>>>> 82461f22c8884a85562b2dbf8e90da856574885b
