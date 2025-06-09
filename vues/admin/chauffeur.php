<div class="row g-4">
    <div class="col-md-12">
<h5 class="mt-4">Liste des chauffeurs</h5>
        <a class="btn btn-primary" href="page-fromChauffeur" style="margin-bottom: 5px">Formulaire</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
    <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Fonction</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $chauffeur = Chauffeur::affichers("SELECT * FROM chauffeurs");
    if($chauffeur){
        $j = 1;
        foreach ($chauffeur as $i){ ?>
            <tr>
                <td><?=$j++?></td>
                <td><?=$i->getNom()?></td>
                <td><?=$i->getPrenom()?></td>
                <td><?=$i->getTelephone()?></td>
                <td><?=$i->getFonction()?></td>
                <td>
                    <button class="btn btn-sm btn-warning">Modifier</button>
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </td>
            </tr>

       <?php }
    }
    ?>

    </tbody>
</table>
    </div>
