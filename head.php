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

        function getSoldeCredit($categ = null){
            $montantdu = 0;
            $montantpayer = 0;
            $Credit = new Credits();

            // array(
            //     "status" => 1
            // ),

            $Credit = $Credit->getAll(
                null,
                [
                    array(
                        "table" => new Membres(),
                        "on" => ["idaccount", "idaccount"],
                        "columns" => ["nom", "postnom", "phone"]
                    )
                ]
            );

            // var_dump($Credit);

            foreach ((array) $Credit->body as $value) {
              $montantdu = $montantdu + $value->montantdu;
              $montantpayer = $montantpayer + $value->montantpaye;
            }

            return array(
                "solde" => $montantdu - $montantpayer,
                "table" => $Credit->body
            );
        }

    }else header("location: ./login/");
?>