<?php 
// session_start();
date_default_timezone_set('UTC');
require_once("pont.php"); // don't delete or modify this line
// ----------------------------------------------------------
// ----------------  include classes here -------------------
// ----------------------------------------------------------
include_once("models/cl.user.php");
include_once("models/cl.rubriques.php");
include_once("models/cl.admin.php");
include_once("models/cl.member.php");
include_once("models/cl.accounts.php");

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

            try {
                $a = (array) $admin->body;
                if($admin->status === 200){
                    if(1 && count($a) > 0){
                        $_SESSION['_bigUser'] = base64_encode(json_encode($a));
                        $_SESSION['token'] = base64_encode($a['id']);
                        echo($admin->print());
                    } else {
                        $res = new Response(404, "No Item found !");
                        echo($res->print());
                    }
                }else{
                    $res = new Response(500, "Something went wrong !");
                    echo($res->print());
                }
            } catch (\Throwable $th) {
                $res = new Response(500, $th);
                echo($res->print());
            }
            break;
        case 'addmember':
            if(isset($_POST['checked'])){
                $member1 = new Membres();
                $member2 = new Membres();
                
                $member1->__constructor(
                    null, 
                    strtolower($_POST['nom1']),
                    strtolower($_POST['postnom1']),
                    $_POST['phone1'],
                    0,
                    1,
                    date("D-M-Y, H:i:s")
                );
                $member1 = $member1->save();
                // save seconde member
                $member2->__constructor(
                    null, 
                    strtolower($_POST['nom2']),
                    strtolower($_POST['postnom2']),
                    $_POST['phone2'],
                    0,
                    1,
                    date("D-M-Y, H:i:s")
                );
                $member2 = $member2->save();

                $b1 = $member1->body;
                $b2 = $member2->body;

                if($member1->status === 200 && $member2->status === 200){
                    $acoount = new Accounts();
                    $acoount->__constructor(null, 0, $b1->id, $b2->id, 1, 0, date("D-M-Y, H:i:s"));

                    $account = $acoount->save();
                    echo($account->print());
                } else {
                    echo($member1->print());
                }

            }else{
                $member = new Membres();
                $member->__constructor(
                    null, 
                    strtolower($_POST['nom1']),
                    strtolower($_POST['postnom1']),
                    $_POST['phone1'],
                    0,
                    1,
                    date("D-M-Y, H:i:s")
                );
                $member = $member->save();
                $b = $member->body;
                if($member->status === 200){
                    var_dump($b);
                    $acoount = new Accounts();
                    $acoount->__constructor(null, 0, $b->id, 0, 1, 0, date("D-M-Y, H:i:s"));

                    $account = $acoount->save();
                    echo($account->print());
                } else {
                    echo($member->print());
                }
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
