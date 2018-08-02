<?php
// On inclut notre modèle Client
require 'modele/client.php';

class CtrlClient
{

    private $cli;

    // Constructeur du contrôleur client
    public function __construct() {
        // On crée un objet de type Client
        $this->cli = new Client();
    }

    // ==============================
    //   Contrôleur recherche client
    // ==============================
    function rechClients($nom="",$ville="")
    {
        try
        {
            // On récupère les données pour la vue
            $listeClients=$this->cli->getClients($nom,$ville);

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
}
