<?php

// Déclaration de la classe Modele
abstract class Modele
{
    // Propriété privée pdo 
    private $_pdo;

    // =============================================================
    //	Méthode PRIVEE qui permet la connexion à la base de données
    // =============================================================

    private function _getConnex()
    {
        // On vérifie s'il n'existe pas déjà une connexion
        if ($this->_pdo == null) 
        {
            // Création de la connexion
            define('HOTE', 'localhost');	// Mettre le nom d'hôte fourni par l'hébergeur
            define('BDD', 'basemvc');	// Mettre le nom de la base de données fourni par 										// l'hébergeur
            define('UTIL', 'root');		// Mettre le nom de l'utilisateur de la base de données fourni 									// par l'hébergeur
            define('MDP', '');		// Mettre le mot de passe

            try
            {
                @$this->_pdo = new PDO('mysql:host=' . HOTE . ';dbname=' . BDD . ';charset=UTF8', UTIL,MDP, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
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
