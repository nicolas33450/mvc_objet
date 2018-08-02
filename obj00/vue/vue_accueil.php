<?php $titre = 'Accueil'; ?>
<?php $enTete = 'Accueil'; ?>

<?php ob_start(); ?>
<br /><br />
<img src="image/logo.jpeg" width="800" height="470" />

<?php $contenu = ob_get_clean(); ?>
<?php require 'template.php'; ?>
