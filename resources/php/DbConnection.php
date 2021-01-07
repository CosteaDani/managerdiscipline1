<?php


class DbConnection{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function Connect(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "managerdiscipline";

        $con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        return $con;
    }

    public function getCon(){
        return $this->Connect();
    }

}
