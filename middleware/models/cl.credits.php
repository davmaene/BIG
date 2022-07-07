<?php 
class Credits extends CRUD__{

    public $id;
    public $idaccount;
    public $montantdu;
    public $montantpaye;
    public $devise;
    public $createdon;
    public $updatedon;
    public $status;

    public function __construct() {}
        
    public function __constructor($id, $idaccount, $montantdu, $montantpaye, $devise, $createdon, $updatedon, $status){
        $this->id = $id;
        $this->idaccount = $idaccount;
        $this->montantdu = $montantdu;
        $this->montantpaye = $montantpaye;
        $this->devise = $devise;
        $this->createdon = $createdon;
        $this->updatedon = $updatedon;
        $this->status = $status;
    }   
}

?>