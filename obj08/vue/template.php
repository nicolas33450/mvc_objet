<!doctype html>
<base href="<?php echo $cheminSite ?>" >
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php  echo  $titre;  ?></title>
        <link rel="stylesheet" href="css/general.css" />
    </head>
    <body>

        <div id="principal">

            <header>
                <?php  echo  $enTete;  ?>
                <?php  echo $menuCSS; ?>
            </header>

            <div id="contenu">
                <?php  echo  $contenu;  ?>
            </div>
            <div id="blocpied"></div>
        </div>
        <footer id="pied">
            Pied du document XXXXXX
        </footer>
    </body>
</html>
