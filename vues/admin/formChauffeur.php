<div class="container mt-4">
    <h3>Ajouter un agent</h3>
    <form  id="chauffeurForm">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="salaire_mensuel" class="form-label">Fonction</label>
                <select name="fonction" id="fonction" class="form-control" required>
                    <option value="">Veuillez selectionner la fonction svp</option>
                    <option value="Chauffeur">Chauffeur</option>
                    <option value="Mecanicien">Mecanicien</option>
                    <option value="Laveur">Laveur</option>
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
        <div id="vehiculeMessage" class="mt-3"></div>

    </form>


</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#chauffeurForm').on('submit', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'data.html',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $('#vehiculeMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#chauffeurForm')[0].reset();
                    } else {
                        $('#vehiculeMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Erreur AJAX : ' + error);
                    console.log(xhr.responseText); // Pour debug
                }
            });
        });
    });
</script>