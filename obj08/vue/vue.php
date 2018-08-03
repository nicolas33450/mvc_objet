<?php

require_once 'framework/configuration.php';

class Vue {

	// Nom du fichier à appeler
	private $fichier;

	// Titre de la vue
	private $titre;

	// En tête de la page
	private $enTete;
	
	// En tête de la page
	private $menuCSS;

	// Constructeur de la classe Vue, on lui passe le nom de la vue à utiliser.
	public function __construct($action) {

		// On récupère le menu
		$this->menuCSS= $this->getMenuCss();
		
		// On crée le nom du fichier de la vue à appeler, à partir du paramètre $action
		$this->fichier = "vue/vue_" . $action . ".php";
	}

	// Génère et affiche la vue
	public function afficher($donnees=array()) {
		
		// Génération de la partie spécifique de la vue
		// On passe le nom du fichier et les données spécifiques (récupérées par le modèle)
		$contenu = $this->genererSortieHtml($this->fichier, $donnees);
        
        // On récupère le chemin de base du site
		$cheminSite = Configuration::getParam("cheminSite", "/");

		// On génère le résultat final en utilisant le Template
		// On passe en paramètres le titre l’entête et le contenu
		$resHtml = $this->genererSortieHtml('vue/template.php',array('menuCSS'=> $this->menuCSS,'titre' => $this->titre,'enTete' => $this->enTete, 'contenu' => $contenu, 'cheminSite'=>$cheminSite));

		// Affiche le résultat
		echo $resHtml;
	}

	// A l'aide des données transmises, on génère des données au format HTML
	private function genererSortieHtml($fichier, $donnees) {

		// Si le fichier passé en paramètre existe
		if (file_exists($fichier)) 
		{
			// Permet de récupérer les éléments du tableau $donnees passé en paramètre sous forme de variables.
			extract($donnees);

			// Démarrage de la temporisation de sortie
			ob_start();

			// Inclut le fichier vue (correspondant à la vue que l'on va utiliser)
			// le contenu du fichier est placé dans le tampon de sortie
			require $fichier;

			// Arrêt de la temporisation et renvoi du tampon de sortie
			return ob_get_clean();
		}
		else 
		{
			// Si le fichier n'existe pas, on affiche un message
			throw new Exception('Le fichier ' . $fichier . ' est introuvable');
		}
	}
	
	
	private function getMenuCss()
	{
		if(isset($_SESSION['acces']))
		{
			// Menu Administration
			return '<div id="menucss">
					<ul>
						<li>
							<a href="index.php">Accueil</a>
						</li>
						<li><span class="titremenucss">Les articles</span>
							<ul>
								<li><a href="article/rechArticles/index.php">Visualiser</a></li>
							</ul>
						</li>
						<li><span class="titremenucss">Les clients</span>
							<ul>
								<li><a href="client/rechClients/index.php">Rechercher</a></li>
								<li><a href="client/creaClient/index.php">Créer</a></li>
							</ul>
						</li>
					</ul>	

				</div>
				<div id="menucss2">
					<img src="images/cadenas_o16.png" width="16" height="16"><a href="authentification/deconnexion/index.php">Déconnexion</a>
			  </div>';
		}
		else	
		{
			// Menu Standard
			return '<div id="menucss">
					<ul>
						<li>
							<a href="index.php">Accueil</a>
						</li>
						<li><span class="titremenucss">Les articles</span>
							<ul>
								<li><a href="article/rechArticles/index.php">Visualiser</a></li>
							</ul>
						</li>
						<li><span class="titremenucss">Les clients</span>
							<ul>
								<li><a href="client/rechClients/index.php">Rechercher</a></li>
							</ul>
						</li>
					</ul>	

				</div>
				<div id="menucss2">
					<img src="images/cadenas_f16.png" width="16" height="16"><a href="authentification/authentification/index.php">Connexion</a>
					
					
			  </div>';
		}
	}
	
}
