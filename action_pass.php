<?php

include 'User.php';

if($_POST['action']=='SUBMIT') {
    $old_pass = $_POST['oldPass'];
    $new_pass = $_POST['newPass'];
    $confirm_pass = $_POST['confirmPass'];


    $user= new User();
    $result=$user->changePass($old_pass,$new_pass,$confirm_pass);


    if($result == 1){
        $response = 'Modificarile au fost salvate!';
        echo(json_encode($response));

        }
       else {
           echo json_encode('wtf');


}
}

?>