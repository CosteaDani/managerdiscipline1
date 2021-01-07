<?php
include 'resources\php\DbConnection.php';

class Discipline{
    public $name;
    public $specialization_id;
    public $promotion_id;
    public $ciclu_studii_id;
    public $credits;
    public $year;
    public $semester;
    public $course;
    public $lab;
    public $project;
    public $seminary;
    public $evaluation;
    public $obs;
    public $code;
    public $practice;
    public $opt;
    public $research;

    private $conn;

    public function __construct()
    {
        $dbCon = new DbConnection();
        $this->conn = $dbCon->getCon();

    }

    function create($name,$specialization_id,$ciclu_studii_id,$credits,$year,$semester,$course,$lab,$project,$seminary,$evaluation,$obs,$code,$weeks,$hours,$practice,$opt,$research){
        if($year==4){
        $total=$credits*26;}
        else {$total=$credits*25; }
        $total_course=$course*14;
        $total_apl=14*(intval($lab)+intval($seminary)+intval($project))+intval($practice)+intval($research);
        $st_ind=$total-$total_course-$total_apl;
        $dbCon = new DbConnection();
        $sql = "SELECT * FROM promotii WHERE id_ciclu_studii='$ciclu_studii_id' ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($dbCon->getCon(), $sql)->fetch_assoc();
        $promotion_id = $result['id'];
        $period= $weeks . ' sapt. x ' . $hours . ' ore= ';
        $query="INSERT INTO discipline (denumire,id_specializare,id_promotie,id_ciclu_studii,nr_credite,an,semestru,ore_curs,ore_seminar,ore_laborator,ore_proiect,evaluare,obs,total_ore,studiu_individual,total_ore_curs,total_ore_aplicatii,cod,perioada_practica,practica,optionalitate,cercetare) VALUES ('$name','$specialization_id', '$promotion_id','$ciclu_studii_id',' $credits','$year','$semester','$course','$seminary','$lab','$project','$evaluation','$obs','$total','$st_ind','$total_course','$total_apl','$code','$period','$practice','$opt','$research')";

        if(mysqli_query($this->conn, $query)){
            $create=1;
        } else $create=0;
        return $create;

    }
    function delete($id){
        $query="DELETE FROM discipline WHERE id='$id'";
        if (mysqli_query($this->conn, $query)){

            $deleted = 1;
        }
        return($deleted);


    }

    function edit($id){
        $query="SELECT * FROM discipline WHERE id='$id'";
        $result=mysqli_query($this->conn, $query);

        return $result;
    }



    function update($id,$name,$specialization_id,$ciclu_studii_id,$credits,$year,$semester,$course,$lab,$project,$seminary,$evaluation,$obs,$code,$weeks,$hours,$practice,$opt,$research){
        if($year==4){
            $total=$credits*26;}
        else {$total=$credits*25; }

        $total_course=$course*14;
        $total_apl=14*($lab+$seminary+$project);
        $st_ind=$total-$total_course-$total_apl;

        $period= $weeks . ' sapt. x ' . $hours . ' ore= ';



        $query="UPDATE discipline SET denumire='$name', id_specializare='$specialization_id', id_ciclu_studii='$ciclu_studii_id', nr_credite='$credits', an ='$year', semestru='$semester', ore_curs='$course', ore_seminar='$seminary', ore_laborator='$lab', ore_proiect='$project', evaluare='$evaluation', obs='$obs',total_ore='$total', studiu_individual='$st_ind', total_ore_curs='$total_course', total_ore_aplicatii='$total_apl', cod='$code', practica='$practice', optionalitate='$opt',cercetare='$research', perioada_practica='$period' WHERE id='$id'";


        mysqli_query($this->conn, $query);
        if(mysqli_query($this->conn, $query)){
            $update=1;
        } else $update=0;
        return $update;
    }



}?>