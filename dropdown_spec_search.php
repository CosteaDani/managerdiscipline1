<?php

include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();

$progstudies_id = $_POST['progstudies_id'];

$sql = "SELECT * FROM specializari WHERE id_ciclu_studii='$progstudies_id' ";
$result = mysqli_query($dbCon->getCon(), $sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['denumire'];
    $abv = $row['abreviere'];
    $spec_row[] = array("name" => $name, "abv" => $abv);

}
echo json_encode($spec_row);

?>

