<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);*/
require_once ("../header.php");
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['username'],$_POST['password'])){
        $username = Users::key()->encrypt(Query::securisation($_POST['username']));
        $password = md5(Query::securisation($_POST['password']));
        $users = Users::afficher("SELECT * FROM users WHERE username='$username' AND password='$password'");
        if ($users && $users->getRole()){
            $_SESSION['sys_role_user'] = $users->getRole();
            $_SESSION['sys_pseudo_user'] = $users->getUsername();
            $_SESSION['sys_id_user'] = $users->getId();
            echo  json_encode(["success" => true, "message" => "Succès."]);
        }else echo json_encode(["success" => false, "message" => "Identifiants incorrects"]);;
    }
    if ($_SESSION['sys_role_user']) {
        if (
            isset(
                $_POST['marque'],
                $_POST['modele'],
                $_POST['immatriculation'],
                $_POST['date_achat'])
        ) {
            echo json_encode(["success" => true, "message" => "Véhicule enregistré avec succès."]);
            $key = Vehicule::keys();
            $marque = $key->encrypt(Query::securisation($_POST['marque']));
            $modele = $key->encrypt(Query::securisation($_POST['modele']));
            $immatriculation = $key->encrypt(Query::securisation($_POST['immatriculation']));
            $date_achat = (Query::securisation($_POST['date_achat']));

            $vehicule = (new Vehicule(null, $marque, $modele, $immatriculation, $date_achat, 1, null))->ajouter();
            if ($vehicule) echo json_encode(["success" => true, "message" => "Véhicule enregistré avec succès."]);
            else echo json_encode(["success" => false, "message" => "Veuillez réessayer"]);

        }
        elseif (isset($_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['fonction'])) {
            $key = Chauffeur::keys();
            $nom = $key->encrypt(Query::securisation($_POST['nom']));
            $prenom = $key->encrypt(Query::securisation($_POST['prenom']));
            $telephone = $key->encrypt(Query::securisation($_POST['telephone']));
            $fonction = $key->encrypt(Query::securisation($_POST['fonction']));

            $chauffeur = (new Chauffeur(null, $nom, $prenom, $fonction, $telephone, 0, 1, null))->ajouter();
            if ($chauffeur) echo json_encode(["success" => true, "message" => "L'agent enregistré avec succès."]);
            else echo json_encode(["success" => false, "message" => "Veuillez réessayer"]);
        }
        elseif (isset($_POST['type_depense'],
            $_POST['montant'],
            $_POST['date_depense'],
            $_POST['vehicule_id'],
            $_POST['description'])) {
            $key = Depense::keys();
            $type = $key->encrypt(Query::securisation($_POST['type_depense']));
            $devise = $key->encrypt(Query::securisation($_POST['devise']));
            $description = $key->encrypt(Query::securisation($_POST['description']));
            $montant = Query::securisation($_POST['montant']);
            $date_depense = Query::securisation($_POST['date_depense']);
            $vehicule_id = Query::securisation($_POST['vehicule_id']);

            $depense = (new Depense(null, $type, $montant, $description, $date_depense, $vehicule_id, 0, $_SESSION['sys_id_user'], null, $devise))->ajouter();
            if ($depense) echo json_encode(["success" => true, "message" => "La dépense enregistrée avec succès."]);
            else echo json_encode(["success" => false, "message" => "Veuillez réessayer"]);
        } elseif (isset($_POST['type_depense'],
            $_POST['montant'],
            $_POST['date_depense'],
            $_POST['agent_id'],
            $_POST['description'])) {
            $key = Depense::keys();
            $type = $key->encrypt(Query::securisation($_POST['type_depense']));
            $devise = $key->encrypt(Query::securisation($_POST['devise']));
            $description = $key->encrypt(Query::securisation($_POST['description']));
            $montant = Query::securisation($_POST['montant']);
            $date_depense = Query::securisation($_POST['date_depense']);
            $agent_id = Query::securisation($_POST['agent_id']);

            $depense = (new Depense(null, $type, $montant, $description, $date_depense, 0, $agent_id, $_SESSION['sys_id_user'], null, $devise))->ajouter();
            if ($depense) echo json_encode(["success" => true, "message" => "La dépense enregistrée avec succès."]);
            else echo json_encode(["success" => false, "message" => "Veuillez réessayer"]);
        } elseif (isset($_POST['type_depense'],
            $_POST['montant'],
            $_POST['date_depense'],
            $_POST['description'])) {
            $key = Depense::keys();
            $type = $key->encrypt(Query::securisation($_POST['type_depense']));
            $devise = $key->encrypt(Query::securisation($_POST['devise']));
            $description = $key->encrypt(Query::securisation($_POST['description']));
            $montant = Query::securisation($_POST['montant']);
            $date_depense = Query::securisation($_POST['date_depense']);

            $depense = (new Depense(null, $type, $montant, $description, $date_depense, 0, 0, $_SESSION['sys_id_user'], null, $devise))->ajouter();
            if ($depense) echo json_encode(["success" => true, "message" => "La dépense enregistrée avec succès."]);
            else echo json_encode(["success" => false, "message" => "Veuillez réessayer"]);
        } elseif (isset($_POST["btn_new_user"])) {
            $pseudo = Users::key()->encrypt(Query::securisation($_POST['nom_users']));
            $role = Users::key()->encrypt("AUTRE_ROLE_SYS");
            $password = md5("12345");
            (new Users(null, $pseudo, $password, $role, 1))->ajouter();
           header("Location:../page-users");
        }
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['logout'])){
        session_destroy();
        header("Location:login.html");
    }
}