<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/smarty/smarty/libs/Smarty.class.php';

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');

$smarty->assign('nom', 'Yves');
$smarty->assign('message', 'Bienvenue sur ta nouvelle page');
$smarty->display('accueil.tpl');

$fruits = ['Pomme', 'Banane', 'Cerise'];
$smarty->assign('fruits', $fruits);
$smarty->display('fruits.tpl');
