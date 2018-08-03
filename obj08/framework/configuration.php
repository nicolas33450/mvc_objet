<?php
class Configuration 
{
    // Tableau qui contient le paramétrage de la forme
    // [hote] => localhost [bdd] => basemvc [util] => root [mdp] =>
    // Ce tableau est (unique -> static) dans la classe
    // On met le signe souligné (_) pour indiquer que la propriété est privée (Convention)
    private static $_params;

    // Méthode privée qui retourne le tableau des paramètres récupérés dans un fichier .ini
    // Si le tableau n'existe pas, on recherche les fichiers de configuration(.ini)
    private static function getConfig() 
    {
        // Si le tableau de configuration n'existe pas
        if (self::$_params == null) 
        {
            // Définit le chemin au fichier de configuration de production
            $cheminFichier = "config/prod.ini";

            // Si le fichier prod.ini n'existe pas, on recherche le fichier de développement dev.ini
            if (!file_exists($cheminFichier)) 
            {
                // Définit le chemin au fichier de développement dev.ini
                $cheminFichier = "config/dev.ini";
            }
            if (!file_exists($cheminFichier)) 
            {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else 
            {
                // Affecte à la variable de classe $param le contenu du fichier 
                // sous forme de tableau
                self::$_params = parse_ini_file($cheminFichier);
            }
        }
        return self::$_params;
    }

    // Renvoie la valeur d'un paramètre de configuration
    public static function getParam($nom, $valeur=null) 
    {
        // Si l'indice $nom existe 
        if (isset(self::getConfig()[$nom])) 
        {
            $p = self::getConfig()[$nom];
        }
        else 
        {
            $p = $valeur;
        }
        return $p;
    }
}
