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

if($_GET['curl']){
    $curl = $_GET['curl'];
   switch ($curl) {
    case 'connexion':
        $admin = new Admins();
        $admin = $admin->getAll();
        echo($admin->print());
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