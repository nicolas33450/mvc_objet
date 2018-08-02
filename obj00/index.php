<?php

// On inclut notre modèle (nos contrôleurs en ont besoins)
require 'modele/modele.php';

// On inclut les différents contrôleurs
require 'controleur/ctrl_accueil.php';
require 'controleur/ctrl_rechclients.php';
require 'controleur/ctrl_recharticles.php';

try {
	// ========================================
	// En fonction de la page ou des données reçues,  
	// le dispatcheur appelle le contrôleur nécessaire
	// ========================================
		
	// Si la VARIABLE rechcli a été envoyée par la méthode POST 
	// (Données reçues du formulaire de recherche clients)
	if (isset($_POST['rechcli']))
	{
		rechClients($_POST['nom'], $_POST['ville']);
	}
	// Si la VARIABLE page a été envoyée par la méthode GET
	elseif (isset($_GET['page'])) 
	{
		// Si la page correspond à client
		if ($_GET['page'] == 'client') 
		{
			rechClients();
		}
		else
		{
			rechArticles();
		}
	}
	else 
	{
		// Page affichée par défaut
		defaut();
	}
}
catch (Exception $e) {
	$messErreur =$e->getMessage();
	$codeErreur =$e->getCode();

	// On utilise la vue erreur
	require 'vue/vue_erreur.php';
}
