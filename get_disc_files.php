<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$disc_file_array=array();
$id_disc=explode(',',$_POST['id_disc']);
foreach ($id_disc as $id){
    $sql="SELECT * from fisediscipline WHERE id_disciplina='$id' ";
    $result=mysqli_query($dbCon->getCon(), $sql);
    $disc_file=mysqli_fetch_assoc($result);
    $content=$disc_file['content'];
    $disc_id=$disc_file['id_disciplina'];
    $sql2="SELECT denumire from specializari WHERE id=(SELECT id_specializare FROM discipline WHERE id='$disc_id') ";
    $result2=mysqli_query($dbCon->getCon(), $sql2);
    $spec=mysqli_fetch_assoc($result2);
    $spec_name=$spec['denumire'];
    $disc_file_array[]=array("content"=>$content, "id_disc"=>$disc_id,"spec_name"=>$spec_name);
}

echo json_encode($disc_file_array);

?>
