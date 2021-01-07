<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$arr = array();
if (!empty($_POST['keywords']) && strlen($_POST['keywords']) >= 1) {
    $keywords = $_POST['keywords'];
    $id_promo=$_POST['id_promotion'];

    $sql = "SELECT DISTINCT denumire FROM discipline WHERE denumire LIKE '".$keywords."%' AND id_promotie='$id_promo'  ";
    $result=mysqli_query($dbCon->getCon(), $sql);

}    if (mysqli_num_rows($result)>0) {
    while ($disc = mysqli_fetch_array($result)) {

        $name=$disc['denumire'];

        $arr[]=array("name"=>$name);
    }
}
echo json_encode($arr);?>