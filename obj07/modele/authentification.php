<?php

// On inclut la classe Modele
require_once 'framework/modele.php';

class Authentification extends Modele
{

    function getAuthentification($util, $mdp)
    {
        try
        {
            // On prépare la requête de sélection (vérifie si le client et le mot de passe existent)
            $requete = "select n_aut from autorisations where util_aut=? and mdp_aut=?";

            // On crypte le mot de passe
            $pass = hash('sha256', $mdp);

            // On exécute la requête
            $req=$this->requetExec($requete,[$util, $pass]);

            // Si l'utilisateur et le mot de passe sont valides
            if($req->rowCount()==1)
            {
                // On crée des variables session pour gérer les menus
                $_SESSION['log']=$util;
                $_SESSION['acces']='ok';
                return true;
            }
            else
            {
                return false;	
            }
        }
        catch (PDOException $e)
        {
            // Si l'on capture une exception PDO
            // On en génère une nouvelle avec un message plus approprié et son code d'origine
            throw new Exception('Erreur authentification : ' . utf8_encode($e->getMessage()), $e->getCode());
        }
    }
}
