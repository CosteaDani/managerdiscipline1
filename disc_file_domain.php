<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$arr = array();

$id_spec=$_POST['spec'];


foreach ($id_spec as $spec){
    $sql="SELECT id FROM domenii WHERE id=(SELECT id_domeniu FROM specializari WHERE id ='$spec')";
    $result=mysqli_query($dbCon->getCon(), $sql);
    if (mysqli_num_rows($result)>0) {
        while ($domain = mysqli_fetch_array($result)) {

            $id_domain=$domain['id'];
            if(!in_array($id_domain, $arr, true)){
            array_push($arr,$id_domain);

    }
}}}


echo (json_encode($arr));

?>

