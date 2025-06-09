<?php
/* Smarty version 4.5.5, created on 2025-06-03 20:54:39
  from '/opt/lampp/htdocs/smarty/templates/accueil.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_683f44efd09d64_69687777',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd37517ed442b975a9e198dff5bbeb32b12ece452' => 
    array (
      0 => '/opt/lampp/htdocs/smarty/templates/accueil.tpl',
      1 => 1748976876,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_683f44efd09d64_69687777 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Test Smarty + Bootstrap</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-primary"><?php if ($_smarty_tpl->tpl_vars['nom']->value == 'Yves') {?>
    <p>Bonjour Yves !</p>
<?php } else { ?>
    <p>Bonjour invité !</p>
<?php }?>
</h1>
        <button class="btn btn-success">Un bouton Bootstrap</button>
    </div>

    <!-- Bootstrap JS via CDN (optionnel, pour certains composants) -->
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
