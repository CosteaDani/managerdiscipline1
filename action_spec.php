<?php
include 'Specialization.php';

//ADAUGARE SPECIALIZARE

if($_POST['action'] == 'CREATE') {
    $name = $_POST['name'];
    $abv_spec = $_POST['abr'];
    $progstudies = $_POST['progstudies'];
    $domain_id = $_POST['domain'];


    $specializari=new Specialization();
    $create=$specializari->create($name,$abv_spec,$progstudies,$domain_id);

    if ($create == 1) {
        $response='Specializarea a fost creata!';
    }
    echo json_encode($response);


}

// STERGERE SPECIALIZARE

if($_POST['action'] == 'DELETE') {
    $id = $_POST['spec_id'];

    $spec = new Specialization();
    $delete = $spec->delete($id);
    if ($delete==1) {
        $response='Specializarea a fost stearsa!';
        echo json_encode($response);
    }
}


//EDIT SPEC

if($_POST['action']=="EDIT"){
    $id=$_POST['id'];
    $spec= new Specialization();
    $result=$spec->edit($id);
    $row=$result->fetch_assoc();

    echo(json_encode($row));
}



elseif($_POST['action']=='UPDATE'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $domain_id=$_POST['domain_id'];
    $abr=$_POST['abr'];
    $progstudies=$_POST['progstudies'];

    $spec= new Specialization();
    $result=$spec->update($id,$name,$domain_id,$abr,$progstudies);
    if($result==1){
   $response='Modificarile au fost salvate!';}
    echo(json_encode($response));

}

?>

