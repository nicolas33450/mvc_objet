<?php $this->titre = 'Contenu de la table articles'; ?>
<?php $this->enTete = 'Gestion articles'; ?>

<h1>Liste des articles</h1>

<table id="tableau">
    <tr>
        <th>N°</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
    </tr>

    <?php
    // On boucle pour traiter tous les articles
    foreach ($listeArticles as $ligne_tab){
    ?>
    <tr>
        <td><?php echo $ligne_tab['n_art']; ?></td>
        <td><?php echo $ligne_tab['nom_art']; ?></td>
        <td><?php echo $ligne_tab['descr_art']; ?></td>
        <td><?php echo $ligne_tab['prix_art']; ?></td>
    </tr>
    <?php
    }
    ?>
</table>
