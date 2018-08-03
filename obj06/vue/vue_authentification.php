<?php $this->titre = 'Authentification'; ?>
<?php $this->enTete = 'Authentification'; ?>

<div class="div500centre">
    <br /><br /><br /><br />
    <form method="post" action="index.php">
        <fieldset>
            <legend>Authentification</legend>
            <table id="tableau_authentification">
                <tr>
                    <input type="hidden" name="controleur" value="authentification">
                    <input type="hidden" name="action" value="authentification">
                    <input type="hidden" name="id" value="">
                    <td class="cellule_g">Nom : </td>
                    <td class="cellule_d"><input type="text" name="login" value="" size="30"></td>
                </tr>
                <tr>
                    <td class="cellule_g">Mot de passe : </td>
                    <td class="cellule_d"><input type="password" name="mdp" value="" size="30"></td>
                </tr>
                <tr align="center">
                    <td colspan="2">
                        <input type="submit" name="btvalid" value="Envoyer">
                    </td>
                </tr>
            </table>
        </fieldset>    
    </form>
</div>
