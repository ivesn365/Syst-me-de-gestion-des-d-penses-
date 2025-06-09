<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="col-xl-12 col-md-12">

    <h2 class="text-center mb-4">Liste des utilisateurs</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVehicule">
        Ajouter un utilisateur
    </button>
    <div class="modal fade" id="modalVehicule" tabindex="-1" aria-labelledby="modalVehiculeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="data.html" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalVehiculeLabel">Ajouter un utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom_users" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="nom_users" name="nom_users" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success" name="btn_new_user">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    $users = Users::afficher2("SELECT * FROM users WHERE id!=5");
    if ($users){ ?>
        <!-- Barre de recherche -->
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher un produit...">

        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
            <tr>
                <th onclick="sortTable(0)"># 🔽</th>
                <th onclick="sortTable(1)">Nom d'utilisateur 🔽</th>
                <th onclick="sortTable(2)">Rôle 🔽</th>
                <th hidden>Action</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php
            $j = 1;
            foreach ($users as $i){
                ?>
                <tr>
                    <td><?=$j++?></td>
                    <td><?=$i->getUsername()?></td>
                    <td><?php
                       if("AUTRE_ROLE_SYS" == $i->getRole()) echo 'Utilisateur';
                       ?></td>
                    <td hidden><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Modifier</button></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?>
        <div class="alert alert-danger">Aucune information trouvée pour le moment</div>
    <?php }

    ?>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Tri des colonnes
    function sortTable(n) {
        var table = document.querySelector("table");
        var rows = Array.from(table.rows).slice(1);
        var sortedRows = rows.sort((rowA, rowB) => {
            var cellA = rowA.cells[n].innerText.trim();
            var cellB = rowB.cells[n].innerText.trim();
            return isNaN(cellA) ? cellA.localeCompare(cellB) : cellA - cellB;
        });

        sortedRows.forEach(row => table.appendChild(row));
    }

    // Recherche instantanée
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

        $(document).ready(function () {
        $('#formUsers').on('submit', function (e) {
            e.preventDefault();
            alert("oiffu")
            $.ajax({
                url: 'data.html',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    alert('Véhicule enregistré avec succès !');
                    $('#modalVehicule').modal('hide');
                    $('#formUsers')[0].reset();
                    location.reload()
                    // Optionnel : rafraîchir le tableau
                },
                error: function(xhr, status, error) {
                    alert('Erreur AJAX : ' + error);
                    console.log(xhr.responseText); // Pour debug
                }
            });
        });
    });
</script>

