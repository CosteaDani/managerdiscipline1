<?php

include 'resources\php\DbConnection.php';
$dbCon = new DbConnection();
$cicle=$_POST['cicle'];
if($cicle=='Licenta') {

    $new_promotion = mysqli_query($dbCon->getCon(), "SELECT * FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Licenta') ORDER BY id DESC LIMIT 1")->fetch_assoc();
    $old_promotion = mysqli_query($dbCon->getCon(), "SELECT * FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Licenta') ORDER BY id DESC LIMIT 1,1")->fetch_assoc();
}
elseif($cicle=='Master'){
    $new_promotion = mysqli_query($dbCon->getCon(), "SELECT * FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Master') ORDER BY id DESC LIMIT 1")->fetch_assoc();
    $old_promotion = mysqli_query($dbCon->getCon(), "SELECT * FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Master') ORDER BY id DESC LIMIT 1,1")->fetch_assoc();

}

$old_promo_id=$old_promotion['id'];
$new_promo_id=$new_promotion['id'];
$new_disciplines="INSERT into discipline( denumire,id_specializare, id_promotie, an, semestru, cod, nr_credite, ore_curs, ore_seminar, ore_laborator, ore_proiect, total_ore, total_ore_curs, total_ore_aplicatii, studiu_individual, evaluare, obs,optionalitate,cercetare,id_ciclu_studii,practica) SELECT  denumire,id_specializare, '$new_promo_id', an, semestru, cod, nr_credite, ore_curs, ore_seminar, ore_laborator, ore_proiect, total_ore, total_ore_curs, total_ore_aplicatii, studiu_individual, evaluare, obs, optionalitate, cercetare, id_ciclu_studii, practica FROM discipline WHERE id_promotie='$old_promo_id'";

if(mysqli_query($dbCon->getCon(),$new_disciplines)){
    echo(json_encode('Disciplinele au fost adaugate cu succes'));}
else{
    echo(json_encode('Eroare'));}


?>