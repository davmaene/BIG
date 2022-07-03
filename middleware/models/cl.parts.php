<?php 
class Parts extends CRUD__{
    public $id;
    public $idaccount;
    public $parts;
    public $createdon;
    public $updatedon;

    public function __constructor($id, $idaccount, $parts, $createdon, $updatedon){
        $this->id = $id;
        $this->idaccount = $idaccount;
        $this->parts = $parts;
        $this->createdon = $createdon;
        $this->updatedon = $updatedon;
    }
}
?>