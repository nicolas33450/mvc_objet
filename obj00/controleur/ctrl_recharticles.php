<?php

// On inclut le modèle articles
require 'modele/article.php';

// ==========================
//    Contrôleur recherche article
// ==========================
function rechArticles()
{
    try
    {
        // On déclare $art un objet de type Articles
        $art= new Article();

        // On récupère les données pour la vue
        $listeArticles=$art->getArticles();

        // On utilise notre vue article
        require 'vue/vue_article.php';
    }
    catch (Exception $e)
    {
        $messErreur =$e->getMessage();
        $codeErreur =$e->getCode();

        // On utilise la vue erreur
        require 'vue/vue_erreur.php';
    }
}
