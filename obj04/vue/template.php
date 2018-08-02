<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=  $titre;  ?></title>
        <link rel="stylesheet" href="css/general.css" />
    </head>
    <body>
        <div id="principal">

            <header>
                <?= $enTete;  ?>
                <div id="menucss">
                    <ul>
                        <li>
                            <a href="index.php">Accueil</a>
                        </li>
                        <li><span class="titremenucss">Les articles</span>
                            <ul>
                                <li><a href="index.php?controleur=article&action=rechArticles&id=">Visualiser</a></li>
                            </ul>
                        </li>
                        <li><span class="titremenucss">Les clients</span>
                            <ul>
                                <li><a href="index.php?controleur=client&action=rechClients&id=">Rechercher</a></li>
                                <li><a href="#">Créer</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </header>

            <div id="contenu">
                <?= $contenu;  ?>
            </div>

            <div id="blocpied"></div>
        </div>

        <footer id="pied">
            Pied du document
        </footer>
    </body>
</html>
