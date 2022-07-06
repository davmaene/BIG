<?php 
    class Accounts extends CRUD__{
        public $id;
        public $iscouple;
        // public $membre_1;
        // public $membre_2;
        public $status;
        public $ispendingpassif;
        public $createdon;

        public function __constructor($id, $iscouple, $status, $ispendingpassif, $createdon){
            $this->id = $id;
            $this->iscouple = $iscouple;
            // $this->membre_1 = $membre_1;
            // $this->membre_2 = $membre_2;
            $this->status = $status;
            $this->ispendingpassif = $ispendingpassif;
            $this->createdon = $createdon;
        }
    }
?>