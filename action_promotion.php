<?php
include 'Promotion.php';

if($_POST['cicle']) {
    $cicle=$_POST['cicle'];
    if($cicle=='Licenta') {
        $start = $_POST['start'];
        $end = $_POST['end'];
    }
    elseif ($cicle=='Master'){
        $start = $_POST['start_M'];
        $end = $_POST['end_M'];
    }
    $promo = new Promotion();
    $create = $promo->create($start, $end, $cicle);



    echo(json_encode($create));}





//if($_POST['start_M'] && $_POST['end_M']) {
//$create_M=0;
//$start = $_POST['start_M'];
//$end = $_POST['end_M'];
//$promo = new Promotion();
//$create_M = $promo->create_M($start, $end);
// echo(json_encode($create_M));
//}



?>
