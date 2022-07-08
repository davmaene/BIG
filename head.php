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
            // "__tbl_accounts"
            $membres = $membres->getAll(null, 
                [
                    array(
                        "table" => new Accounts(),
                        "on" => ["idaccount", "id"],
                        "columns" => ["parts", "socials"]
                    )
                ]
            );
            return $membres;
        }

        function getContributions($options){
            $confs = new Config();
            $parts = new Parts();
            $parts = $parts->getAll();

            return $parts;
        }

        function getSoldeContribution($categ){
            $nmbofparts = 0;
            $confs = new Config();
            $parts = new Accounts();
            $parts = $parts->getAll();

            // $res = $confs->onFetchingOne(
            //     "",
            //     ""
            // );
            foreach ((array) $parts->body as $value) {
              $nmbofparts = $nmbofparts + $value->$categ;
            }

            return $nmbofparts;
        }

        function getSoldeCredit($categ){
            $nmbofparts = 0;
            $Credit = new Credits();

            $Credit = $Credit->getAll(
                array(
                    "status" => 1
                )
            );

            foreach ((array) $Credit->body as $value) {
              $nmbofparts = $nmbofparts + $value->$categ;
            }

            return $nmbofparts;
        }

    }else header("location: ./login/");
?>