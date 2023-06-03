<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
require "classes/require.php";
$t=new App($_GET);
$result=$t->controller_Creator();
if($result){
    $result->executeAction();
}
?>