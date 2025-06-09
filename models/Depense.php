<?php
class Depense {
    private $id;
    private $type;
    private $montant;
    private $description;
    private $date;
    private $vehicule_id;
    private $chauffeur_id;
    private $statut;
    private $date_creation;
    private $devise;

    /**
     * @param $id
     * @param $type
     * @param $montant
     * @param $description
     * @param $date
     * @param $vehicule_id
     * @param $chauffeur_id
     * @param $statut
     * @param $date_creation
     * @param $devise
     */
    public function __construct($id, $type, $montant, $description, $date, $vehicule_id, $chauffeur_id, $statut, $date_creation, $devise)
    {
        $this->id = $id;
        $this->type = $type;
        $this->montant = $montant;
        $this->description = $description;
        $this->date = $date;
        $this->vehicule_id = $vehicule_id;
        $this->chauffeur_id = $chauffeur_id;
        $this->statut = $statut;
        $this->date_creation = $date_creation;
        $this->devise = $devise;
    }


    public function getId() { return $this->id; }
    public function getType() { return $this->type; }
    public function getMontant() { return $this->montant; }
    public function getDescription() { return $this->description; }
    public function getDate() { return $this->date; }
    public function getVehiculeId() { return $this->vehicule_id; }
    public function getChauffeurId() { return $this->chauffeur_id; }
    public function getStatut() { return $this->statut; }



    /**
     * @return mixed
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }
    public static function keys(){ return new AES("  "); }


    public function ajouter() {
        return Query::CRUD("INSERT INTO depenses (type_depense, montant, description, date_depense, vehicule_id, chauffeur_id, statut,devise) VALUES ('$this->type', '$this->montant', '$this->description', '$this->date', '$this->vehicule_id', '$this->chauffeur_id', '$this->statut', '$this->devise')");
    }

    public static function afficher($query) {
        return self::toDo(Query::CRUD($query));
    }

    public static function affichers($query) {
        return self::toDoList(Query::CRUD($query));
    }

    public static function toDo($query) {
        if ($query) {
            $key = self::keys();
            $i = $query->fetch(PDO::FETCH_OBJ);
            $id = $i->id_depense;
            $vehicule_id = $i->vehicule_id;
            $chauffeur_id = $i->chauffeur_id;
            $montant = $i->montant;
            $date_create = $i->date_create;
            $date = $i->date_depense;
            $type = $i->type_depense?$key->decrypt($i->type_depense):'';
            $devise = $i->devise?$key->decrypt($i->devise):'';
            $description = $i->description?$key->decrypt($i->description):'';
            $statut = $i->statut?$key->decrypt($i->statut):'';
            return new Depense($id, $type, $montant, $description, $date, $vehicule_id, $chauffeur_id, $statut, $date_create, $devise);
        }
    }

    public static function toDoList($query) {
        $tab = [];
        $key = self::keys();
        if ($query) {
            while ($i = $query->fetch(PDO::FETCH_OBJ)) {
                $id = $i->id_depense;
                $vehicule_id = $i->vehicule_id;
                $chauffeur_id = $i->chauffeur_id;
                $montant = $i->montant;
                $date_create = $i->date_create;
                $date = $i->date_depense;
                $type = $i->type_depense?$key->decrypt($i->type_depense):'';
                $description = $i->description?$key->decrypt($i->description):'';
                $statut = $i->statut?$key->decrypt($i->statut):'';
                $devise = $i->devise?$key->decrypt($i->devise):'';

                $tab[] = new Depense($id, $type, $montant, $description, $date, $vehicule_id, $chauffeur_id, $statut, $date_create,$devise);
            }
        }
        return $tab;
    }
}
?>
