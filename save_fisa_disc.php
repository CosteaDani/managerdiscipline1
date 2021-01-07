<?php
/**
 * Created by PhpStorm.
 * Date: 1/19/2020
 * Time: 6:59 PM
 */
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
function asd()
{
    $dbCon = new DbConnection();
    $htmlContent = $_POST['htmlContent'];
    $id_disc = $_POST['id_disc'];




    if(isset($_POST['edit'])){
        $sql = "UPDATE fisediscipline SET content = '$htmlContent' WHERE id_disciplina = '$id_disc'";
        $result = mysqli_query($dbCon->getCon(), $sql);
    }
    else{

        $sql = "INSERT INTO fisediscipline (content, id_disciplina) VALUES ('$htmlContent','$id_disc')";
        $result = mysqli_query($dbCon->getCon(), $sql);
    }


//    echo " /managerdiscipline/edit_disc_file.php?id_disc=".$id_disc ."&edit=1";



}
asd();