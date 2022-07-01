<?php 
    include_once('./middleware/pont.php');
    $pgs = scandir('pages/');
    $id = (isset($_SESSION['_bigUser'])) ? $_SESSION['_bigUser'] : null;
    $tkn = (isset($_SESSION['token'])) ? $_SESSION['token'] : null;
    if($id === null && $tkn === null) header('location: ./pages/login/');
    // if($id !== null && $tkn === null) header('location: sessionreset/');
    $page = "Home";

    if(isset($_GET['page'])){
        if(!empty($_GET['page'])){
            if(in_array($_GET['page'].'.php', $pgs, true)){
                $inc = trim($_GET['page']);
                $page = $inc;
                $inc = $inc.'.php';
            }else header('location: ./404/');
        }else $inc = 'home.php';
    }else $inc = 'home.php';
    $time_date = date('Y-m-d h:m:s');

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
    // onCheckSession();
?>