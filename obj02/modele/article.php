<?php
// On inclut la classe Modele
require_once 'modele/modele.php';

class Article extends Modele
{

    // ======================================
    //	Méthode qui permet de récupérer les articles
    // ======================================

    public function getArticles()
    {
        // On définit la requête de sélection
        $requete = 'select n_art, nom_art, descr_art, prix_art from articles;';

        // On exécute la requête
        $resultat=$this->requetExec($requete);

        // On retourne tous les clients
        return $resultat;
    }
}
