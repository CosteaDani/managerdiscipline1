<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$spec_id = $_POST['spec_id'];
$prom_id = $_POST['prom_id'];
//echo json_encode($_POST['action']);

if ($_POST['action'] == 'CREATE') {
    $sql = "SELECT * FROM discipline WHERE id_specializare='$spec_id' AND id_promotie='$prom_id' AND NOT EXISTS(SELECT id_disciplina FROM fisediscipline WHERE fisediscipline.id_disciplina=discipline.id) ";
    $result = mysqli_query($dbCon->getCon(), $sql);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['denumire'];
        $id = $row['id'];
        $spec_row[] = array("name" => $name, "id" => $id);

    }
    echo json_encode($spec_row);
} elseif ($_POST['action'] == 'EDIT') {
    $disc_row = array();
    $sql = "SELECT * FROM discipline WHERE id_specializare='$spec_id' AND id_promotie='$prom_id' AND EXISTS(SELECT id_disciplina FROM fisediscipline WHERE fisediscipline.id_disciplina=discipline.id) ";
    $result = mysqli_query($dbCon->getCon(), $sql);

    while ($row = mysqli_fetch_array($result)) {
        $name = $row['denumire'];
        $id = $row['id'];
        $disc_array[] = array("name" => $name, "id" => $id);

    }
    echo json_encode($disc_array);
} elseif ($_POST['action'] == 'SEARCH') {
    $sql = "SELECT cod,denumire,id  FROM discipline WHERE id_specializare='$spec_id' AND id_promotie='$prom_id' ORDER BY cod ASC";
    $disciplines = mysqli_query($dbCon->getCon(), $sql);

    while ($row = mysqli_fetch_array($disciplines)) {

        $id_disc = $row['id'];
        $sql = "SELECT * FROM fisediscipline WHERE id_disciplina = '$id_disc'";
        $discipline_files = mysqli_query($dbCon->getCon(), $sql);

        if (mysqli_num_rows($discipline_files) == 0) {
            $disciplines_list[] = array("cod" => $row['cod'], "name" => $row['denumire'], "id" => $id_disc, "discipline_file" => 0);
        } else {
            $disciplines_list[] = array("cod" => $row['cod'], "name" => $row['denumire'], "id" => $id_disc, "discipline_file" => 1);
        }
    }
    echo json_encode($disciplines_list);
} elseif ($_POST['action'] == 'DELETE') {
    $id_disc = $_POST['id_disc'];
    $sql = "DELETE FROM fisediscipline WHERE id_disciplina = '$id_disc'";
    if($discipline_files = mysqli_query($dbCon->getCon(), $sql)){ echo json_encode('Fisa disciplinei a fost stearsa!');};

}
