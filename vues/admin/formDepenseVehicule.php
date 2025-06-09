<div class="container mt-4">
    <h3>Formulaire dépense véhicule</h3>
<form id="depenseForm">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="type_depense" class="form-label">Type de Dépense</label>
            <select class="form-select" id="type_depense" name="type_depense" required>
                <option value="">Choisir...</option>
                <option value="piece">Pièce</option>
                <option value="carburant">Carburant</option>
                <option value="avance">Avance</option>
                <option value="emprunt">Emprunt</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="montant" class="form-label">Montant</label>
            <input type="number" step="0.01" class="form-control" id="montant" name="montant" required>
        </div>
        <div class="col-md-3">
            <label for="devise" class="form-label">Devise</label>
           <select class="form-control" name="devise" id="devise" required>
               <option value="">Veuillez selectionner une devise svp</option>
               <option value="USD">USD</option>
               <option value="CDF">CDF</option>
           </select>
        </div>
        <div class="col-md-6">
            <label for="date_depense" class="form-label">Date</label>
            <input type="date" class="form-control" id="date_depense" name="date_depense" required>
        </div>

        <div class="col-md-6">
            <label for="vehicule_id" class="form-label">Véhicule</label>
            <select class="form-select" id="vehicule_id" name="vehicule_id" required>
                <option value="">Veuillez selectionner un véhicule svp</option>
               <?php
               $vehicule = Vehicule::affichers("SELECT * FROM vehicules");
               if ($vehicule){
                   foreach ($vehicule as $i){ ?>
                       <option value="<?=$i->getId()?>"><?=$i->getImmatriculation()?></option>
                 <?php  }
               }


               ?>
            </select>
        </div>

        </div>
        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="2"></textarea>
        </div>
    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
    <div id="depenseMessage" class="mt-3"></div>
    </div>

</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#depenseForm').on('submit', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'data.html',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $('#depenseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#depenseForm')[0].reset();
                    } else {
                        $('#depenseMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
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