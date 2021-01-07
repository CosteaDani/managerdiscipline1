<?php
include 'User.php';
session_start();
$user = new User();

if (isset($_POST['login_btn'])) {


    if(($logIn=$user->logIn()==1)){
        if(isset($_POST['id_disc'])){
            $id_disc=$_POST['id_disc'];
            header("location:create_disc_file.php?id_disc=".$id_disc);
        }
        elseif ($_SESSION['user_role']==2) {
                header("location:fisa_disciplinei.php");
                 }
        elseif(($_SESSION['user_role']==1)||($_SESSION['user_role']==0))
            {   header("location:home.php"); }}


    else header("location:index.php");

}
