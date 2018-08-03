<?php
require_once 'framework/requetehttp.php';
require_once 'vue/vue.php';

abstract class Controleur 
{
    // Action à réaliser
    private $action;

    // Requête entrante
    protected $requeteHTTP;

    // Définit la requête entrante
    public function setRequete(RequeteHTTP $requeteHTTP) 
    {
        $this->requeteHTTP = $requeteHTTP;
    }

    // Exécute l'action à réaliser
    public function executerAction($action) 
    {
        if (method_exists($this, $action)) 
        {
            $this->action = $action;

            $tabRequeteHTTP = $this->requeteHTTP->getTabParams();

            $tabParams = array_diff_key($tabRequeteHTTP, array('action'=>null, 'controleur'=>null,'id'=>null));

            $this->{$this->action}($tabParams);
        }
        else 
        {
            $classeControleur = get_class($this);
            throw new Exception("Action '$action' non définie dans la classe $classeControleur");
        }
    }

    // Méthode abstraite correspondant à l'action par défaut
    // Oblige les classes dérivées à implémenter cette action par défaut
    public abstract function defaut();

    // Génère la vue associée au contrôleur courant
    /*
	protected function genererVue($donneesVue = array()) 
	{
		// Détermination du nom du fichier vue à partir du nom du contrôleur actuel
		$classeControleur = get_class($this);
		$controleur = str_replace("Controleur", "", $classeControleur);

		// Instanciation et génération de la vue
		$vue = new Vue($this->action, $controleur);
		$vue->generer($donneesVue);
	}
	*/
}
