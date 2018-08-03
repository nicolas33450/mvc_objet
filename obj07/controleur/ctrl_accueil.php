<?php

require_once 'framework/controleur.php';
class CtrlAccueil extends Controleur
{
    function defaut($args=null)
    {
        try
        {
            // On utilise la classe vue pour accueil
            $vue = new Vue('accueil');
            $vue->afficher(array());
        }
        catch (Exception $e)
        {
            $vue = new Vue('erreur');
            $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
        }

    }

}
