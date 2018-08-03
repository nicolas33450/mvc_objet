<?php
// On inclut les fichiers
require_once 'framework/requetehttp.php';
require_once 'vue/vue.php';

// La classe Dispatcheur va traiter les donner et redirriger vers le controleur adéquat
class Dispatcheur
{ 
    // Routage d'une requête
    public function dispatcherRequete() 
    {
        try {
            // Fusion des paramètres GET et POST dans un tableau pour créer l'objet RequeteHTTP
            $requeteHTTP = new RequeteHTTP(array_merge($_GET, $_POST));

            // Création du controleur en fonction du paramètre controleur de RequeteHTTP
            $controleur = $this->creerControleur($requeteHTTP);

            $action = $this->creerAction($requeteHTTP);
            $controleur->executerAction($action);
        }
        catch (Exception $e) 
        {
            $vue = new Vue('erreur');
            $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
        }
    }

    // Crée le contrôleur approprié en fonction de la requête reçue
    private function creerControleur(RequeteHTTP $requeteHTTP)
    {
        // Contrôleur par défaut
        $controleur = "accueil";
        if ($requeteHTTP->existParam('controleur')) 
        {
            $controleur = $requeteHTTP->getParam('controleur');
        }

        // Création du nom du fichier du contrôleur
        $fichierControleur = "controleur/ctrl_" . $controleur . ".php";
        // Première lettre en majuscule
        $controleur = ucfirst($controleur);
        $classeControleur = "Ctrl" . $controleur;

        // Si le fichier de la classe contrôleur existe
        if (file_exists($fichierControleur)) 
        {
            // Instanciation du contrôleur adapté à la requête HTTP
            require($fichierControleur);
            $controleur = new $classeControleur();
            $controleur->setRequete($requeteHTTP);
            return $controleur;
        }
        else
        {
            throw new Exception("Fichier '$fichierControleur' introuvable");	
        }
    }

    // Détermine l'action à exécuter en fonction de la requête HTTP reçue
    private function creerAction(RequeteHTTP $requeteHTTP) 
    {
        // Action par défaut
        $action = "defaut";  
        if ($requeteHTTP->existParam('action')) 
        {
            $action = $requeteHTTP->getParam('action');
        }
        return $action;
    }
}
