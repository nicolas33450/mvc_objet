<?php
// ===========================
//   Contrôleur accueil (page defaut)
// ===========================
function defaut()
{
	try
	{
		// On utilise notre vue accueil
		$vue = new Vue('accueil');
		$vue->afficher();
		
	}
	catch (Exception $e)
	{

		$vue = new Vue('erreur');
		$vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
	}
}
