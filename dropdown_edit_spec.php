<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();

$progstudies_id=$_POST['progstudies_id'];
$sql1="SELECT id FROM domenii WHERE id_ciclu_studii='$progstudies_id' ";
$result1=mysqli_query($dbCon->getCon(), $sql1);
foreach ($result1 as $domain_id) {
    $id=$domain_id['id'];
    $sql = "SELECT * FROM specializari WHERE id_domeniu='$id' ";
    $result = mysqli_query($dbCon->getCon(), $sql);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['denumire'];
        $id = $row['id'];
        $spec_row[] = array("name" => $name, "id" => $id);

    }
}


    echo json_encode($spec_row);



?>