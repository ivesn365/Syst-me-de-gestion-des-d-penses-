<?php
class Chauffeur {
    private $id;
    private $nom;
    private $prenom;
    private $fonction;
    private $telephone;
    private $salaire_mensuel;
    private $status;
    private $date_creation;

    /**
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $fonction
     * @param $telephone
     * @param $salaire_mensuel
     * @param $status
     * @param $date_creation
     */
    public function __construct($id, $nom, $prenom, $fonction, $telephone, $salaire_mensuel, $status, $date_creation)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->fonction = $fonction;
        $this->telephone = $telephone;
        $this->salaire_mensuel = $salaire_mensuel;
        $this->status = $status;
        $this->date_creation = $date_creation;
    }


    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getTelephone() { return $this->telephone; }
    public function getSalaireMensuel() { return $this->salaire_mensuel; }

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
    public function getDateCreation()
    {
        return $this->date_creation;
    }


    public static function keys(){ return new AES("  "); }
    /**
     * @return mixed
     */
    public function getFonction()
    {
        return $this->fonction;
    }


    public function ajouter() {
        return Query::CRUD("INSERT INTO chauffeurs (nom, prenom,fonction, telephone,salaire_mensuel,status) VALUES ('$this->nom', '$this->prenom', '$this->fonction','$this->telephone', '$this->salaire_mensuel', '$this->status')");
    }

    public static function afficher($query) {
        return self::toDo(Query::CRUD($query));
    }

    public static function affichers($query) {
        return self::toDoList(Query::CRUD($query));
    }

    public static function toDo($query) {
        $key = self::keys();
        if ($query) {
            $i = $query->fetch(PDO::FETCH_OBJ);
            $id = $i->id_chauffeur;
            $status = $i->status;
            $date_creation = $i->date_creation;
            $salaire_mensuel = $i->salaire_mensuel;
            $nom = $i->nom?$key->decrypt($i->nom):'';
            $prenom = $i->prenom?$key->decrypt($i->prenom):'';
            $telephone = $i->telephone?$key->decrypt($i->telephone):'';
            $fonction = $i->fonction?$key->decrypt($i->fonction):'';
            return new Chauffeur($id, $nom, $prenom, $fonction, $telephone, $salaire_mensuel, $status, $date_creation   );
        }
    }

    public static function toDoList($query) {
        $tab = [];
        $key = self::keys();
        if ($query) {
            while ($i = $query->fetch(PDO::FETCH_OBJ)) {
                $id = $i->id_chauffeur;
                $salaire_mensuel = $i->salaire_mensuel;
                $nom = $i->nom?$key->decrypt($i->nom):'';
                $status = $i->status;
                $date_creation = $i->date_creation;
                $prenom = $i->prenom?$key->decrypt($i->prenom):'';
                $telephone = $i->telephone?$key->decrypt($i->telephone):'';
                $fonction = $i->fonction?$key->decrypt($i->fonction):'';

                $tab[] = new Chauffeur($id, $nom, $prenom, $fonction, $telephone, $salaire_mensuel, $status, $date_creation);
            }
        }
        return $tab;
    }
}
?>
