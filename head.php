<?php 
    if(isset($_SESSION['_bigUser'])){
        function getSessionName(){
            $session = base64_decode($_SESSION['_bigUser']);
            $session = (json_decode($session));
            return $session->nom." ".$session->postnom;
        }
    
        function countMembers(){
    
        }
    
        function countPenalites(){
    
        }
    
        function countCredit(){
    
        }
    
        function countContributions(){
    
        }
    }else header("location: ./login/");
?>