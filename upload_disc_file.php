<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$type=['application/pdf'];
$id=$_POST['id'];

$disciplina = mysqli_query($dbCon->getCon(), "SELECT * FROM discipline WHERE id = '$id'");
$disciplina = $disciplina->fetch_assoc();
$cod= $disciplina['cod'];
$specializare = mysqli_query($dbCon->getCon(), "SELECT * FROM specializari WHERE id=( SELECT discipline.id_specializare FROM discipline WHERE id='$id' ) ");
$specializare=$specializare->fetch_assoc();
$promotie=mysqli_query($dbCon->getCon(), "SELECT * FROM  promotii WHERE id=( SELECT discipline.id_promotie FROM discipline WHERE id='$id' ) ");

$promotie=$promotie->fetch_assoc();
$start=$promotie['inceput'];

$end=$promotie['sfarsit'];

$abr=$specializare['abreviere'];


if(!(in_array($_FILES['file']['type'], $type))){
    echo('Introduceti un fisier .pdf');
}

if(!file_exists('resources\pi\\' .$start.'-'.$end.'\\'.$abr)){
    mkdir('resources\pi\\' .$start.'-'.$end.'\\'.$abr, 0777, true);
}

$sql="INSERT INTO fisediscipline (id_disciplina) VALUES ('$id')";
mysqli_query($dbCon->getCon(),$sql);

move_uploaded_file($_FILES['file']['tmp_name'], 'resources\pi\\' .$start.'-'.$end.'\\'.$abr.'\\'.$abr . $cod. '.pdf');

echo('succes');




?>