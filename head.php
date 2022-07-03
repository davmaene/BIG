<?php 
    // INCLUSION AUTOMITQUE DES MEMBRES 
    $models = scandir("./middleware/models");
    if(count($models) > 0){
        $models = array_slice($models, 2);
        foreach ($models as $value) {
            include_once("middleware/models/$value");
        }
    }
    // END INCLUSION MODELS
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