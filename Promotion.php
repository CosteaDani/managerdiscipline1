<?php
include 'resources\php\DbConnection.php';

class Promotion
{
    public $start;
    public $end;
    private $conn;

    public function __construct()
    {
        $dbCon = new DbConnection();
        $this->conn = $dbCon->getCon();

    }

    function create($start, $end, $cicle)
    {

        $sql = "SELECT * FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='$cicle') ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($this->conn, $sql)->fetch_assoc();
        if (($result['inceput'] == $start) && ($result['sfarsit'] == $end)) {
            $create = 0;
        } elseif (($result['inceput'] != $start) && ($result['sfarsit'] != $end)) {

            $dbCon = new DbConnection();
            $sql1 = "SELECT * FROM ciclu_studii WHERE denumire='$cicle' ";
            $result1 = mysqli_query($dbCon->getCon(), $sql1)->fetch_assoc();
            $progstudies = $result1['id'];

            $query = "INSERT INTO promotii (inceput,sfarsit,id_ciclu_studii) VALUES ('$start','$end',$progstudies) ";
            if (mysqli_query($this->conn, $query)) {
                $create = 1;
            }
        }

        return ($create);
    }
}
//
