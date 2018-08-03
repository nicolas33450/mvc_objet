<?php
class RequeteHTTP {

    // Tableau qui contient les paramètres de la requête
    private $tabParams;

    // Constructeur de la classe RequeteHTTP
    public function __construct($params) {
        $this->tabParams = $params;
    }

    // Renvoie TRUE si le paramètre existe dans la requête et qu’il n’est pas vide
    public function existParam($nom) 
    {
        return (isset($this->tabParams[$nom]) && ($this->tabParams[$nom] != ''));
    }

    // Renvoie la valeur du paramètre demandé
    // Lève une exception si le paramètre est introuvable
    public function getParam($nom) 
    {
        if ($this->existParam($nom)) 
        {
            return $this->tabParams[$nom];
        }
        else
        {
            throw new Exception("Le paramètre $nom est absent de la requête HTTP");	
        }

    }

    // Fonction qui retourne le tableau des paramètres
    public function getTabParams()
    {
        return $this->tabParams; 
    }

}
