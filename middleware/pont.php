<?php 
session_start();
$models = scandir("middleware/models/");
// -------------------------------------------
//      ----- don't delete this file -----
// -------------------------------------------
include("config/config.php");
include_once("ware/model.log.php");
include_once("ware/model.response.php");
include_once("ware/model.inst.php");
// --------- interfaces ----------------------
include_once("ware/interface.init.php");
include_once("ware/interface.metier.php");
// // -------------------------------------------
include_once("ware/model.config.php");
include_once("ware/model.crud.php");
// ---------- cunstomers class ---------------
if(count($models) > 0){
    $models = array_slice($models, 2);
    foreach ($models as $value) {
        include_once("middleware/models/$value");
    }
}
// ----------- main --------------------------
// config/main.php
require("config/main.php");
?>