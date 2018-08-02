<?php
// On inclut les différents contrôleurs et la vue
require_once 'vue/vue.php';
require 'controleur/ctrl_accueil.php';
require 'controleur/ctrl_article.php';
require 'controleur/ctrl_client.php';

// classe Dispatcheur va traiter les donner et rediriger vers le controleur adéquat
class Dispatcheur
{
    private $ctrlAccueil;
    private $ctrlArticle;
    private $ctrlClient;

    public function __construct() {
        // On crée un objet de type contrôleur Acceuil
        $this->ctrlAccueil = new CtrlAccueil();

        // On crée un objet de type contrôleur Article
        $this->ctrlArticle = new CtrlArticle();

        // On crée un objet de type contrôleur Client
        $this->ctrlClient = new CtrlClient();
    }

    public function dispatcherRequete()
    {
        try {
            // ===================================================
            // En fonction de la page ou des données reçues,  
            // le dispatcheur appelle le contrôleur nécessaire
            // ===================================================

            // Si la VARIABLE rechcli a été envoyée par la méthode POST 
            // (Données reçues du formulaire de recherche clients)
            if (isset($_POST['rechcli']))
            {

                $this->ctrlClient->rechClients($_POST['nom'], $_POST['ville']);
            }
            // Si la VARIABLE page a été envoyée par la méthode GET
            elseif (isset($_GET['page'])) 
            {
                // Si la page correspond à client
                if ($_GET['page'] == 'client') 
                {
                    $this->ctrlClient->rechClients();
                }
                else
                {
                    $this->ctrlArticle->rechArticles();
                }
            }
            else 
            {
                // Page affichée par défaut
                $this->ctrlAccueil->defaut();
            }
        }
        catch (Exception $e) {
            $vue = new Vue('erreur');
            $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
        }
    }
}
