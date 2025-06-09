<?php
require_once ('header.php');
if($_SESSION['sys_role_user']){

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="manifest" href="/manifest.json">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
        }

        .sidebar .nav-link.active {
            background-color: #495057;
        }

        .card {
            border: none;
        }

        .dashboard-card {
            color: white;
        }

        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                width: 200px;
                left: -200px;
                transition: left 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 100vw;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
<div class="overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
<div class="container-fluid">
    <?php
    if ($_SESSION['sys_role_user'] == 'admin'){
    ?>
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar px-3 py-4" id="sidebarMenu">
            <h5 class="text-white mb-4">Admin | IHS-RDC</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="page-accueil"><i class="bi bi-speedometer2 me-2"></i> Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page-vehicule"><i class="bi bi-truck me-2"></i> Véhicules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page-chauffeurs"><i class="bi bi-person-badge me-2"></i> Chauffeurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page-depense"><i class="bi bi-cash-coin me-2"></i> Dépenses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page-users"><i class="bi bi-person-badge me-2"></i> Utilisateur</a>
                </li>
                <li class="nav-item">
                    <a href="data.html?logout=true" class="nav-link text-white">
                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                    </a>
                </li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
            <button class="btn btn-outline-dark d-md-none mb-3" onclick="toggleSidebar()">
                <i class="bi bi-list"></i> Menu
            </button>
            <div class="container-fluid">
                <button id="installBtn" style="display:none;">Installer l'application</button>


                <?php
    if(isset($_GET['index'])){
        if ($_GET['index'] == 'accueil') include_once ("vues/admin/accueil.php");
        elseif ($_GET['index'] == 'vehicule') include_once ("vues/admin/vehicule.php");
        elseif ($_GET['index'] == 'formVehicule') include_once ("vues/admin/formVehicule.php");
        elseif ($_GET['index'] == 'chauffeurs') include_once ("vues/admin/chauffeur.php");
        elseif ($_GET['index'] == 'fromChauffeur') include_once ("vues/admin/formChauffeur.php");
        elseif ($_GET['index'] == 'depense') include_once ("vues/admin/depense.php");
        elseif ($_GET['index'] == 'formDepenseAgent') include_once ("vues/admin/formDepenseChauffeur.php");
        elseif ($_GET['index'] == 'formDepenseVehicule') include_once ("vues/admin/formDepenseVehicule.php");
        elseif ($_GET['index'] == 'formDepenseAutre') include_once ("vues/admin/formDepense.php");
        elseif ($_GET['index'] == 'users') include_once ("vues/admin/users.php");
        else include_once ("vues/admin/accueil.php");

    }else include_once ("vues/admin/accueil.php");

    ?>

                <a href="javascript:history.back()" class="btn btn-outline-secondary mt-3">
                    ⬅ Retour
                </a>

    <footer class="text-center mt-5 text-muted">
        <small>&copy; <?= date('Y') ?> - Gestion des dépenses | Tous droits réservés | produit par <a href="https://ihs-rdc.com/">IHS-RDC</a></small>
    </footer>
            </div>
        </main>
</div>
    <?php }elseif ($_SESSION['sys_role_user'] == 'AUTRE_ROLE_SYS'){ ?>
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar px-3 py-4" id="sidebarMenu">
                <h5 class="text-white mb-4">Admin | IHS-RDC</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="page-accueil"><i class="bi bi-speedometer2 me-2"></i> Tableau de bord</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="page-depense"><i class="bi bi-cash-coin me-2"></i> Dépenses</a>
                    </li>
                    <li class="nav-item">
                        <a href="data.html?logout=true" class="nav-link text-white">
                            <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <button class="btn btn-outline-dark d-md-none mb-3" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i> Menu
                </button>
                <div class="container-fluid">
                    <button id="installBtn" style="display:none;">Installer l'application</button>


                    <?php
                    if(isset($_GET['index'])){
                        if ($_GET['index'] == 'accueil') include_once ("vues/admin/depense.php");
                        elseif ($_GET['index'] == 'vehicule') include_once ("vues/admin/vehicule.php");
                        elseif ($_GET['index'] == 'formVehicule') include_once ("vues/admin/formVehicule.php");
                        elseif ($_GET['index'] == 'chauffeurs') include_once ("vues/admin/chauffeur.php");
                        elseif ($_GET['index'] == 'fromChauffeur') include_once ("vues/admin/formChauffeur.php");
                        elseif ($_GET['index'] == 'depense') include_once ("vues/admin/depense.php");
                        elseif ($_GET['index'] == 'formDepenseAgent') include_once ("vues/admin/formDepenseChauffeur.php");
                        elseif ($_GET['index'] == 'formDepenseVehicule') include_once ("vues/admin/formDepenseVehicule.php");
                        elseif ($_GET['index'] == 'formDepenseAutre') include_once ("vues/admin/formDepense.php");
                        elseif ($_GET['index'] == 'users') include_once ("vues/admin/users.php");
                        else include_once ("vues/admin/depense.php");

                    }else include_once ("vues/admin/depense.php");

                    ?>
                    <a href="javascript:history.back()" class="btn btn-outline-secondary mt-3">
                        ⬅ Retour
                    </a>


                    <footer class="text-center mt-5 text-muted">
                        <small>&copy; <?= date('Y') ?> - Gestion des dépenses | Tous droits réservés | produit par <a href="https://ihs-rdc.com/">IHS-RDC</a></small>
                    </footer>
                </div>
            </main>
        </div>
  <?php
    }else header("Location:login.html");
    ?>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    }


        let deferredPrompt;
        const installBtn = document.getElementById('installBtn');

        window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        installBtn.style.display = 'block';
    });

        installBtn.addEventListener('click', () => {
        installBtn.style.display = 'none';
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
        if (choiceResult.outcome === 'accepted') {
        console.log('L\'utilisateur a accepté l\'installation');
    } else {
        console.log('L\'utilisateur a refusé l\'installation');
    }
        deferredPrompt = null;
    });
    });
    document.addEventListener("DOMContentLoaded", function () {
        // Créer dynamiquement l'élément du spinner
        const spinner = document.createElement("div");
        spinner.id = "loading-spinner";
        spinner.innerHTML = `
    <div style="
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    ">
      <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Chargement...</span>
      </div>
    </div>
  `;
        spinner.style.display = "none";
        document.body.appendChild(spinner);

        // Affiche le spinner lors du clic sur un lien
        document.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", function (e) {
                const href = link.getAttribute("href");
                if (href && !href.startsWith("#") && !href.startsWith("javascript:") && !link.hasAttribute("target")) {
                    spinner.style.display = "block";
                }
            });
        });

        // Masque le spinner quand la page s'affiche
        window.addEventListener("pageshow", function () {
            spinner.style.display = "none";
        });
    });
</script>

</script>

</body>
</html>
<?php }else header("Location:login.html");?>
