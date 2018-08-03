<?php	

	// On inclut la classe Modele
	require_once 'framework/modele.php';


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
		
		// =================================================
		//	Fonction qui permet de créer un client
		// =================================================

		function setCli($nom, $prenom, $adr1, $adr2, $cp, $ville, $email)
		{
			try
			{
				// On vérifie si le client n'existe pas (critère email_cli)
				$requete = "select n_cli from clients where email_cli = ?";

				// On exécute la requête
				$req=$this->requetExec($requete, [$email]);

				// Si rowCount() est égal à zéro --> le client n'existe pas	
				if($req->rowCount()==0)
				{
					// On définit la requête d'insertion, les champs et les données correspondantes
					$requete2 = "insert into clients (nom_cli, prenom_cli, adr1_cli, adr2_cli, cp_cli, ville_cli, email_cli) VALUES (?, ?, ?, ?, ?, ?, ?);";

					// On exécute la requête avec les paramètres
					$req=$this->requetExec($requete2,[$nom,$prenom,$adr1,$adr2,$cp,$ville,$email]);
				}
				else
				{
					// On génère une nouvelle exeption avec un message plus approprié et son code d'origine
					throw new Exception('Ce client existe déjà !!!');	
				}
			}
			catch (PDOException $e)
			{
				// Si l'on capture une exception PDO
				// On en génère une nouvelle avec un message plus approprié et son code d'origine
				throw new Exception('Erreur Lors de la création du client : ' . utf8_encode($e->getMessage()), $e->getCode());
			}
		}
		
	}
