<?php
/**
 * Created by PhpStorm.
 * Date: 1/12/2020
 * Time: 5:11 PM
 */
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$domain = $_GET['domain'];
$dean=$_GET['dean'];
$director=$_GET['director'];
$rector=$_GET['rector'];
$id_spec = $_GET['id_spec'];
$year = $_GET['year'];
$abr=(mysqli_query($dbCon->getCon(), "SELECT abreviere FROM specializari WHERE id = '$id_spec' "))->fetch_assoc();
if($_GET['degree_level'] == 'Licenta') {
    $sql = "SELECT *  FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Licenta') ORDER BY id DESC LIMIT 1";
//   $result = mysqli_query($dbCon->getCon(), $sql)->fetch_assoc();
}
else {
    $sql = "SELECT * FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Master') ORDER BY id DESC LIMIT 1";
//    $result = mysqli_query($dbCon->getCon(), $sql)->fetch_assoc();
}

$promotion = mysqli_query($dbCon->getCon(), $sql)->fetch_assoc();
$id_promotion=$promotion['id'];
$start=$promotion['inceput'];
$promotion=$promotion['inceput'].'-'.$promotion['sfarsit'];

$disciplines = mysqli_query($dbCon->getCon(), "SELECT * FROM discipline WHERE id_specializare = '$id_spec' AND an = '$year' AND(optionalitate='DOB' OR optionalitate='DOP') AND id_promotie='$id_promotion'  ORDER BY cod ASC ");
$facultative=mysqli_query($dbCon->getCon(), "SELECT * FROM discipline WHERE id_specializare = '$id_spec' AND an = '$year' AND(optionalitate='FAC') AND id_promotie='$id_promotion' ORDER BY cod ASC ");

$spec= mysqli_query($dbCon->getCon(), "SELECT denumire FROM specializari WHERE id='$id_spec' ")->fetch_assoc();
$domain_name=mysqli_query($dbCon->getCon(), "SELECT denumire FROM domenii WHERE id='$domain' ")->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>


    <script src="resources\js\jquery-3.4.1.min.js"></script>
    <script src="resources\js\bootstrap.min.js"></script>
    <script src="resources\js\menu.js"></script>
    <script src="resources\js\semantic.min.js"></script>
    <script>
        $(function () {
            $("#nav-bar").load("resources\\nav_bar.php");
        });
    </script>

    <link rel="stylesheet" type="text/css" href="resources\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources\css\curriculum.css">
    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">
    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">
    <link rel="stylesheet" type="text/css" href="resources\css\semantic.min.css">


</head>
<body>
<div class="container">
    <div id="nav-bar"></div>
    <br><br><br>
    <div style="font-weight: bold" class="main" id="curriculum">
        <img width="5%" style="margin-top: 0px" src="resources/logo_IE.jpg">
       <div id="wrapper">
           <div id="first">
           <p >Universitatea Tehnica din Cluj-Napoca </p>
           <p>Facultatea: Inginerie Electrica</p>
           <p>Domeniul:<?php  echo $domain_name['denumire'];?></p>
           <p>Program licenta:<?php echo $spec['denumire']; ?> </p>
           </div>

           <div id="second">
               <div   id="title">PLAN de ÎNVĂŢĂMÂNT</div>
               <div id="date"><?php $today=new DateTime('now'); echo($today->format('d.m.Y')); ?></div>
           </div>


        <div id="third">
            <div>Valabil pentru anul universitar</div>
            <div><?php $first_year=$start+$year-1; echo $first_year.'-'.($first_year+1); ?></div>
        </div>
       </div>



        <input id="abr" type="hidden" value="<?php echo $abr['abreviere']?>">
        <table class="curriculum-table" id="plan_invatamant" style="width: 100%; text-align: center;" >
            <thead>
            <tr>
                <th width="4%"rowspan="3">Nr.crt</th>
                <th width="22%" rowspan="3">Denumirea disciplinei</th>
                <th width="30%" colspan="10">Anul <?php echo $year?></th>
                <th width="12%" colspan="3" rowspan="2">Evaluare</th>
                <th width="16%" colspan="4" rowspan="2">Nr. ore/disciplina</th>
                <th width="8%" colspan="2" rowspan="2">Credite/sem.</th>
                <th width="8%" rowspan="3">Obs.</th>
            </tr>
            <tr>
                <th width="15%" colspan="5">Sem.1(14 sapt.)</th>
                <th width="15%" colspan="5">Sem.2(14 sapt.)</th>
            </tr>
            <tr>
                <th >C</th>
                <th>S</th>
                <th>L</th>
                <th>P</th>
                <th>Pr</th>
                <th>C</th>
                <th>S</th>
                <th>L</th>
                <th>P</th>
                <th>Pr</th>
                <th>E</th>
                <th>C</th>
                <th>V</th>

                <th >Total</th>
                <th >C</th>
                <th >Apl.</th>
                <th >St.ind.</th>
                <th>1</th>
                <th>2</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>
                <th>18</th>
                <th>19</th>
                <th>20</th>
                <th>21</th>
                <th>22</th>
            </tr></thead>
            <tbody>
            <?php $counter = 1;
            $total_sum=0;
            $total_stind=0;
            $total_curs=0;
            $total_apl=0;
            $curs_s1=0;
            $sem_s1=0;
            $lab_s1=0;
            $proj_s1=0;
            $pr_s1=0;
            $curs_s2=0;
            $sem_s2=0;
            $lab_s2=0;
            $proj_s2=0;
            $pr_s2=0;
            $total_E1=0;
            $total_C1=0;
            $total_V1=0;
            $total_E2=0;
            $total_C2=0;
            $total_V2=0;
            $total_crd1 = 0;
            $total_crd2 = 0;
            while ($discipline = $disciplines->fetch_assoc()) {
                $id_disc = $discipline['id'];



                ?>
                <tr> <?php $path_code= $discipline['cod']; if ($path_code<10) $path_code='0'.$path_code;?>

                    <td> <?php echo $discipline['cod']; ?></td>
                    <td style="text-align: left;"><a href="/managerdiscipline/resources/pi/<?php echo $promotion?>/<?php echo $abr['abreviere']?>/<?php echo $abr['abreviere'].$path_code?>.pdf"> <?php echo $discipline['denumire']; ?> </a></td>
                    <?php if ($discipline['semestru'] == 1) { ?>
                        <td><?php echo $discipline['ore_curs']; if((($discipline['cod'] - floor($discipline['cod']))==0)||(($discipline['cod'] - floor($discipline['cod']))==0.1)) {$curs_s1+=$discipline['ore_curs'];}?></td>
                        <td><?php echo $discipline['ore_seminar']; $sem_s1+=$discipline['ore_seminar']; ?></td>
                        <td><?php echo $discipline['ore_laborator']; $lab_s1+=$discipline['ore_laborator']; ?></td>
                        <td><?php echo $discipline['ore_proiect']; $proj_s1+=$discipline['ore_proiect']; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php } else { if($discipline['practica']!=0){?><td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="5"><?php  echo $discipline['perioada_practica'] .  $discipline['practica'];?></td>

                   <?php } else{ ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $discipline[''] ; if(((($discipline['cod']-floor($discipline['cod'])))==doubleval(0.1))){ $curs_s2+=$discipline['ore_curs'];};?></td>
                        <td><?php echo $discipline['ore_seminar']; $sem_s2+=$discipline['ore_seminar'];?></td>
                        <td><?php echo $discipline['ore_laborator']; $lab_s2+=$discipline['ore_laborator'];?></td>
                        <td><?php echo $discipline['ore_proiect']; $proj_s2+=$discipline['ore_proiect'];?></td>
                        <td></td>
                    <?php }}
                    if ($discipline['evaluare'] == 'E') {
                        if($discipline['semestru']==1){$total_E1++;} else{$total_E2++;} ?>

                        <td>N</td>
                        <td></td>
                        <td></td>
                    <?php } elseif ($discipline['evaluare'] == 'C') {
                        if($discipline['semestru']==1){$total_C1++;} else{$total_C2++;}?>

                        <td></td>
                        <td>N</td>
                        <td></td>
                    <?php } elseif ($discipline['evaluare'] == 'V') {
                        if($discipline['semestru']==1){$total_V1++;} else{$total_V2++;}?>

                        <td></td>
                        <td></td>
                        <td>A/R</td>
                    <?php }?>

                        <td><?php echo $discipline['total_ore'] ; $total_sum+=$discipline['total_ore'];?></td>
                        <td><?php echo $discipline['total_ore_curs']; $total_curs+=$discipline['total_ore_curs'] ?> </td>
                        <td><?php echo $discipline['total_ore_aplicatii']; $total_apl+=$discipline['total_ore_aplicatii']?> </td>
                        <td><?php echo $discipline['studiu_individual'] ; $total_stind+=$discipline['studiu_individual'] ?></td>

                    <?php if ($discipline['semestru'] == 1) { ?>
                        <td><?php echo $discipline['nr_credite'];
                            $total_crd1 += $discipline['nr_credite']; ?></td>
                        <td></td>
                    <?php } else { ?>
                        <td></td>
                        <td><?php echo $discipline['nr_credite'];
                            $total_crd2 += $discipline['nr_credite']; ?></td>
                    <?php } ?>
                    <td><?php echo $discipline['obs']; ?></td>
                </tr>
                <?php $counter++;
            } ?>
            <tr>
                <td style="text-align: center" rowspan="2" colspan="2">TOTAL AN</td>
                <td><?php echo $curs_s1;?></td>
                <td><?php echo $lab_s1;?></td>
                <td><?php echo $sem_s1;?></td>
                <td><?php echo $proj_s1;?></td>
                <td><?php echo $pr_s1;?></td>
                <td><?php echo $curs_s2;?></td>
                <td><?php echo $lab_s2;?></td>
                <td><?php echo $sem_s2;?></td>
                <td><?php echo $proj_s2;?></td>
                <td><?php echo $pr_s2;?></td>
                <td colspan="3"><?php echo "sem1 ".$total_E1."E+".$total_C1."C+".$total_V1."V";?></td>

                <td><?php echo $total_sum; ?></td>
                <td><?php echo $total_curs; ?></td>
                <td><?php echo $total_apl; ?></td>
                <td><?php echo $total_stind; ?></td>
                <td><?php echo $total_crd1; ?></td>
                <td><?php echo $total_crd2; ?></td>
            </tr>

            <tr>

                <td style="text-align: center" colspan="5"> <?php echo$curs_s1+$lab_s1+$proj_s1+$sem_s1; ?></td>
                <td style="text-align: center" colspan="5"> <?php echo$curs_s2+$lab_s2+$proj_s2+$sem_s2; ?></td>
                <td colspan="3"><?php echo "sem2 ".$total_E2."E+".$total_C2."C+".$total_V2."V";?></td>

            </tr>

            </tbody>
        </table>
<br><br>
        <table class="curriculum-table" style="width: 100%; text-align: center">
<!--            <colgroup>-->
<!--                <col width="3%">-->
<!--                <col width="25%">-->
<!--                <col span="10" width="3%">-->
<!--                <col span="3" width="3%">-->
<!--                <col span="4" width="4%">-->
<!--                <col span="2" width="5%">-->
<!--                <col width="10%">-->
<!--            </colgroup>-->
    <tr><?php while ($facultatives = $facultative->fetch_assoc()) {
         $path_code= $facultatives['cod'];
//        if ($path_code<10) $path_code='0'.$path_code;?>

        <td width="4%"> <?php echo $facultatives['cod']; ?></td>
        <td style="text-align: left;" width="22%"><a href="/managerdiscipline/resources/pi/<?php echo $promotion?>/<?php echo $abr['abreviere']?>/<?php echo $abr['abreviere'].$path_code?>.pdf"> <?php echo $facultatives['denumire']; ?> </a></td>
        <?php if ($facultatives['semestru'] == 1) { ?>
        <td width="3%"><?php echo $facultatives['ore_curs']; ?></td>
        <td width="3%"><?php $facultatives['ore_seminar'];  ?></td>
        <td width="3%"><?php $facultatives['ore_laborator'];  ?></td>
        <td width="3%"><?php $facultatives['ore_proiect'];  ?></td>
        <td width="3%"></td>
        <td width="3%"> </td>
        <td width="3%"></td>
        <td width="3%"></td>
        <td width="3%"></td>
        <td width="3%"></td>
        <?php } else { ?>
        <td width="3%"></td>
        <td width="3%"></td>
        <td width="3%"></td>
        <td width="3%"></td>
        <td width="3%"></td>
        <td width="3%"><?php echo $facultatives['ore_curs']; ?></td>
        <td width="3%"><?php echo $facultatives['ore_seminar']; ?></td>
        <td width="3%"><?php echo $facultatives['ore_laborator']; ?></td>
        <td width="3%"><?php echo $facultatives['ore_proiect']; ?></td>
        <td width="3%"></td>
        <?php }
        if ($facultatives['evaluare'] == 'E') {?>

        <td  width="4%" >N</td>
        <td  width="4%" ></td>
        <td  width="4%" ></td>
        <?php } elseif ($facultatives['evaluare'] == 'C') {?>

        <td  width="4%"></td>
        <td  width="4%">N</td>
        <td  width="4%"></td>
        <?php } elseif ($discipline['evaluare'] == 'V') {?>

        <td></td>
        <td></td>
        <td>A/R</td>
        <?php }?>

        <td width="4%"><?php echo $facultatives['total_ore'] ; ?></td>
        <td width="4%"><?php echo $facultatives['total_ore_curs'];  ?> </td>
        <td width="4%"><?php echo $facultatives['total_ore_aplicatii']; ?> </td>
        <td width="4%"> <?php echo $facultatives['studiu_individual'] ;  ?></td>

        <?php if ($facultatives['semestru'] == 1) { ?>
        <td width="4%"><?php echo $facultatives['nr_credite'];
            ?></td>
        <td width="4%"></td>
        <?php } else { ?>
        <td width="4%"></td>
        <td width="4%"><?php echo $facultatives['nr_credite'];
             ?></td>
        <?php } ?>
        <td width="8%"><?php echo $facultatives['obs']; ?></td></tr>
        <?php  }?>

    </tr>

        </table>

        <div id="names">
            <div id="rector">
                <?php echo 'RECTOR '.$rector; ?>

            </div>

            <div id="dean">
                <?php echo 'DECAN '.$dean; ?>

            </div>

            <div id="director">
                <?php echo 'Director Departament '.$director; ?>

            </div>

        </div>

    </div>
    <br>
    <button type="submit" class="btn btn-primary col-md-1" style="margin-left: 45%" id="savepdf">Salvare</button>
</div>

<script>

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    $(document).ready(function () {
        var abr=$('#abr').val();
        console.log(abr);


        $('#savepdf').click(function (e) {
            e.preventDefault();
            $('#curriculum').addClass('curriculum');
            $('#names').addClass('names');

            var htmlContent = $("#curriculum").html();

            $('#curriculum').removeClass('curriculum');
            $('#names').removeClass('names');

            $.ajax({
                type: 'POST',
                url: 'create_pdf.php',
                data: {"htmlContent": htmlContent,"id_spec" : urlParams.get('id_spec'), "year": urlParams.get('year'),"abr":abr},
                dataType: 'html',
                cache: false,
                success: function (result) {
                    console.log(result);
                    window.open(result);
                },
            });
        });
    });
</script>