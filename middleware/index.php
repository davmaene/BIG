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
include_once("models/cl.parts.php");
include_once("models/cl.typecredit.php");

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

$valuepart = 1320;
$valuepartsocial = 4;

if($_GET['curl']){
    $curl = $_GET['curl'];
    switch ($curl) {
        case 'typecredit':
            $typecredit = new Typecredits();
            $typecredit = $typecredit->getAll();

            echo($typecredit->print());
            break;
        case 'paiementcredit':
            break;
        case 'octroitcredit':
            break;
        case 'contribution':
            // $parts = new Parts();
            $acc = new Accounts();
            $account = $acc->getOne(array(
                    "id" => (int) $_POST['numcarnet']
                ),null,null, null);

            $b = (array) $account->body;

            if(count($b) && $account->status === 200){
                $acc = $acc->edit(array(
                    "id" => (int) $_POST['numcarnet']
                ), array(
                    "socials" => (int) $b['socials'] + (int) $_POST['parts']
                ));

                echo($acc->print());
                // $parts->__constructor(null, (int) $b['id'], (int) $_POST['parts'], date("d/m/Y, H:i:s"), date("d/m/Y, H:i:s"), $_POST['valeupart']);
                // $parts = $parts->save();
            }else{
                $res = new Response(404, "le  numero du membre est erroné !");
                echo($res->print());
            }
            break;
        case 'addpart':
            // $parts = new Parts();
            $acc = new Accounts();
            $account = $acc->getOne(array(
                    "id" => (int) $_POST['numcarnet']
                ),null,null, null);

            $b = (array) $account->body;

            if(count($b) && $account->status === 200){
                $acc = $acc->edit(array(
                    "id" => (int) $_POST['numcarnet']
                ), array(
                    "parts" => (int) $b['parts'] + (int) $_POST['parts']
                ));

                echo($acc->print());
                // $parts->__constructor(null, (int) $b['id'], (int) $_POST['parts'], date("d/m/Y, H:i:s"), date("d/m/Y, H:i:s"), $_POST['valeupart']);
                // $parts = $parts->save();
            }else{
                $res = new Response(404, "le  numero du membre est erroné !");
                echo($res->print());
            }
            break;
        case 'connexion':
            $admin = new Admins();
            $admin = $admin->getOne(
                    array(
                        "phone" => _fillPhoneNumber($_POST['phone']),
                        "password" => md5($_POST['password'])
                ), null, null, "AND"
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

                $acoount = new Accounts();
                $acoount->__constructor(null, 1, 0, 0, $valuepart, $valuepartsocial,  1, 0, date("d/m/Y, H:i:s"));

                $account = $acoount->save();
                $b = $account->body;
                
                if($account->status === 200 && 1){
                    $member1->__constructor(
                        null, 
                        strtolower($_POST['nom1']),
                        strtolower($_POST['postnom1']),
                        $_POST['phone1'],
                        0,
                        $b->id,
                        1,
                        date("d/m/Y, H:i:s")
                    );
                    $member1 = $member1->save();
                    // save seconde member
                    $member2->__constructor(
                        null, 
                        strtolower($_POST['nom2']),
                        strtolower($_POST['postnom2']),
                        $_POST['phone2'],
                        0,
                        $b->id,
                        1,
                        date("d/m/Y, H:i:s")
                    );
                    $member2 = $member2->save();
                    if($member1->status === 200 && $member2->status === 200){
                        $res = new Response(200, [ $member1->body, $member2->body ]);
                        echo($res->print());
                    }else{
                        echo($member1->print());
                    }
                } else {
                    echo($account->print());
                }
            }else{
                $member = new Membres();
                $acoount = new Accounts();
                $acoount->__constructor(null, 1, 0, 0, $valuepart, $valuepartsocial,  1, 0, date("d/m/Y, H:i:s"));

                $account = $acoount->save();
                $b = $account->body;
                if($account->status === 200){
                    $member->__constructor(
                        null, 
                        strtolower($_POST['nom1']),
                        strtolower($_POST['postnom1']),
                        $_POST['phone1'],
                        0,
                        $b->id,
                        1,
                        date("d/m/Y, H:i:s")
                    );
                    $member = $member->save();
                    echo($member->print());
                } else {
                    echo($account->print());
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
