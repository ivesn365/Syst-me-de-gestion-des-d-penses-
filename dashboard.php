<?php
// dashboard.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/vendor/smarty/smarty/libs/Smarty.class.php';
require_once 'header.php';

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');

// Récupération des données globales
$totalVehicules = Query::CRUD("SELECT COUNT(*) as total FROM vehicules")->fetch(PDO::FETCH_OBJ)->total;
$totalChauffeurs = Query::CRUD("SELECT COUNT(*) as total FROM chauffeurs")->fetch(PDO::FETCH_OBJ)->total;
$totalDepenses = Query::CRUD("SELECT SUM(montant) as total FROM depenses")->fetch(PDO::FETCH_OBJ)->total;
$totalDepensesPayees = Query::CRUD("SELECT SUM(montant) as total FROM depenses WHERE statut = 'payée'")->fetch(PDO::FETCH_OBJ)->total;
$totalRemboursements = Query::CRUD("SELECT SUM(montant_rembourse) as total FROM remboursements")->fetch(PDO::FETCH_OBJ)->total;

// Récupération des dépenses par type
$stmt = Query::CRUD("SELECT type_depense, SUM(montant) as total FROM depenses GROUP BY type_depense");
$depensesParType = [];
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    $depensesParType[$row->type_depense] = floatval($row->total);
}

// Préparer pour JS : labels et data
$labels = json_encode(array_keys($depensesParType));
$data = json_encode(array_values($depensesParType));

// Assignation des variables à Smarty
$smarty->assign('totalVehicules', intval($totalVehicules));
$smarty->assign('totalChauffeurs', intval($totalChauffeurs));
$smarty->assign('totalDepenses', $totalDepenses ?? 0);
$smarty->assign('totalDepensesPayees', $totalDepensesPayees ?? 0);
$smarty->assign('totalRemboursements', $totalRemboursements ?? 0);
$smarty->assign('depenseLabels', $labels);
$smarty->assign('depenseData', $data);

// Affichage du template
$smarty->display('dashboard.tpl');
