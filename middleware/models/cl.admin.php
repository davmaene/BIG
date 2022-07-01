<?php 
    class Admins extends CRUD__{
        public $id;
        public $nom;
        public $postnom;
        public $phone;
        public $password;
        
        public function __constructor($id, $nom, $postnom, $password, $phone){
            $this->id = $id;
            $this->nom = $nom;
            $this->postnom = $postnom;
            $this->password = $password;
            $this->phone = $phone;
        }
    }
?>