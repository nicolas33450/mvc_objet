<?php $this->titre = 'Création client'; ?>

<?php $this->enTete = 'Création client'; ?>

<div class="div500">
    <h1>Création client</h1>

    <br />
    Les champs suivis d'une étoile <span class="rouge">*</span> sont obligatoires.
    <br />
    <form method="POST" action="index.php">

        <table id="cadreajoutcli" >
            <tr>
                <input type="hidden" name="controleur" value="client">
                <input type="hidden" name="action" value="creaClient">
                <input type="hidden" name="id" value="">

                <td width="30%">Nom : </td>
                <td width="70%"><input type="text" name="nom" size="30" value="<?php echo $n; ?>"/> <span class="rouge">*</span></td>
            </tr>
            <tr>      
                <td width="30%">Prénom : </td>
                <td width="70%"><input type="text" name="prenom" size="30" value="<?php echo $p; ?>"> <span class="rouge">*</span></td>
            </tr>
            <tr>    
                <td width="30%">Adresse 1 : </td>
                <td width="70%"><input type="text" name="adr1" size="30" value="<?php echo $a1; ?>" /> <span class="rouge">*</span></td>
            </tr>
            <tr>
                <td width="30%">Adresse 2 :</td>
                <td width="70%"><input type="text" name="adr2" size="30" value="<?php echo $a2; ?>" /></td>
            </tr>
            <tr>
                <td width="30%">CP : </td>
                <td width="70%"><input type="text" name="cp" size="5" value="<?php echo $cp; ?>" /> <span class="rouge">*</span></td>
            </tr>
            <tr>
                <td width="30%">Ville : </td>
                <td width="70%"><input type="text" name="ville" size="30" value="<?php echo $v; ?>" /> <span class="rouge">*</span></td>
            </tr>
            <tr>
                <td width="30%">email : </td>
                <td width="70%"><input type="text" name="email" size="30" value="<?php echo $e; ?>" /> <span class="rouge">*</span></td>
            </tr>
            <tr>
                <td width="100%" colspan="2">
                    <p align="center">
                        <input type="submit" value="Créer" name="creacli" />
                    </p>
                </td>
            </tr>
        </table>
        <div>
            <?php echo $message; ?>
        </div>
    </form>
</div>