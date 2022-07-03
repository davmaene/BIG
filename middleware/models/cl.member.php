<?php 
class Membres extends CRUD__{
    public $id;
    public $nom;
    public $postnom;
    public $phone;
    public $pendingpassif;
    public $status;
    public $createdon;

    public function __constructor($id, $nom, $postnom, $phone, $pendingpassif, $status, $createdon){
        $this->id = $id;
        $this->nom = $nom;
        $this->postnom = $postnom;
        $this->pendingpassif = $pendingpassif;
        $this->status = $status;
        $this->createdon = $createdon;
        
    }
}

?>