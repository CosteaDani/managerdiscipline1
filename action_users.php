<?php

include "User.php";


if(isset($_GET['submit'])){
    $name = $_GET['name'];
    $username = $_GET['username'];
    $rol=$_GET['rol'];


    $user=new User();
    $create=$user->create($name,$username,$rol);

    $from='univeristateatehnicacn@gmail.com';
    $subject = 'Account creditals';
    $message = 'Helloooo';
    $headers = "From: $from";
    mail($username, $subject, $message, $headers);

    header('location:utilizatori.php');


}



if($_POST['action']=="EDIT"){
    $id=$_POST['id'];
    $user= new User();
    $result=$user->edit($id);
    $row=$result->fetch_assoc();

    echo(json_encode($row));




}

elseif($_POST['action']=='UPDATE'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $username=$_POST['username'];
    $role=$_POST['role'];
    $user= new User();
    $result=$user->update($id,$name,$username,$role);
    if($result==1){
   $response='Modificarile au fost salvate!';}
    echo(json_encode($response));




}


if ($_POST['action'] == 'DELETE') {
    $id = $_POST['user_id'];
    $user = new User();
    $delete = $user->delete($id);
    if ($delete==1) {
        $response='Utilizatorul a fost șters!';
        echo json_encode($response);
    }

}



?>
