<?php

// Compteurs
$vehicules = Query::CRUD("SELECT COUNT(*) FROM vehicules")->fetchColumn();
$chauffeurs = Query::CRUD("SELECT COUNT(*) FROM chauffeurs")->fetchColumn();
$devise = Depense::keys()->encrypt("CDF");
$depensesCDF = Query::CRUD("SELECT SUM(montant) FROM depenses WHERE devise='$devise'")->fetchColumn();
$devise = Depense::keys()->encrypt("USD");
$depenseUSD = Query::CRUD("SELECT SUM(montant) FROM depenses WHERE devise='$devise'")->fetchColumn();
?>

<!-- Main Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Tableau de Bord</h2>
        <span class="text-muted">Aujourd'hui : <?= date('d/m/Y') ?></span>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Véhicules</h5>
                    <p class="fs-4"><?= $vehicules ?></p>
                    <a href="page-vehicule" class="btn btn-light btn-sm">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Chauffeurs</h5>
                    <p class="fs-4"><?= $chauffeurs ?></p>
                    <a href="page-chauffeurs" class="btn btn-light btn-sm">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Dépenses CDF</h5>
                    <p class="fs-4"><?= number_format($depensesCDF, 2, ',', ' ') ?> </p>
                    <a href="page-depense" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Dépenses USD</h5>
                    <p class="fs-4"><?= number_format($depenseUSD, 2, ',', ' ') ?> </p>
                    <a href="page-depense" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <canvas id="depenseChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <?php
    $sql = Depense::affichers("SELECT type_depense, SUM(montant) as montant FROM depenses GROUP BY type_depense");
    $labels = [];
    $data = [];
    if ($sql){
        foreach ($sql as $i){
            $labels[] = $i->getType();
            $data[] = $i->getMontant();
        }
    }
?>
    <script>
        const ctx = document.getElementById('depenseChart').getContext('2d');
        const depenseChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Total Dépenses ',
                    data: <?= json_encode($data) ?>, // Remplace par données PHP/AJAX
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#ffc107',
                        '#dc3545',
                        '#6f42c1'
                    ],
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Montant '
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Type de dépense'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Histogramme des Dépenses par Type',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    </script>