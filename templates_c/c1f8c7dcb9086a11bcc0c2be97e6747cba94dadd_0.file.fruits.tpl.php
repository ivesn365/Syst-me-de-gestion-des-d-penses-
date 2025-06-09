<?php
/* Smarty version 4.5.5, created on 2025-06-03 20:53:38
  from '/opt/lampp/htdocs/smarty/templates/fruits.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_683f44b2922382_02894964',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1f8c7dcb9086a11bcc0c2be97e6747cba94dadd' => 
    array (
      0 => '/opt/lampp/htdocs/smarty/templates/fruits.tpl',
      1 => 1748976810,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_683f44b2922382_02894964 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header></header>
    <main>
      <ul>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fruits']->value, 'fruit');
$_smarty_tpl->tpl_vars['fruit']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fruit']->value) {
$_smarty_tpl->tpl_vars['fruit']->do_else = false;
?>
        <li><?php echo $_smarty_tpl->tpl_vars['fruit']->value;?>
</li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>

    </main>
    <footer></footer>
  </body>
</html>
<?php }
}
