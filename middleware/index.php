<?php 
date_default_timezone_set('UTC');
require_once("pont.php"); // don't delete or modify this line
// ----------------------------------------------------------
// ----------------  include classes here ---------------------
// ----------------------------------------------------------
include_once("models/cl.user.php");
include_once("models/cl.rubriques.php");
include_once("models/cl.admin.php");

function _listRubriques($where = null){
    $rbqs = new Rubriques();
    $rbqs = $rbqs->getAll($where ? $where : null);
    return $rbqs;
}
function _numDaysInMonth($month){
    $number = cal_days_in_month(CAL_GREGORIAN, $month, date("Y")); 
    return $number;
}
function _fillPhoneNumber($string){
    if(strlen($string) === 9) return $string = "0".$string;
    if(strlen($string) === 10) return $string;
    if(strlen($string) > 10 && strlen($string) <= 14) return $string = substr($string, 4);
    else return "()()()()()()()";
}

if($_GET['curl']){
    $curl = $_GET['curl'];
   switch ($curl) {

    case 'connexion':
        $admin = new Admins();
        $admin = $admin->getOne(
                array(
                "phone" => _fillPhoneNumber($_POST['phone']),
                "password" => md5($_POST['password'])
            )
        );
        $a = (array) $admin;
        if($a['status'] === 200 && count($a['body']) > 0){
            
        }else{
            $res = new Response(500, "Something went wrong !");
            echo($res->print());
        }
        break;
    
    default:
        $res = new Response(404, "Aucune route trouvée avec comme clé ");
        echo($res->print());
        break;
   }

}else{
    $res = new Response(404, "Aucune route trouvée avec comme clé ");
    echo($res->print());
}

?>
