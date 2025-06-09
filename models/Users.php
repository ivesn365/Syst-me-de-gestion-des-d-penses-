<?php

class Users
{
    private $id, $username, $password, $role, $status;

    /**
     * @param $id
     * @param $username
     * @param $password
     * @param $phone
     * @param $role
     * @param $idHotel
     * @param $status
     */
    public function __construct($id, $username, $password,  $role, $status)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;

        $this->role = $role;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }


    public static function key(){ return new AES('T/r9k4Yg6,%t3Q*-/('); }

    public static function toDoList2($query){
        $key = self::key();
        if ($query)
        {
            while ($i = $query->fetch(PDO::FETCH_OBJ)){
                $id = $i->id;
                $status = $i->status;
                $username = $i->username? $key->decrypt($i->username):'';
                $role = $i->username? $key->decrypt($i->role):'';
                $tab[] = new Users($id, $username, '',  $role, $status);
            }
            return $tab;
        }
    }
    public static function toDoList($query){
        $key = self::key();
        if ($query)
        {
            $i = $query->fetch(PDO::FETCH_OBJ);
            $id = $i->id;
            $status = $i->status;
            $username = $i->username? $key->decrypt($i->username):'';
            $role = $i->username? $key->decrypt($i->role):'';
            return new Users($id, $username, '',  $role, $status);
        }
    }
    public static function afficher($query)
    { return self::toDoList(Query::CRUD($query)); }
    public static function afficher2($query){ return self::toDoList2(Query::CRUD($query)); }

    public function ajouter(){
        Query::CRUD("INSERT INTO users(`username`, `password`,`role`, `status`) VALUES ('$this->username', '$this->password',  '$this->role','$this->status')");
    }

}