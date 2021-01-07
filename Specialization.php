<?php
include 'resources\php\DbConnection.php';

class Specialization
{   
    public $name;
    private $conn;
    private $domain_id;
    private $abv_spec;
    private $progstudies;

    public function __construct()
    {
        $dbCon = new DbConnection();
        $this->conn = $dbCon->getCon();

    }

    function create($name,$abv_spec,$progstudies,$domain_id){



        $query="INSERT INTO specializari (denumire,abreviere,id_domeniu,id_programstudii) VALUES ('$name','$abv_spec','$domain_id','$progstudies') ";
        $create=mysqli_query($this->conn, $query);
        return($create);

    }

    function delete($id){
        $query="DELETE FROM specializari WHERE id='$id'";
        mysqli_query($this->conn, $query);
        $deleted=1;
        return($deleted);

    }



    function edit($id){
        $query="SELECT * FROM specializari WHERE id='$id'";
        $result=mysqli_query($this->conn, $query);

        return $result;
    }

    function update($id,$name,$domain_id,$abr,$progstudies){

        $dbCon = new DbConnection();



        $query="UPDATE specializari  SET denumire='$name', id_domeniu='$domain_id', abreviere='$abr', id_programstudii='$progstudies' WHERE id='$id'";
        mysqli_query($this->conn, $query);
        if(mysqli_query($this->conn, $query)){
            $update=1;
        } else $update=0;
        return $update;
    }
}
?>