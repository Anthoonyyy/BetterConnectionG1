<?php

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

