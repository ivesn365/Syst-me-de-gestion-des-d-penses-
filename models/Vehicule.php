<?php
class Vehicule {
    private $id;
    private $marque;
    private $modele;
    private $immatriculation;
    private $date_achat;
    private $status;
    private $date_create;

    /**
     * @param $id
     * @param $marque
     * @param $modele
     * @param $immatriculation
     * @param $date_achat
     * @param $status
     * @param $date_create
     */
    public function __construct($id, $marque, $modele, $immatriculation, $date_achat, $status, $date_create)
    {
        $this->id = $id;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->immatriculation = $immatriculation;
        $this->date_achat = $date_achat;
        $this->status = $status;
        $this->date_create = $date_create;
    }


    public function getId() { return $this->id; }
    public function getMarque() { return $this->marque; }
    public function getModele() { return $this->modele; }
    public function getImmatriculation() { return $this->immatriculation; }
    public function getDateAchat() { return $this->date_achat; }

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
        return Query::CRUD("INSERT INTO vehicules (marque, modele, immatriculation, date_achat,status) VALUES ('$this->marque', '$this->modele', '$this->immatriculation', '$this->date_achat', '$this->status')");
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
            $id = $i->id_vehicule;
            $date_achat = $i->date_achat;
            $status = $i->status;
            $date_create = $i->date_create;
            $modele = $i->modele?$key->decrypt($i->modele):'';
            $immatriculation = $i->immatriculation?$key->decrypt($i->immatriculation):'';
            $marque = $i->marque?$key->decrypt($i->marque):'';
            return new Vehicule($id, $marque, $modele, $immatriculation, $date_achat, $status, $date_create);
        }
    }

    public static function toDoList($query) {
        $tab = [];
        $key = self::keys();
        if ($query) {
            while ($i = $query->fetch(PDO::FETCH_OBJ)) {
                $id = $i->id_vehicule;
                $date_achat = $i->date_achat;
                $status = $i->status;
                $date_create = $i->date_create;
                $modele = $i->modele?$key->decrypt($i->modele):'';
                $immatriculation = $i->immatriculation?$key->decrypt($i->immatriculation):'';
                $marque = $i->marque?$key->decrypt($i->marque):'';
                $tab[] = new Vehicule($id, $marque, $modele, $immatriculation, $date_achat, $status, $date_create);
            }
        }
        return $tab;
    }
}
?>
