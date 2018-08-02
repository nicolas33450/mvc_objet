<?php
// On inclut notre modèle Article
require 'modele/article.php';

class CtrlArticle
{
    private $art;

    // Constructeur de la classe CtrlArticle
    public function __construct() {
        // On crée un objet de type Article
        $this->art = new Article();
    }

    // ====================================
    //    Contrôleur recherche article
    // ====================================
    function rechArticles()
    {
        try
        {
            // On récupère les données pour la vue
            $listeArticles=$this->art->getArticles();

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
}
