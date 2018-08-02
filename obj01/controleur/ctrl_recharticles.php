<?php

// On inclut le modèle article
require 'modele/article.php';

// ========================
//    Contrôleur recherche article
// ========================
function rechArticles()
{
    try
    {
        // On déclare $art un objet de type Article
        $art= new Article();

        // On récupère les données pour la vue
        $listeArticles=$art->getArticles();	

        // On utilise la classe vue pour article
        $vue = new Vue('article');
        $vue->afficher(array('listeArticles' => $listeArticles));

    }
    catch (Exception $e)
    {
        $vue = new Vue('erreur');
        $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
    }
}
