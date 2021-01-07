<?php include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();


$id_disc = explode(',', $_GET['id_disc']);
$id_spec = $_GET['id_spec'];
$promo = $_GET['id_promo'];


$discipline = mysqli_query($dbCon->getCon(), "SELECT * from discipline WHERE id = '$id_disc[0]' ")->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="resources\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">
    <link rel="stylesheet" type="text/css" href="resources\css\fisa_disc.css">
    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">
    <link rel="stylesheet" type="text/css" href="resources\css\semantic.min.css">

    <script src="resources\js\jquery-3.4.1.min.js"></script>
    <script src="resources\js\bootstrap.min.js"></script>
    <script src="resources\js\menu.js"></script>
    <script src="resources\js\semantic.min.js"></script>
    <script src="resources\js\myjs.js"></script>


</head>
<body>
<div class="container">
    <div id="nav-bar"></div>
</div>
<br><br>


<div class="container" id="fisa_disc">
    <div class="break_avoid">
        <table class="table-fisa-disc">
            <h4><b> 1.Date despre program</b></h4>
            <tbody>
            <tr>
                <td class="" style="width: 50%;">  1.1 Instituţia de învăţământ superior</td>
                <td class="input_td ">  Universitatea Tehnică din Cluj-Napoca</td>
            </tr>
            <tr>
                <td>  1.2 Facultatea</td>
                <td class="input_td">  Facultatea de Inginerie Electrică</td>
            </tr>
            <tr>
                <td>  1.3 Departamentul</td>
                <td class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td>  1.4 Domeniul de studii</td>
                <td id="domain">  Se va completa automat</td>
            </tr>
            <tr>
                <td>  1.5 Ciclul de studii</td>
                <td class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td>  1.6 Programul de studii / Calificarea</td>
                <td id="spec" class="input_td">  Se va completa automat</td>
            </tr>
            <tr>
                <td>  1.7 Forma de învăţământ</td>
                <td class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td>  1.8 Codul disciplinei</td>
                <td class="input_td">  <?php echo $discipline['cod'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div class="break_avoid">
        <div class="break_avoid">
            <table class="table-fisa-disc">
                <h4><b>  2. Date despre disciplină </b></h4>
                <tbody>
                <tr>
                    <td colspan="3" style="width: 55%">  2.1 Denumirea disciplinei</td>
                    <td colspan="3" style="width: 45%" class="input_td">  <?php echo $discipline['denumire'] ?></td>
                </tr>
                <tr>
                    <td colspan="3">  2.2 Aria de conţinut</td>
                    <td colspan="3" class="input_td">
                        <pre class="pre_text"><span></span></pre>
                        <textarea type="text" class="input_element"></textarea></td>
                </tr>
                <tr>
                    <td colspan="3">  2.3 Titularul de curs</td>
                    <td colspan="3" class="input_td">
                        <pre class="pre_text"><span></span></pre>
                        <textarea type="text" class="input_element"></textarea></td>
                </tr>
                <tr>
                    <td colspan="3">  2.4 Titularul activităţilor de seminar / laborator / proiect</td>
                    <td colspan="3" class="input_td">
                        <pre class="pre_text"><span></span></pre>
                        <textarea type="text" class="input_element"></textarea></td>
                </tr>
                <tr>
                    <td width=25%>  2.5 Anul de studiu</td>
                    <td width=5% class="input_td">  <?php echo $discipline['an'] ?></td>
                    <td width=25%>  2.6 Semestrul</td>
                    <td width=5% class="input_td">  <?php echo $discipline['semestru'] ?></td>
                    <td width=30%>  2.7 Tipul de evaluare</td>
                    <td width=10% class="input_td">  <?php echo $discipline['evaluare'] ?></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="2">  2.8 Regimul disciplinei</td>
                    <td colspan="3">  Categoria formativă</td>
                    <td>  <?php echo $discipline['obs'] ?></td>
                </tr>
                <tr>
                    <td colspan="3">  Opționalitate</td>
                    <td class="input_td">  <?php echo $discipline['optionalitate'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <div class="break_avoid">
        <h4><b>3. Timpul total estimat</b></h4>
        <table class="table-fisa-disc">
            <tbody>
            <tr>
                <td width=25%>3.1 Număr de ore pe săptămână</td>
                <td style="text-align: center" width=5%
                    class="input_td">  <?php echo $discipline['ore_curs'] + $discipline['ore_proiect'] + $discipline['ore_seminar'] + $discipline['ore_laborator'] ?></td>
                <td style="text-align: center" width=10%>  din care:</td>
                <td style="text-align: center" width=10%>  3.2 <br>Curs</td>
                <td style="text-align: center" width=5%>  <?php
                    if ($discipline['ore_curs'] == 0) {
                        echo "";
                    } else echo $discipline['ore_curs'] ?></td>
                <td style="text-align: center" width=10%>3.3 <br>  Seminar</td>
                <td style="text-align: center" width=5%>  <?php if ($discipline['ore_seminar'] == 0) {
                        echo "";
                    } else echo $discipline['ore_seminar'] ?></td>
                <td style="text-align: center" width=10%>3.3 <br>Laborator</td>
                <td style="text-align: center" width=5%>  <?php if ($discipline['ore_laborator'] == 0) {
                        echo "";
                    } else echo $discipline['ore_laborator'] ?></td>
                <td style="text-align: center" width=10%>3.3<br>Proiect</td>
                <td width=5%>  <?php if ($discipline['ore_proiect'] == 0) {
                        echo "";
                    } else echo $discipline['ore_proiect'] ?></td>
            </tr>
            <tr>
                <td  width=25%>3.4 Număr de ore pe semestru</td>
                <td style="text-align: center" width=5%>  <?php echo $discipline['total_ore'] ?></td>
                <td style="text-align: center" width=10%>din care:</td>
                <td style="text-align: center" width=10%>3.5 <br>Curs</td>
                <td style="text-align: center" width=5%>  <?php if ($discipline['ore_curs'] == 0) {
                        echo "";
                    } else echo $discipline['ore_curs'] * 14 ?></td>
                <td style="text-align: center" width=10%>  3.6 <br>Seminar</td>
                <td style="text-align: center"  width=5%>  <?php if ($discipline['ore_seminar'] == 0) {
                        echo "";
                    } else echo $discipline['ore_seminar'] * 14 ?></td>
                <td style="text-align: center" width=10%>  3.6 <br>Laborator</td>
                <td style="text-align: center" width=5%>  <?php if ($discipline['ore_laborator'] == 0) {
                        echo "";
                    } else echo $discipline['ore_laborator'] * 14 ?></td>
                <td style="text-align: center" width=10%>3.6<br>Proiect</td>
                <td style="text-align: center" width=5%>  <?php if ($discipline['ore_proiect'] == 0) {
                        echo "";
                    } else echo $discipline['ore_proiect'] * 14 ?></td>
            </tr>
            <tr>
                <td colspan="10">3.7 Distribuţia fondului de timp (ore pe semestru) pentru:</td>
                <td colspan="2" class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td colspan="10">(a) Studiul după manual, suport de curs, bibliografie şi notiţe</td>
                <td colspan="2" class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td colspan="10">(b) Documentare suplimentară în bibliotecă, pe platforme electronice de specialitate şi
                    pe
                    teren
                </td>
                <td colspan="2" class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td colspan="10">(c) Pregătire seminarii / laboratoare, teme, referate, portofolii şi eseuri</td>
                <td colspan="2" class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td colspan="10">  (d) Tutoriat</td>
                <td colspan="2" class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td colspan="10">  (e) Examinări</td>
                <td colspan="2" class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td colspan="10">  (f) Alte activităţi:</td>
                <td colspan="2" class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            </tbody>
        </table>
        <table style="border-top:none;width:60%;" class="table-fisa-disc">
            <tbody>
            <tr>
                <td style="width: 80%">  3.8 Total ore studiu individual (suma (3.7(a)…3.7(f)))</td>
                <td style="width: 20%">  <?php echo $discipline['studiu_individual'] ?></td>
            </tr>
            <tr>
                <td>  3.9 Total ore pe semestru (3.4+3.8)</td>
                <td>  <?php echo $discipline['total_ore'] ?></td>
            </tr>
            <tr>
                <td>  3.10 Numărul de credite</td>
                <td>  <?php echo $discipline['nr_credite'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <br>
    <div class="break_avoid">
        <h4><b>  4. Precondiţii </b></h4>
        <table class="table-fisa-disc">
            <tbody>
            <tr>
                <td width=30%>  4.1 de curriculum</td>
                <td class="input_td" width="70%">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td>  4.2 de competenţe</td>
                <td class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="break_avoid">
        <h4><b>  5. Condiţii </b></h4>
        <table class="table-fisa-disc">
            <tbody>
            <tr>
                <td >  5.1. de desfăşurare a cursului</td>
                <td class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            <tr>
                <td>  5.2. de desfăşurare a seminarului / laboratorului / proiectului</td>
                <td class="input_td">
                    <pre class="pre_text"><span></span></pre>
                    <textarea type="text" class="input_element"></textarea></td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="break_avoid">
        <h4><b>  6. Competenţele specifice acumulate</b></h4>
        <table class="table-fisa-disc">
            <tbody>
            <tr>
                <td  class="vertical">
                    <div  class="vertical">Competenţe profesionale</div>
                </td>
                <td class="comp_td" >
                    <div class="comp"></div>
                    <select class="td_select">
                        <option></option>
                        <option id="option" value="Capacitatea de a identifica, formula și de a rezolva probleme de inginerie în abordare
        sistemică.">Capacitatea de a identifica, formula și de a rezolva probleme de inginerie în abordare
                            sistemică.
                        </option>
                        <option value="Capacitatea de a aplica cunoștințele de inginerie, ştiinţe inginereşti şi informatică aplicată.">
                            Capacitatea de a aplica cunoștințele de inginerie, ştiinţe inginereşti şi informatică
                            aplicată.
                        </option>
                        <option value="Capacitatea de a utiliza tehnicile, abilitățile și instrumentele moderne de inginerie necesare
      pentru practica inginerească.">Capacitatea de a utiliza tehnicile, abilitățile și instrumentele moderne de
                            inginerie necesare
                            pentru practica inginerească.
                        </option>
                        <option value="Capacitatea de a proiecta și efectua experimente, precum și de a analiza și interpreta
informaţiile obținute.">Capacitatea de a proiecta și efectua experimente, precum și de a analiza și interpreta
                            informaţiile obținute.
                    </select><br>
                    <div style="padding-bottom: 5px" class="comp"></div>
                    <select class="td_select">
                        <option></option>
                        <option value="Capacitatea de a aborda şi gestiona aplicaţii specifice de electrotehnică generală.">
                            Capacitatea de a aborda şi gestiona aplicaţii specifice de electrotehnică generală.
                        </option>
                        <option value="Capacitatea de a formula şi rezolva probleme specifice de electromagnetism aplicat de joasă
şi înaltă frecvenţă.">Capacitatea de a formula şi rezolva probleme specifice de electromagnetism aplicat de joasă
                            şi înaltă frecvenţă.
                        </option>
                        <option value="Capacitatea de a utiliza instrumente dedicate CAD/CAE/CAM pentru proiectare, modelare
numerică, optimizare în aplicaţii de inginerie electrică">Capacitatea de a utiliza instrumente dedicate CAD/CAE/CAM
                            pentru proiectare, modelare
                            numerică, optimizare în aplicaţii de inginerie electrică
                        </option>

                    </select><br>
                    <div  class="comp" ></div>
                    <select class="td_select">
                        <option></option>
                        <option value="Capacitatea de a aborda şi gestiona aplicaţii specifice de electrotehnică generală.">
                            Capacitatea de a aborda şi gestiona aplicaţii specifice de electrotehnică generală.
                        </option>
                        <option value="Capacitatea de a formula şi rezolva probleme specifice de electromagnetism aplicat de joasă
şi înaltă frecvenţă.">Capacitatea de a formula şi rezolva probleme specifice de electromagnetism aplicat de joasă
                            şi înaltă frecvenţă.
                        </option>
                        <option value="Capacitatea de a utiliza instrumente dedicate CAD/CAE/CAM pentru proiectare, modelare
numerică, optimizare în aplicaţii de inginerie electrică">Capacitatea de a utiliza instrumente dedicate CAD/CAE/CAM
                            pentru proiectare, modelare
                            numerică, optimizare în aplicaţii de inginerie electrică.
                        </option>

                    </select>


                </td>
            </tr>


            <tr>
                <td  class="vertical">
                    <div  class="vertical">Competenţe transversale</div>
                </td>
                <td>
                    <div class="comp"></div>
                    <select class="td_select">
                        <option></option>
                        <option value="Flexibilitate în a aborda şi utiliza în practică ultimele tehnologii existente în domeniile de
competenţă asumate"> Flexibilitate în a aborda şi utiliza în practică ultimele tehnologii existente în domeniile de
                            competenţă asumate
                        </option>
                        <option value="Capacitatea de a lucra în echipe inter şi plurii-disciplinare, de a comunica în mod eficient şi
de a înțelege responsabilitățile profesionale și de etică.">Capacitatea de a lucra în echipe inter şi
                            plurii-disciplinare, de a comunica în mod eficient şi
                            de a înțelege responsabilitățile profesionale și de etică.
                        </option>
                        <option value="Capacitatea de a recunoaște necesitatea și de a se angaja în procesul de învățare pe tot
parcursul vieții.">Capacitatea de a recunoaște necesitatea și de a se angaja în procesul de învățare pe tot
                            parcursul vieții.
                        </option>
                    </select></td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>
    <h4><b>7. Obiectivele disciplinei</b></h4>
    <table class="table-fisa-disc">

        <tbody>
        <tr>
            <td width="40%"> 7.1 Obiectivul general al disciplinei</td>
            <td class="input_td" width="60%">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td width="40%" width="60%"> 7.2 Obiectivele specifice</td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        </tbody>
    </table>

    <br>
    <h4><b>  8. Conținuturi</b></h4>
    <table class="table-fisa-disc">
        <tbody>
        <tr>
            <td class="bordered_td" width="55%">8.1 Curs</td>
            <td class="bordered_td" width="5%">Nr. ore</td>
            <td class="bordered_td" width="25%">Metode de predare</td>
            <td class="bordered_td" width="15%">Observații</td>
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td asd" rowspan="14">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td unbordered_td" rowspan="14">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class="input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class=" input_td unbordered_td"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td bordered_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <!--            <td class="input_td asd"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
            <!--            <td class="input_td asd"><pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea></td>-->
        </tr>
        <tr>
            <td class="input_td" colspan="4">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        </tbody>
    </table>

    <table class="table-fisa-disc">
        <tbody>
        <tr>
            <td width="55%">8.2 Seminar / laborator / proiect</td>
            <td width="5%">Nr. ore</td>
            <td width="25%">Metode de predare</td>
            <td width="15%"> Observații</td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class=" input_td ">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class=" input_td " colspan="4"><textarea type="text" class="input_element"></textarea></td>
        </tr>
        </tbody>
    </table>
    <br>

    <h4><b>9. Coroborarea conţinuturilor disciplinei cu aşteptările reprezentanţilor comunităţii epistemice,
            asociaţiilor
            profesionale şi angajatorilor reprezentativi din domeniul aferent programului</b></h4>
    <table class="table-fisa-disc">
        <td class="input_td">
            <pre class="pre_text"><span></span></pre>
            <textarea type="text" class="input_element"></textarea></td>
    </table>

    <br>
    <h4><b>10. Evaluare</b></h4>
    <table class="table-fisa-disc">

        <tbody>
        <tr>
            <td>Tip activitate</td>
            <td>10.1 Criterii de evaluare</td>
            <td>10.2 Metode de evaluare</td>
            <td>10.3 Pondere din nota finală</td>
        </tr>
        <tr>
            <td>10.4 Curs</td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td>10.5 Seminar/Laborator/Proiect</td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td colspan="4">10.6 Standard minim de performanță</td>
        </tr>
        </tbody>
    </table>

    <table class="table-fisa-disc">
        <tbody>
        <tr>
            <td rowspan="4"><b>Data completarii:</b></td>
            <td><b>Titulari</b></td>
            <td><b> Titlu Prenume NUME</b></td>
            <td><b> Semnătura</b></td>
        </tr>
        <tr>
            <td>Curs</td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td rowspan="2">Aplicații</td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        <tr>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
            <td class="input_td">
                <pre class="pre_text"><span></span></pre>
                <textarea type="text" class="input_element"></textarea></td>
        </tr>
        </tbody>
    </table>
    <br>
    <h4><b></b></h4>
    <table class="stamp_panel">
        <tbody>
        <tr>
            <td style="width: 50%;">Data avizării în Consiliul Departamentului:</td>
            <td style="width= 50%;">Director Departament:</td>
        </tr>
        <tr style="padding-bottom: 40px">
            <td class="input_td"><pre class="pre_text"><span></span></pre><textarea placeholder="completati..." type="text" class="input_element"></textarea>&nbsp;</td>
            <td class="input_td"><pre class="pre_text"><span></span></pre><textarea placeholder="completati..." type="text" class="input_element"></textarea>&nbsp;</td>
        </tr>
        <tr>
            <td>Data aprobării în Consiliul Facultății:</td>
            <td>Decan:</td>
        </tr>
        <tr style="padding-bottom: 40px">
            <td class="input_td "><pre class="pre_text"><span></span></pre><textarea placeholder="completati..." type="text" class="input_element"></textarea>&nbsp;</td>
            <td class="input_td"><pre class="pre_text"><span></span></pre><textarea placeholder="completati..." type="text" class="input_element"></textarea>&nbsp;</td>
        </tr>
        </tbody>
    </table>
</div>


<!--    <div id="date1" >-->
<!--        <p>Data avizării în Consiliul Departamentului: </p>-->
<!--        <pre class="pre_text"><span ></span></pre><textarea type="text" class="input_element"></textarea>-->
<!--    </div>-->
<!---->
<!--    <div id="director">-->
<!--        <p>Director Departament  </p>-->
<!--    </div></div>-->
<!---->
<!--<div>-->
<!--    <div id="date2">-->
<!--        <p>Data aprobării în Consiliul Facultății: </p>-->
<!--    </div>-->
<!---->
<!---->
<!---->
<!--    <div id="dean">-->
<!--        <p>Decan </p>-->
<!--    </div>-->
<!--</div></div>-->
<button type="submit" class="btn btn-primary col-md-1" style="margin-left: 45%" id="save_disc">Salvare</button>


</body>
</html>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    $(document).ready(function () {
        $('.input_td').click(function (e) {
            e.preventDefault();
            var input = $(this).find("textarea");
            input.show();
            input.focus();

        });
        $('.input_element').focus(function (e) {
            e.preventDefault();
            var input_parent = $(this).siblings('pre').find('span');

            if (input_parent.text() != "") {
                $(this).val(input_parent.text());
            }
            input_parent.contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

        });
        $('.input_element').focusout(function (e) {

            e.preventDefault();
            var input_parent = $(this).siblings('pre').find('span');
            input_parent.append($(this).val());
            $(this).val("");
            $(this).hide();

        });

        $(function () {
            $("#nav-bar").load("resources\\nav_bar.php");
        });

        $('#save_disc').click(function (e) {
            var id_disc_array = getUrlParameter('id_disc').split(',');
            for (let i = 0; i < id_disc_array.length; i++) {

                $.ajax({
                    type: 'POST',
                    url: 'complete_domain_spec.php',
                    data: {id_disc: id_disc_array[i]},
                    dataType: 'json',
                    cache: false,
                    success: function (result) {

                        $('#domain').text('  '+(result[0]['domain_name']));
                        $('#spec').text('  '+(result[0]['spec_name']));
                        var id_disc = id_disc_array[i];
                        var htmlContent = $("#fisa_disc").html();
                        $.ajax({
                            type: 'POST',
                            url: 'save_fisa_disc.php',
                            data: {"htmlContent": htmlContent, "id_disc": id_disc},
                            dataType: 'html',
                            cache: false,
                            success: function () {
                                window.location.replace('edit_disc_file.php?id_disc=' + id_disc_array + '&edit=1&id_promo='+getUrlParameter('id_promo')) ;

                            },
                        });
                    },

                })

            }
        });
    });


    $('.td_select').change(function (event) {

        console.log($(event.currentTarget).val());
        $(event.currentTarget).prev().css('display', 'block');
        $(event.currentTarget).prev().html($(event.currentTarget).val());


        $(event.currentTarget).css('display', 'none');


    })

    $(document).on('click','.comp',function (event){

        $(event.currentTarget).css('display','none');
        $(event.currentTarget).next().css('display','block');


    })


</script>
