<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
//$domain_name=$_POST['domain'];
$domain_id=$_POST['domain_id'];

$sql="SELECT * FROM specializari WHERE id_domeniu='$domain_id' ";
$result=mysqli_query($dbCon->getCon(), $sql);
while($row=mysqli_fetch_array($result)){
    $name=$row['denumire'];
    $id=$row['id'];
    $spec_row[]=array("name"=>$name,"id"=>$id);

}
echo json_encode($spec_row);



?>