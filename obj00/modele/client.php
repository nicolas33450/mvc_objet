<?php	

// On inclut la classe Modele
require_once 'modele/modele.php';

class Client extends Modele
{
    // =====================================
    //	Fonction qui permet de récupérer les clients
    // =====================================

    public function getClients($nom="",$ville="")
    {
        // On prépare la requête de sélection (on trie par nom et par ville)
        $requete = "select n_cli, nom_cli, prenom_cli, cp_cli, ville_cli, email_cli from clients where nom_cli like ? and ville_cli like ? order by nom_cli, ville_cli";

        // On ajoute le signe % pour prendre tout ce qui commence par
        $nom = $nom . '%';
        $ville = $ville . '%';

        // On exécute la requête
        $req=$this->requetExec($requete,[$nom, $ville]);

        // On transfère toutes les lignes dans un tableau
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        // On retourne tous les clients correspondant aux critères
        return $resultat;
    }
}
