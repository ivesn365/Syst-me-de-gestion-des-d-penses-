<?php
class Remboursement {
    private $id;
    private $chauffeur_id;
    private $depense_id;
    private $montant;
    private $date;
    private $status;
    private $date_create;

    /**
     * @param $id
     * @param $chauffeur_id
     * @param $depense_id
     * @param $montant
     * @param $date
     * @param $status
     * @param $date_create
     */
    public function __construct($id, $chauffeur_id, $depense_id, $montant, $date, $status, $date_create)
    {
        $this->id = $id;
        $this->chauffeur_id = $chauffeur_id;
        $this->depense_id = $depense_id;
        $this->montant = $montant;
        $this->date = $date;
        $this->status = $status;
        $this->date_create = $date_create;
    }


    public function getId() { return $this->id; }
    public function getChauffeurId() { return $this->chauffeur_id; }
    public function getDepenseId() { return $this->depense_id; }
    public function getMontant() { return $this->montant; }
    public function getDate() { return $this->date; }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }
    public static function keys(){ return new AES("  "); }
    public function ajouter() {
        return Query::CRUD("INSERT INTO remboursements (chauffeur_id, depense_id, montant_rembourse, date_remboursement,status) VALUES ('$this->chauffeur_id', '$this->depense_id', '$this->montant', '$this->date', '$this->status')");
    }

    public static function afficher($query) {
        return self::toDo(Query::CRUD($query));
    }

    public static function affichers($query) {
        return self::toDoList(Query::CRUD($query));
    }

    public static function toDo($query) {
        if ($query) {
            $i = $query->fetch(PDO::FETCH_OBJ);
            return new Remboursement($i->id_remboursement, $i->chauffeur_id, $i->depense_id, $i->montant_rembourse, $i->date_remboursement, $i->status, $i->date_create);
        }
    }

    public static function toDoList($query) {
        $tab = [];
        $key = self::keys();
        if ($query) {
            while ($i = $query->fetch(PDO::FETCH_OBJ)) {

                $tab[] = new Remboursement($i->id_remboursement, $i->chauffeur_id, $i->depense_id, $i->montant_rembourse, $i->date_remboursement, $i->status, $i->date_create);
            }
        }
        return $tab;
    }
}
?>
