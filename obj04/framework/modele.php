<?php
    require_once 'configuration.php';

// On déclare notre classe abstraite car on ne va jamais l'instancier
abstract class Modele 
{
    // Propriété privée pdo 
    // On met le signe souligné (_) pour indiquer que la propriété est privée (Convention)
    private $_pdo;

    // ==============================================================
    //	Fonction PRIVEE qui permet la connexion à la base de données
    // ==============================================================

    private function _getConnex()
    {
        // On vérifie s'il n'existe pas déjà une connexion
        if ($this->_pdo == null) 
        {
            // Création de la connexion
            $hote = Configuration::getParam('hote');	// Mettre le nom d'hôte fourni par l'hébergeur
            $bdd = Configuration::getParam('bdd');	// Mettre le nom de la base de données fourni
            // par l'hébergeur
            $util = Configuration::getParam('util');	// Mettre le nom de l'utilisateur de la base de 
            // données fourni par l'hébergeur
            $mdp = Configuration::getParam('mdp');	// Mettre le mot de passe

            try
            {
                @$this->_pdo = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd . ';charset=UTF8', $util, $mdp, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }
            catch (PDOException $e)
            {
                // Si l'on capture une exception PDO, on en génère une nouvelle Exception
                // avec un message plus approprié et son code d'origine
                throw new Exception('Erreur connexion PDO : ' . utf8_encode($e->getMessage()), $e->getCode());
            }
        }
        return $this->_pdo;

    }
    // ====================================================
    //	Méthode PUBLIQUE qui permet d'exécuter une requête
    //  (on peut lui passer des paramètres) 
    // ====================================================

    public function requetExec($requete, $param = null)
    {
        // On récupère ou l'on crée une connexion
        $pdo = $this->_getConnex();

        // Si la requête n’a pas de paramètres
        if ($param == null) 
        {
            // On exécute la requête (simple) sans parametre
            $res=$pdo->query($requete);
        }
        else 
        {
            // On prépare la requête
            $res = $pdo->prepare($requete);

            // On exécute la requête préparée avec parametre
            $res->execute($param);
        }

        // On retourne le résultat de la requête
        return $res;
    }
}
