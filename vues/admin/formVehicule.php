<div class="container mt-4">
    <h3>Ajouter un véhicule</h3>
    <form id="vehiculeForm">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="marque" class="form-label">Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="modele" class="form-label">Modèle</label>
                <input type="text" class="form-control" id="modele" name="modele" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="immatriculation" class="form-label">Immatriculation</label>
                <input type="text" class="form-control" id="immatriculation" name="immatriculation" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="date_achat" class="form-label">Date d'achat</label>
                <input type="date" class="form-control" id="date_achat" name="date_achat" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <div id="vehiculeMessage" class="mt-3"></div>
    </form>
</div>
<!-- jQuery CDN (si pas déjà inclus) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#vehiculeForm').on('submit', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'data.html',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $('#vehiculeMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#vehiculeForm')[0].reset();
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

