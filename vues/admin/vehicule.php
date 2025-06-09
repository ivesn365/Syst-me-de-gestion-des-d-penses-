<div class="row g-4">
    <div class="col-lg-12">
<h5 class="mt-4">Liste des véhicules</h5>
        <a class="btn btn-primary" href="page-formVehicule" style="margin-bottom: 5px">Formulaire</a>
        <div class="table-responsive">
<table class="table table-bordered table-striped">
    <thead class="table-dark">
    <tr>
        <th>#</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Immatriculation</th>
        <th>Date d'achat</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $vehicule = Vehicule::affichers("SELECT * FROM vehicules");
    if ($vehicule){
        $j = 1;
        foreach ($vehicule as $i){ ?>
            <tr>
            <td><?=$j++?></td>
            <td><?=$i->getMarque()?></td>
            <td><?=$i->getModele()?></td>
            <td><?=$i->getImmatriculation()?></td>
            <td><?=$i->getDateAchat()?></td>
            <td>-</td>
        </tr>


       <?php }
    }

    ?>

    </tbody>
</table>
    </div>
</div>
</div>