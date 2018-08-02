<?php

class CtrlAccueil
{
    function defaut()
    {
        try
        {
            // On utilise la classe vue pour accueil
            $vue = new Vue('accueil');
            $vue->afficher();
        }
        catch (Exception $e)
        {
            $vue = new Vue('erreur');
            $vue->afficher(array('messErreur' => $e->getMessage(), 'codeErreur' => $e->getCode()));
        }
    }
}
