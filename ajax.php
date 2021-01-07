<?php
/**
 * Created by PhpStorm.
 * User: Dumit
 * Date: 1/12/2020
 * Time: 2:57 PM
 */
include 'resources\php\DbConnection.php';

function asd()
{
$dbCon = new DbConnection();
$sql = "SELECT * FROM utilizatori ";
$result = mysqli_query($dbCon->getCon(), $sql);
while ($row = $result->fetch_assoc())
{
$result_array[] = $row;
}
echo json_encode($result_array);
}
asd();
?>
