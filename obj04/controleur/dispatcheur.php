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
            // =====================================
            // En fonction de la page ou des données reçues,  
            // le dispatcheur appelle le contrôleur nécessaire
            // =====================================

            // On fusionne les éventuels tableaux _GET et _POST pour uniformiser
            // la recherche des informations
            $monTab = array_merge($_GET, $_POST);
            
           /* if(count($monTab)>3)
            { 
                echo 'monTab = ' . print_r($monTab);// print_r affiche un tableau
                exit(0);
            }*/

            // Si un controleur est indiqué (s’il existe)
            if(isset($monTab['controleur']))
            {
                // On crée le nom du controleur à appeler
                $controleur = 'ctrl' . ucfirst($monTab['controleur']);

                $tabParams = array_diff_key($monTab, array('action'=>null, 'controleur'=>null,'id'=>null));

                // On appele le contrôleur avec les paramètres
                $this->{$controleur}->{$monTab['action']}($tabParams);
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

