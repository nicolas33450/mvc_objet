<?php

// On inclut le modèle clients
require 'modele/client.php';

// =========================
//   Contrôleur recherche client
// =========================
function rechClients($nom="",$ville="")
{
    try
    {
        // On crée un objet de type Clients
        $cli = new Client();

        // On récupère les données pour la vue
        $listeClients=$cli->getClients($nom,$ville);

        // On utilise notre vue client
        require 'vue/vue_client.php';
    }
    catch (Exception $e)
    {
        $messErreur = $e->getMessage();
        $codeErreur =$e->getCode();

        // On utilise la vue erreur
        require 'vue/vue_erreur.php';
    }
}
