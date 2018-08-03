<?php
// On inclut notre modèle Client
require 'modele/client.php';

// On inclut notre controleur
require_once 'framework/controleur.php';

class CtrlClient extends Controleur
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
    function rechClients($args=null)
    {
        try
        {
            $tabP=array('nom'=>'','ville'=>'');
            // Si notre paramètre est un tableau non vide
            if(is_array($args) && !empty($args))
            {
                // Pour chaque clé, on récupère la valeur correspondante
                foreach($args as $clef => $valeur)
                {
                    // Si la propriété de la classe existe, on met à jour sa valeur
                    if(array_key_exists($clef, $tabP))
                    {
                        $tabP[$clef] = $valeur;
                    }
                }
            }

            // On récupère les données pour la vue
            $listeClients=$this->cli->getClients($tabP['nom'],$tabP['ville']);

            // On utilise la classe vue pour client
            $vue = new Vue('client');
            $vue->afficher(array('listeClients' => $listeClients, 'nom' => $tabP['nom'], 'ville' => $tabP['ville']));
        }
        catch (Exception $e)
        {
            $vue = new Vue('erreur');
            $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
        }
    }

    function defaut($args=null) 
    {
        echo 'défaut client<br /><br /><br /><br /><br /><br /><br />';
    }
}
