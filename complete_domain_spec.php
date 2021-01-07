<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();

$id_disc=$_POST['id_disc'];
$complete_array=array();

    $sql="SELECT id,id_domeniu FROM specializari WHERE id=(SELECT id_specializare FROM discipline WHERE id='$id_disc')";
    $result=mysqli_query($dbCon->getCon(), $sql);
    while($row=mysqli_fetch_array($result)){

        $domain_id=$row['id_domeniu'];
        $spec_id=$row['id'];
        $domain="SELECT denumire FROM domenii WHERE id='$domain_id'";
        $domain=mysqli_query($dbCon->getCon(),$domain);
        $domain_name=mysqli_fetch_assoc($domain);
        $spec="SELECT denumire FROM specializari WHERE id='$spec_id'";
        $spec=mysqli_query($dbCon->getCon(),$spec);
        $spec_name=mysqli_fetch_assoc($spec);
        $complete_array[]=array("domain_name"=>$domain_name['denumire'], "spec_name"=>$spec_name['denumire']);


    }
//    $id_spec=$result['id_specializare'];
//    $sql2="SELECT id_domeniu FROM specializari where id='$id_spec'";
//    $result2=mysqli_query($dbCon->getCon(), $sql2);
//    $id_domain=$result2['id_domeniu'];
//    $complete_array[]=array("spec"=>$id_spec,"domain"=>$id_domain);

echo(json_encode($complete_array));

?>