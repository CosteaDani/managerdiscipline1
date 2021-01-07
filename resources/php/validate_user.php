<?php
/**
 * Created by PhpStorm.
 * User: Dumit
 * Date: 1/26/2020
 * Time: 2:55 PM
 */
session_start();


if(!isset($_SESSION['username'])){

    if(  $_SERVER['PHP_SELF']=='/managerdiscipline/create_disc_file.php'){
        $id=$_GET['id_disc'];
        header("Location: /managerdiscipline/index.php?fisadisc=".$id);

    }
    else {header("Location: /managerdiscipline/index.php");}
}
?>