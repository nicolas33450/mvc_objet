<?php

class Verification

{   
    //====================
    //verif adresse mail
    //====================
    public function verifierAdresseMail($adresse)
    {
        $expression="/^([a-zA-Z0-9]+(([\.\-\_]?[a-zA-Z0-9]+)+)?)\@(([a-zA-Z0-9]+[\.\-\_])*[a-zA-Z0-9]+\.[a-zA-Z]{2,})$/";

        if(preg_match($expression, $adresse))
        {
            // Adresse  Valide
            return true;  
        }
        else
        {
            // Adresse erronée
            return false;  
        }
    }
    //====================
    // verif code postal
    //====================
    public function verifierCp($cp)
    {
        $expression="/^([0-9]{5})$/";

        if(preg_match($expression, $cp))
        {
            // CP  Valide
            return true;  
        }
        else
        {
            // CP erronée
            return false;  
        }
    }
    //==================
    //verif code entier
    //==================
    public function verifierEntier($nb, $qte=5)
    {
        $expression="/^([0-9]{" . $qte .  "})$/";

        if(preg_match($expression, $nb))
        {
            // Entier  Valide
            return true;  
        }
        else
        {
            // Entier erronée
            return false;  
        }
    }


}


?>
