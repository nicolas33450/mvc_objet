<?php $titre = 'Page Erreur'; ?>

<?php $enTete = 'Gestion des erreurs'; ?>

<?php ob_start(); ?>

Erreur : <?php echo $messErreur ?>
<br />Code erreur : <?php echo $codeErreur; ?>

<?php $contenu = ob_get_clean(); ?>

<?php require 'template.php'; ?>
