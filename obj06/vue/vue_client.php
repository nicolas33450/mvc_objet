<?php $this->titre = 'Contenu de la table clients'; ?>
<?php $this->enTete = 'Gestion clients'; ?>

<div id="rechclient">
    <!-- <form method="get" action="index.php?controleur=client&action=rechClients&id=">-->

    <form method="post" action="index.php">
        <input type="hidden" name="controleur" value="client">
        <input type="hidden" name="action" value="rechClients">
        <input type="hidden" name="id" value="">
        Nom : <input type="text" name="nom" value="<?php echo $nom; ?>"><br />
        Ville : <input type="text" name="ville" value="<?php echo $ville; ?>"><br />
        <input type="submit" name="rechcli" value="Rechercher">
    </form>
</div>

<h1>Liste des clients</h1>

<table id="tableau">
    <tr>
        <th>N°</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>CP</th>
        <th>Ville</th>
        <th>Email</th>
    </tr>

    <?php
    // On boucle pour traiter tous les clients
    foreach ($listeClients as $ligne_tab){
    ?>
    <tr>
        <td><?php echo $ligne_tab['n_cli']; ?></td>
        <td><?php echo $ligne_tab['nom_cli']; ?></td>
        <td><?php echo $ligne_tab['prenom_cli']; ?></td>
        <td><?= $ligne_tab['cp_cli'] ?></td>
        <td><?= $ligne_tab['ville_cli'] ?></td>
        <td><?= $ligne_tab['email_cli'] ?></td>
    </tr>
    <?php
    }
    ?>
</table>
