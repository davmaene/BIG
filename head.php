<?php 
    if(isset($_SESSION['_bigUser'])){
        function getSessionName(){
            $session = base64_decode($_SESSION['_bigUser']);
            $session = (json_decode($session));
            return $session->nom." ".$session->postnom;
        }
        
        function getMemebres($options = null){
            $membres = new Membres();
            $membres = $membres->getAll();

            return $membres;
        }

    }else header("location: ./login/");
?>