<?php
// On inclut le modèle client
require 'modele/client.php';

// =======================
//   Contrôleur recherche client
// =======================
function rechClients($nom="",$ville="")
{
    try
    {
        // On crée un objet de type Client
        $cli = new Client();

        // On récupère les données pour la vue
        $listeClients=$cli->getClients($nom,$ville);

        // On utilise la classe vue pour client
        $vue = new Vue('client');
        $vue->afficher(array('listeClients' => $listeClients, 'nom' => $nom, 'ville' => $ville));
    }
    catch (Exception $e)
    {
        $vue = new Vue('erreur');
        $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
    }
}
