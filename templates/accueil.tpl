<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Test Smarty + Bootstrap</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-primary">{if $nom == 'Yves'}
    <p>Bonjour Yves !</p>
{else}
    <p>Bonjour invité !</p>
{/if}
</h1>
        <button class="btn btn-success">Un bouton Bootstrap</button>
    </div>

    <!-- Bootstrap JS via CDN (optionnel, pour certains composants) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
