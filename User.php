<?php
include 'resources\php\DbConnection.php';

class User extends DbConnection
{

    private $username;
    private $password;
    private $user_type;

    public function logIn()
    {
        session_start();
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $sql = "SELECT * FROM utilizatori WHERE cont_utilizator = '$user' AND parola = '$pass'";
        $result = mysqli_query($this->Connect(), $sql);

        if (mysqli_num_rows($result) == 1) {


            $qry = mysqli_fetch_array($result);
            $_SESSION['username'] = $qry['cont_utilizator'];
            $_SESSION['user_pass'] = $qry['parola'];
            $_SESSION['user_role'] = $qry['rol'];


    };
        return (mysqli_num_rows($result));}

    function create($name,$username,$rol){


        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $password = "";
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $password[$i] = $alphabet[$n];
        }

        $query="INSERT INTO utilizatori (nume,cont_utilizator,parola,rol) VALUES ('$name','$username','$password','$rol')";
        mysqli_query($this->getCon(), $query);
    }

    function edit($id){
        $query="SELECT * FROM utilizatori WHERE id='$id'";
        $result=mysqli_query($this->getCon(), $query);

        return $result;
    }

    function update($id,$name,$username,$role){
        $query="UPDATE utilizatori  SET nume='$name', cont_utilizator='$username', rol=$role WHERE id='$id'";
        mysqli_query($this->getCon(), $query);
        if(mysqli_query($this->getCon(), $query)){
            $update=1;
        } else $update=0;
        return $update;
    }

    function delete($id_user){
        $query="DELETE FROM utilizatori WHERE id='$id_user'";

        if( mysqli_query($this->getCon(), $query)){
        $deleted=1;} else $deleted=0;
        return($deleted);
    }
    function changePass($old_pass,$new_pass,$confirm_pass){
        session_start();

        $validate=0;
        $account=$_SESSION['username'];
        if($old_pass == $_SESSION['user_pass'] && $new_pass == $confirm_pass){

            $query="UPDATE utilizatori  SET parola='$new_pass' WHERE cont_utilizator='$account'";
            mysqli_query($this->getCon(), $query);
            $validate=1;
        }
        return $validate;

    }


}
