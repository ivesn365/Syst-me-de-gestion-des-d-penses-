<?php
class Job {
    private $id;
    private $title;
    private $description;
    private $company;
    private $location;
    private $salary;
    private $date_fin_depot;
    private $currency;
    private $category;
    private $departement;
    private $nature_contrat;
    private $date_debut_contrat;
    private $profil;
    private $qualification;
    private $experience;

    private $principale_tache;
    private $mission;
    private $responsabilite;
    private $exigence;
    private $recruiter_id;
    private $created_at;
    private $status;

    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $company
     * @param $location
     * @param $salary
     * @param $date_fin_depot
     * @param $currency
     * @param $category
     * @param $departement
     * @param $nature_contrat
     * @param $date_debut_contrat
     * @param $profil
     * @param $qualification
     * @param $experience
     * @param $principale_tache
     * @param $mission
     * @param $responsabilite
     * @param $exigence
     * @param $recruiter_id
     * @param $created_at
     * @param $status
     */
    public function __construct($id, $title, $description, $company, $location, $salary, $date_fin_depot, $currency, $category, $departement, $nature_contrat, $date_debut_contrat, $profil, $qualification, $experience, $principale_tache, $mission, $responsabilite, $exigence, $recruiter_id, $created_at, $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->company = $company;
        $this->location = $location;
        $this->salary = $salary;
        $this->date_fin_depot = $date_fin_depot;
        $this->currency = $currency;
        $this->category = $category;
        $this->departement = $departement;
        $this->nature_contrat = $nature_contrat;
        $this->date_debut_contrat = $date_debut_contrat;
        $this->profil = $profil;
        $this->qualification = $qualification;
        $this->experience = $experience;
        $this->principale_tache = $principale_tache;
        $this->mission = $mission;
        $this->responsabilite = $responsabilite;
        $this->exigence = $exigence;
        $this->recruiter_id = $recruiter_id;
        $this->created_at = $created_at;
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getRecruiterId()
    {
        return $this->recruiter_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getDateFinDepot()
    {
        return $this->date_fin_depot;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @return mixed
     */
    public function getNatureContrat()
    {
        return $this->nature_contrat;
    }

    /**
     * @return mixed
     */
    public function getDateDebutContrat()
    {
        return $this->date_debut_contrat;
    }

    /**
     * @return mixed
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * @return mixed
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @return mixed
     */
    public function getPrincipaleTache()
    {
        return $this->principale_tache;
    }

    /**
     * @return mixed
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @return mixed
     */
    public function getResponsabilite()
    {
        return $this->responsabilite;
    }

    /**
     * @return mixed
     */
    public function getExigence()
    {
        return $this->exigence;
    }




    public static function keys(){ return new AES("8C21E27E27676E3D");}

    public static function toDoList($query){
        $tab = [];
        $key = self::keys();
        if ($query){
            while ($i = $query->fetch(PDO::FETCH_OBJ)){
                $id = $i->id;
                $title = $i->title ? $key->decrypt($i->title) : null;
                $description = $i->description ? $key->decrypt($i->description) : null;
                $company = $i->company ? $key->decrypt($i->company) : null;
                $location = $i->location ? $key->decrypt($i->location) : null;
                $currency = $i->currency ? $key->decrypt($i->currency) : null;
                $category = $i->category ? $key->decrypt($i->category) : null;
                $date_fin_depot = $i->date_fin_depot ? $key->decrypt($i->date_fin_depot) : null;
                $departement = $i->departement ? $key->decrypt($i->departement) : null;
                $nature_contrat = $i->nature_contrat ? $key->decrypt($i->nature_contrat) : null;
                $date_debut_contrat = $i->date_debut_contrat ? $key->decrypt($i->date_debut_contrat) : null;
                $profil = $i->profil ? $key->decrypt($i->profil) : null;
                $qualification = $i->qualification ? $key->decrypt($i->qualification) : null;
                $experience = $i->experience ? $key->decrypt($i->experience) : null;
                $principale_tache = $i->principale_tache ? $key->decrypt($i->principale_tache) : null;
                $mission = $i->mission ? $key->decrypt($i->mission) : null;
                $responsabilite = $i->responsabilite ? $key->decrypt($i->responsabilite) : null;
                $exigence = $i->exigence ? $key->decrypt($i->exigence) : null;
                $salary = $i->salary;
                $recruiter_id = $i->recruiter_id;
                $created_at = $i->created_at;
                $status = $i->status;

                $tab[] = new Job($id, $title, $description, $company, $location, $salary, $date_fin_depot, $currency, $category, $departement, $nature_contrat, $date_debut_contrat, $profil, $qualification, $experience, $principale_tache, $mission, $responsabilite, $exigence, $recruiter_id, $created_at, $status);
            }
            return $tab;
        }
    }
    public static function toDo($query){
        $key = self::keys();
        if ($query){
           $i = $query->fetch(PDO::FETCH_OBJ);
            $id = $i->id;
            $title = $i->title ? $key->decrypt($i->title) : null;
            $description = $i->description ? $key->decrypt($i->description) : null;
            $company = $i->company ? $key->decrypt($i->company) : null;
            $location = $i->location ? $key->decrypt($i->location) : null;
            $currency = $i->currency ? $key->decrypt($i->currency) : null;
            $category = $i->category ? $key->decrypt($i->category) : null;
            $date_fin_depot = $i->date_fin_depot ? $key->decrypt($i->date_fin_depot) : null;
            $departement = $i->departement ? $key->decrypt($i->departement) : null;
            $nature_contrat = $i->nature_contrat ? $key->decrypt($i->nature_contrat) : null;
            $date_debut_contrat = $i->date_debut_contrat ? $key->decrypt($i->date_debut_contrat) : null;
            $profil = $i->profil ? $key->decrypt($i->profil) : null;
            $qualification = $i->qualification ? $key->decrypt($i->qualification) : null;
            $experience = $i->experience ? $key->decrypt($i->experience) : null;
            $principale_tache = $i->principale_tache ? $key->decrypt($i->principale_tache) : null;
            $mission = $i->mission ? $key->decrypt($i->mission) : null;
            $responsabilite = $i->responsabilite ? $key->decrypt($i->responsabilite) : null;
            $exigence = $i->exigence ? $key->decrypt($i->exigence) : null;
            $salary = $i->salary;
            $recruiter_id = $i->recruiter_id;
            $created_at = $i->created_at;
            $status = $i->status;

            return new Job($id, $title, $description, $company, $location, $salary, $date_fin_depot, $currency, $category, $departement, $nature_contrat, $date_debut_contrat, $profil, $qualification, $experience, $principale_tache, $mission, $responsabilite, $exigence, $recruiter_id, $created_at, $status);

        }
    }

    public static function affichers($query){ return self::toDoList(Query::CRUD($query)); }
    public static function afficher($query){ return self::toDo(Query::CRUD($query)); }

    public function ajouter(){
        return Query::CRUD("INSERT INTO `jobs`(`title`, `description`, `company`, `location`, `salary`, `currency`, `category`, `date_fin_depot`, `departement`, `nature_contrat`, `date_debut_contrat`, `profil`, `qualification`, `experience`, `principale_tache`, `mission`, `responsabilite`, `exigence`, `recruiter_id`, `status`) VALUES ('$this->title','$this->description','$this->company','$this->location','$this->salary','$this->currency','$this->category','$this->date_fin_depot','$this->departement','$this->nature_contrat','$this->date_debut_contrat','$this->profil','$this->qualification','$this->experience','$this->principale_tache','$this->mission','$this->responsabilite','$this->exigence','$this->recruiter_id','1')");
    }

}
?>
