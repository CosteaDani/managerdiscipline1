<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$arr = array();

    $disc_name=$_POST['disc_name'];
    $id_promo=$_POST['id_promotion'];
    $sql="SELECT id FROM discipline WHERE( denumire='$disc_name' AND id_promotie='$id_promo') AND NOT EXISTS(SELECT id_disciplina FROM fisediscipline WHERE fisediscipline.id_disciplina=discipline.id)";
    $result=mysqli_query($dbCon->getCon(), $sql);
if (mysqli_num_rows($result)>0) {
    while ($disc = mysqli_fetch_array($result)) {

        $id=$disc['id'];
        $sql2="SELECT denumire, id  FROM specializari WHERE id=(SELECT id_specializare FROM discipline WHERE id='$id' ) ";
        $result2=mysqli_query($dbCon->getCon(), $sql2);

        if (mysqli_num_rows($result2)>0) {
            while ($spec = mysqli_fetch_array($result2)) {

                $id_spec=$spec['id'];
                $name_spec=$spec['denumire'];

                $arr[]=array("name"=>$name_spec,"id"=>$id_spec);

            }}


    }}




echo json_encode($arr);?>
