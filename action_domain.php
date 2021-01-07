<?php

include "Domain.php";



//ADAUGARE DOMENIU
if (isset($_GET['submit_domain'])) {
    $dbCon = new DbConnection();
    $name = $_GET['name'];
    $ciclu_studii_id = $_GET['progstudii'];

    $domenii = new Domain();
    $check=(mysqli_query($dbCon->getCon(),"SELECT * FROM domenii where denumire='$name' and id_ciclu_studii='$ciclu_studii_id'"));
    if(mysqli_num_rows($check)==0){
    $create = $domenii->create($name,$ciclu_studii_id);}


    header('location:domenii_spec.php');
}

//DELETE DOMENIU

if ($_POST['action'] == 'DELETE') {


    $id = $_POST['domain_id'];
    $domain = new Domain();
    $delete = $domain->delete($id);
    if ($delete==1) {
        $response='Domeniul si specializarile au fost sterse!';
        echo json_encode($response);
    }

}

//EDIT DOMENIU

if($_POST['action']=="EDIT"){
    $id=$_POST['id'];
    $domain= new Domain();
    $result=$domain->edit($id);
    $row=$result->fetch_assoc();

    echo(json_encode($row));
}



elseif($_POST['action']=='UPDATE'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $progstudii_id = $_POST['ciclu_studii_id'];

    $domain= new Domain();
    $result=$domain->update($id,$name,$progstudii_id);
    if($result==1){
   $response='Modificarile au fost salvate!';}
    echo(json_encode($response));

}


?>