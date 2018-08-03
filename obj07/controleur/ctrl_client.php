<?php
// On inclut notre modèle Client
require 'modele/client.php';

// On inclut notre controleur
require_once 'framework/controleur.php';

class CtrlClient extends Controleur
{

	private $cli;

	// Constructeur du contrôleur client
	public function __construct() {
		// On crée un objet de type Client
		$this->cli = new Client();
	}

	// ==============================
	//   Contrôleur recherche client
	// ==============================
	function rechClients($args=null)
	{
		try
		{
			$tabP=array('nom'=>'','ville'=>'');
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

			// On récupère les données pour la vue
			$listeClients=$this->cli->getClients($tabP['nom'],$tabP['ville']);

			// On utilise la classe vue pour client
			$vue = new Vue('client');
			$vue->afficher(array('listeClients' => $listeClients, 'nom' => $tabP['nom'], 'ville' => $tabP['ville']));
		}
		catch (Exception $e)
		{
			$vue = new Vue('erreur');
			$vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
		}
	}


	// Contrôleur création client
	// On récupère le nom, prénom, adresse1, adresse2, cp, ville, email
	// et bouton qui a validé le formulaire
	function creaClient($args=null)
	{	
		if (!isset($_SESSION['acces']) || $_SESSION['acces']!='ok')
		{
			// On en génère un message d'erreur
			throw new Exception('Vous n\'êtes pas authentifié, vous ne pouvez pas consulter cette page désolé !!!<br /><a href="index.php">Retour</a>');
		}
		else
		{
			try
			{
				$tabP=['nom'=>'','prenom'=>'','adr1'=>'','adr2'=>'','cp'=>'','ville'=>'', 'email'=>'','creacli'=>''];
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



				if ($tabP['creacli']!='')
				{
					
					$n=strtoupper($tabP['nom']);
					$p=ucwords(strtolower($tabP['prenom']));
					$a1=strtolower($tabP['adr1']);
					$a2=strtolower($tabP['adr2']);
					$cp=$tabP['cp'];
					$v=strtoupper($tabP['ville']);
					$e=strtolower($tabP['email']);

					// Si l'on a validé le formulaire on vérifie tous les champs
					if(empty($n) || empty($p) || empty($a1) || empty($cp) || empty($v) || empty($e))
					{
						$message = '<span class="rouge">Les champs avec une étoile rouge sont obligatoires et/ou erronnés .</span>';

						// On utilise la classe vue pour client
						$vue = new Vue('client_creation');
						$vue->afficher(['n'=>$n, 'p'=>$p, 'a1'=>$a1, 'a2'=>$a2, 'cp'=>$cp, 'v'=>$v, 'e'=>$e, 'message'=>$message]);

					}
					else
					{
						try{

							$this->cli->setCli($n, $p, $a1, $a2, $cp, $v, $e);

							$titre = 'Création client';
							$enTete = 'Création client';
							$message = 'le client ' . $n . ' ' . $p . ' a bien été créé !';
							$vue = new Vue('message');
							$vue->afficher(['titre'=>$titre, 'enTete'=>$enTete, 'message'=>$message]);

						}
						catch (Exception $e)
						{
							$vue = new Vue('erreur');
							$vue->afficher(['messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()]);

						}
					}
				}
				else
				{
					// Formulaire vide (1er passage)
					// On utilise la classe vue pour client
					$vue = new Vue('client_creation');
					$vue->afficher(['n'=>'', 'p'=>'', 'a1'=>'', 'a2'=>'', 'cp'=>'', 'v'=>'', 'e'=>'', 'message'=>'']);
				}
			}
			catch (Exception $e)
			{
				$vue = new Vue('erreur');
				$vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
			}

		}

	}

	function defaut($args=null) 
	{
		echo 'défaut client<br /><br /><br /><br /><br /><br /><br />';
	}
}
