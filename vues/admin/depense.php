
<div class="container mt-5">
    <h2 class="mb-4 text-center">Liste des Dépenses</h2>
    <a class="btn btn-danger" href="page-formDepenseAgent" style="margin-bottom: 5px">Formulaire agent</a>
    <a class="btn btn-primary" href="page-formDepenseVehicule" style="margin-bottom: 5px">Formulaire véhicule</a>
    <a class="btn btn-info" href="page-formDepenseAutre" style="margin-bottom: 5px">Formulaire Autre</a>
    <div class="accordion" id="accordionDepenses">

        <div class="accordion" id="accordionDepenses">

            <!-- Dépenses Véhicule -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="vehiculeHeading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#vehiculeCollapse" aria-expanded="true">
                        Dépenses liées aux Véhicules
                    </button>
                </h2>
                <div id="vehiculeCollapse" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table id="tableVehicules" class="table table-striped table-hover">
                                <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Immatriculation</th>
                                    <th>Type</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($_SESSION['sys_role_user'] == 'admin') {
                                    $depense = Depense::affichers("SELECT * FROM `depenses` WHERE `vehicule_id`!=0 ORDER BY id_depense DESC");
                                }else{
                                    $idUser = $_SESSION['sys_id_user'];
                                    $depense = Depense::affichers("SELECT * FROM `depenses` WHERE `vehicule_id`!=0  AND statut='$idUser' ORDER BY id_depense DESC");
                                }
                                if ($depense){
                                    $j = 1;
                                    foreach ($depense as $i){
                                        $vehicule_id = $i->getVehiculeId();
                                        ?>
                                        <tr>
                                           <td><?=$j++?></td>
                                           <td><?=Vehicule::afficher("SELECT * FROM vehicules WHERE id_vehicule='$vehicule_id'")->getImmatriculation()?></td>
                                           <td><?=$i->getType() ?></td>
                                           <td><?=$i->getDevise()?> <?=$i->getMontant()?></td>
                                           <td><?=$i->getDate()?></td>
                                           <td><?=$i->getDescription()?></td>
                                        </tr>
                                   <?php }
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dépenses Chauffeur -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="chauffeurHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#chauffeurCollapse" aria-expanded="false">
                        Dépenses liées aux Agents
                    </button>
                </h2>
                <div id="chauffeurCollapse" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table id="tableChauffeurs" class="table table-striped table-hover">
                                <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Chauffeur</th>
                                    <th>Type</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($_SESSION['sys_role_user'] == 'admin') {
                                    $depense = Depense::affichers("SELECT * FROM `depenses` WHERE `chauffeur_id`!=0 ORDER BY id_depense DESC");
                                }else{
                                    $idUser = $_SESSION['sys_id_user'];
                                    $depense = Depense::affichers("SELECT * FROM `depenses` WHERE `chauffeur_id`!=0 AND statut='$idUser' ORDER BY id_depense DESC");

                                }
                                if ($depense){
                                    $j = 1;
                                    foreach ($depense as $i){
                                        $chauffeur_id = $i->getChauffeurId();
                                        $chauffeur = Chauffeur::afficher("SELECT * FROM chauffeurs WHERE id_chauffeur='$chauffeur_id'");
                                        ?>
                                        <tr>
                                            <td><?=$j++?></td>
                                            <td><?=$chauffeur->getNom().' '.$chauffeur->getPrenom()?></td>
                                            <td><?=$i->getType() ?></td>
                                            <td><?=$i->getDevise()?> <?=$i->getMontant()?></td>
                                            <td><?=$i->getDate()?></td>
                                            <td><?=$i->getDescription()?></td>
                                        </tr>
                                    <?php }
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Autres Dépenses -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="autreHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#autreCollapse" aria-expanded="false">
                        Autres Dépenses
                    </button>
                </h2>
                <div id="autreCollapse" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table id="tableAutres" class="table table-striped table-hover">
                                <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($_SESSION['sys_role_user'] == 'admin') {
                                    $depense = Depense::affichers("SELECT * FROM `depenses` WHERE `chauffeur_id`=0 AND `vehicule_id`=0 ORDER BY id_depense DESC");
                                }else{
                                    $idUser = $_SESSION['sys_id_user'];
                                    $depense = Depense::affichers("SELECT * FROM `depenses` WHERE `chauffeur_id`=0 AND `vehicule_id`=0 AND statut='$idUser' ORDER BY id_depense DESC");
                                }
                                if ($depense){

                                    $j = 1;
                                    foreach ($depense as $i){
                                        ?>
                                        <tr>
                                            <td><?=$j++?></td>
                                            <td><?=$i->getType() ?></td>
                                            <td><?=$i->getDevise()?> <?=$i->getMontant()?></td>
                                            <td><?=$i->getDate()?></td>
                                            <td><?=$i->getDescription()?></td>
                                        </tr>
                                    <?php }
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#tableVehicules').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                }
            });

            $('#tableChauffeurs').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                }
            });

            $('#tableAutres').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                }
            });
        });
    </script>



