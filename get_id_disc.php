<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();

$disc_name=$_POST['disc'];
$spec=$_POST['id_spec'];
$id_promo=$_POST['id_promo'];

$disc_array=array();
foreach($spec as $id_spec) {
    $sql = "SELECT id FROM discipline WHERE denumire='$disc_name' AND id_specializare='$id_spec' AND id_promotie='$id_promo'";
    $result=mysqli_query($dbCon->getCon(), $sql);
    while($disc=mysqli_fetch_array($result)){
    array_push($disc_array, $disc);}

}

echo(json_encode($disc_array));
?>
