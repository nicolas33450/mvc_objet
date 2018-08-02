<?php
// On inclut les différents contrôleurs
require_once 'vue/vue.php';
require 'controleur/ctrl_accueil.php';
require 'controleur/ctrl_recharticles.php';
require 'controleur/ctrl_rechclients.php';

try {
    // ===================================================
    // En fonction de la page ou des données reçues,  
    // le dispatcheur appelle le contrôleur nécessaire
    // ===================================================

    // Si la VARIABLE rechcli a été envoyée par la méthode POST 
    // (Données reçues du formulaire de recherche clients)
    if (isset($_POST['rechcli']))
    {
        rechClients($_POST['nom'], $_POST['ville']);
    }
    // Si la VARIABLE page a été envoyée par la méthode GET
    elseif (isset($_GET['page'])) 
    {
        // Si la page correspond à client
        if ($_GET['page'] == 'client') 
        {
            rechClients();
        }
        else
        {
            rechArticles();
        }
    }
    else 
    {
        // Page affichée par défaut
        defaut();
    }
}
catch (Exception $e) {
    $vue = new Vue('erreur');
    $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
}
