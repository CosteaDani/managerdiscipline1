<?php
include 'resources\php\DbConnection.php';

class Domain
{
    public $name;
    private $conn;
    public $ciclu_studii_id;

    public function __construct()
    {
        $dbCon = new DbConnection();
        $this->conn = $dbCon->getCon();

    }

    function create($name,$ciclu_studii_id){
        $query="INSERT INTO domenii (denumire,id_ciclu_studii) VALUES ('$name','$ciclu_studii_id') ";
        mysqli_query($this->conn, $query);
    }

    function delete($id_domain){
        $query="DELETE FROM domenii WHERE id='$id_domain'";
        $query2="DELETE FROM specializari where id_domeniu='$id_domain'";
       mysqli_query($this->conn, $query);
       mysqli_query($this->conn, $query2);
       $deleted=1;
       return($deleted);


    }


    function edit($id){
        $query="SELECT * FROM domenii WHERE id='$id'";
        $result=mysqli_query($this->conn, $query);

        return $result;
    }

    function update($id,$name,$progstudii_id){
        $query="UPDATE domenii  SET denumire='$name', id_ciclu_studii='$progstudii_id' WHERE id='$id'";
        mysqli_query($this->conn, $query);
        if(mysqli_query($this->conn, $query)){
            $update=1;
        } else $update=0;
        return $update;
    }




}?>