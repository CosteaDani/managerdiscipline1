<?php

include "Discipline.php";


// ADAUGARE DISCIPLINE

if($_POST['action']=='CREATE'){
    $name = $_POST['name'];
    $specialization_id = $_POST['spec'];
    $ciclu_studii_id = $_POST['progstudii'];
    $credits = $_POST['credits'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $course = $_POST['course'];
    $lab = $_POST['laboratory'];
    $project = $_POST['project'];
    $seminary = $_POST['seminary'];
    $evaluation= $_POST['evaluation'];
    $obs = $_POST['obs'];
    $code=$_POST['code'];
    $weeks=$_POST['weeks'];
    $hours=$_POST['hours'];
    $practice=$_POST['practice'];
    $opt = $_POST['opt'];
    $research=$_POST['research'];



    $disciplina=new Discipline();
    $create=$disciplina->create($name,$specialization_id,$ciclu_studii_id,$credits,$year,$semester,$course,$lab,$project,$seminary,$evaluation,$obs,$code,$weeks,$hours,$practice, $opt,$research);

    if ($create==1) {
        $response='Disciplina ' . $name . ' a fost adaugata';

    }
    else{
        $response='Disciplina ' . $name . ' nu s-a putut adauga';

    }
    echo json_encode($response);
}

//DELETE DISCIPLINE

if ($_POST['action'] == 'DELETE') {

    $id = $_POST['disc_id'];
    $discipline = new Discipline();
    $delete = $discipline->delete($id);
    if ($delete==1) {
        $response='Disciplina a fost stearsa!';
        echo json_encode($response);
    }

}

//EDIT DISCIPLINE

if($_POST['action']=="EDIT"){
    $id=$_POST['id'];
    $discipline= new Discipline();
    $result=$discipline->edit($id);
    $row=$result->fetch_assoc();

    echo(json_encode($row));
}



elseif($_POST['action']=='UPDATE'){
    $id=$_POST['id'];
    $name = $_POST['name'];
    $specialization_id = $_POST['spec'];
    $ciclu_studii_id = $_POST['progstudii'];
    $credits = $_POST['credits'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $course = $_POST['course'];
    $lab = $_POST['laboratory'];
    $project = $_POST['project'];
    $seminary = $_POST['seminary'];
    $evaluation= $_POST['evaluation'];
    $obs = $_POST['obs'];
    $code=$_POST['code'];
    $practice=$_POST['practice'];
    $weeks=$_POST['weeks'];
    $hours=$_POST['hours'];
    $opt = $_POST['opt'];
    $research=$_POST['research'];

    $link= $_POST['link'];

    $disciplina=new Discipline();
    $update=$disciplina->update($id,$name,$specialization_id,$ciclu_studii_id,$credits,$year,$semester,$course,$lab,$project,$seminary,$evaluation,$obs,$code,$weeks,$hours,$practice,$opt,$research);

    if($update==1) {
        $response = 'Modificarile au fost salvate!';
    }
    else{
        $response = 'Nu s-au putut efectua modificari!';
    }
        $result = array("link" => $link, "response" => $response);

        echo(json_encode($result));

}




?>
