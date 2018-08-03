<?php

// On inclut notre modèle Authentification
require 'modele/authentification.php';

// On inclut notre controleur
require_once 'framework/controleur.php';

class CtrlAuthentification extends Controleur
{
    private $auth;

    // Constructeur du contrôleur Authentification
    public function __construct() {
        // On crée un objet de type Authentification
        $this->auth = new Authentification();
    }

    // Contrôleur authentification
    // On récupère le nom, le mot de passe et le bouton qui a validé le formulaire
    function authentification($args=null)
    {
        $tabP=array('login'=>'','mdp'=>'','btvalid'=>'');
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

        if ($tabP['btvalid']!='')
        {
            if($this->auth->getAuthentification($tabP['login'],$tabP['mdp']))
            {
                $titre = 'Administration';
                $enTete = 'Administration';
                $message = 'Bienvenue dans la partie administration';

                $vue = new Vue('message');
                $vue->afficher(array('titre'=>$titre, 'enTete'=>$enTete, 'message'=>$message));

            }
            else
            {
                // On en génère une nouvelle avec un message plus approprié et son code d'origine
                throw new Exception('Vous n\'êtes pas authentifié, désolé !!!<br /><a href="index.php?controleur=authentification&action=authentification&id=">Retour</a>');
            }
        }
        else
        {
            // Formulaire vide (1er passage)
            // On utilise la classe vue pour authen
            $vue = new Vue('authentification');
            $vue->afficher(array('message'=>''));



        }
    }

    // Contrôleur Deconnexion
    function deconnexion()
    {
        try
        {
            // On supprime toutes les variables session
            session_unset ();

            // Redirection page index
            header('Location: index.php');
        }
        catch (Exception $e)
        {
            $vue = new Vue('erreur');
            $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
        }
    }

    function defaut($args=null) 
    {
        echo 'défaut authentification<br /><br /><br /><br /><br /><br /><br />';
    }
}
