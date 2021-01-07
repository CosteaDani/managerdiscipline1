<?php include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">

    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">



    <script src="resources\js\jquery-3.4.1.min.js"></script>
    <script src="resources\js\bootstrap.min.js"></script>







    <script>
    $(function () {
        $("#nav_bar").load("resources\\nav_bar.php");
    });

</script>


<style>
    .cell{ border : 0.5px solid;};

</style>




</head>
<body>
<div class="container ">
    <div id="nav_bar"></div></div>
<br><br>
<div class="container" id="fisa_disc">
<div class="container "><b>1. Date despre rogram</b></div>


<div class = "container " style="border: 1px solid;">

    <div class="row">
        <div  class="col-md-4 cell">1.1 Instituţia de învăţământ superior</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell" >1.2 Facultatea </div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">1.3 Departamentul</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">1.4 Domeniul de studii</div>
        <div class="col-md-8 cell" ></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">1.5 Ciclul de studii</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">1.6 Programul de studii / Calificarea</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">1.7 Forma de învăţământ</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">1.8 Codul disciplinei</div>
        <div class="col-md-8 cell"></div>
    </div>

</div>

<br>
<div class="container "><b>2. Date despre disciplina</b></div>

<div class = "container " style="border: 1px solid; ">

    <div class="row">
        <div class="col-md-4 cell"> &nbsp;</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">2.1 Denumirea disciplinei</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">2.2 Aria de conţinut</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">2.3 Titularul de curs</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-4 cell">2.4 Titularul activităţilor de seminar / laborator / proiect</div>
        <div class="col-md-8 cell"></div>
    </div>

    <div class="row">
        <div class="col-md-2 cell">2.5 Anul de studiu              </div>
        <div class="col-md-1 cell"></div>
        <div class="col-md-2 cell">2.6 Semestrul</div>
        <div class="col-md-1 cell"></div>
        <div class="col-md-4 cell">2.7 Tipul de evaluare</div>
        <div class="col-md-2 cell"></div>

    </div>

    <div class="row">
        <div class="col-md-2 cell">2.8 Regimul disciplinei</div>
        <div class="col-md-8 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Categoria formativă</div>
            <div class="row">Opționalitate</div>
        </div>
        <div class="col-md-2 cell">
            <div class="row" > &nbsp; </div>
            <div class="row"></div>
        </div>

    </div>


</div>
<br><br>

<div class="container "><b>3. Timpil total estimat</b></div>


<div class = "container " style="border: 1px solid;">
    <div class="row">
        <div class="col-md-2 cell">3.1 Număr de ore pe    săptămână</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">din care:</div>
        <div class="col-md-1 cell">3.2 Curs</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">3.3 Seminar</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">3.3 Laborator</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">3.3 Proiect</div>
        <div class="col-md-1 cell">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-2 cell">3.4 Număr de ore pe    semestru</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">din care:</div>
        <div class="col-md-1 cell">3.5 Curs</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">3.6 Seminar</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">3.6 Laborator</div>
        <div class="col-md-1 cell">&nbsp;</div>
        <div class="col-md-1 cell">3.6 Proiect</div>
        <div class="col-md-1 cell">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-12 cell">3.7 Distribuţia fondului de timp (ore pe semestru) pentru:</div> 
    </div>
    <div class="row">
        <div class="col-md-11 cell">&nbsp;(a) Studiul după manual, suport de curs, bibliografie şi notiţe</div>
        <div class="col-md-1 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-11 cell">&nbsp;(b) Documentare suplimentară în bibliotecă, pe platforme electronice de specialitate şi pe teren</div>
        <div class="col-md-1 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-11 cell">&nbsp;(c) Pregătire seminarii / laboratoare, teme, referate, portofolii şi eseuri</div>
        <div class="col-md-1 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-11 cell">&nbsp;(d) Tutoriat</div>
        <div class="col-md-1 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-11 cell">&nbsp;(e) Examinări</div>
        <div class="col-md-1 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-11 cell">&nbsp;(f) Alte activităţi:</div>
        <div class="col-md-1 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-8 cell">&nbsp;3.8 Total ore studiu individual (suma (3.7(a)…3.7(f)))</div>
        <div class="col-md-4 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-8 cell">&nbsp;3.9 Total ore pe semestru (3.4+3.8)</div>
        <div class="col-md-4 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-8 cell">&nbsp;3.10 Numărul de credite</div>
        <div class="col-md-4 cell"></div>
    </div>
</div>
<br><br>

<div class="container "><b>4. Precondiţii </b></div>
<div class = "container " style="border: 1px solid;">
    <div class="row">
        <div class="col-md-4 cell">4.1 de curriculum</div>
        <div class="col-md-8 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-4 cell">4.2 de competenţe</div>
        <div class="col-md-8 cell"></div>
    </div>
</div>
<br><br>

<div class="container "><b>5. Conditii </b></div>
<div class = "container " style="border: 1px solid;">
    <div class="row">
        <div class="col-md-4 cell">5.1. de desfăşurare a cursului</div>
        <div class="col-md-8 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-4 cell">5.2. de desfăşurare a seminarului / laboratorului / proiectului</div>
        <div class="col-md-8 cell"></div>
    </div>
</div>
<br><br>

<div class="container "><b>6. Competenţele specifice acumulate </b></div>
<div class = "container " style="border: 1px solid;">
    <div class="row">
        <div class="col-md-4 cell">Competenţe profesionale</div>
        <div class="col-md-8 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-4 cell">Competenţe transversale</div>
        <div class="col-md-8 cell"></div>
    </div>
</div>
<br><br>

<div class="container "><b>7. Obiectivele disciplinei  </b></div>
<div class = "container " style="border: 1px solid;">
    <div class="row">
        <div class="col-md-4 cell">7.1 Obiectivul general al disciplinei</div>
        <div class="col-md-8 cell"></div>
    </div>
    <div class="row">
        <div class="col-md-4 cell">7.2 Obiectivele specifice</div>
        <div class="col-md-8 cell"></div>
    </div>
</div>
<br><br>

<div class="container "><b>8. Conţinuturi</b></div>

<div class = "container " style="border: 1px solid;">
    
    <div class="row">
        <div class="col-md-6 cell">
            <div class="row" style="border-bottom: 1.5px solid;">8.1 Curs</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" >&nbsp;</div>
        </div>
        <div class="col-md-1 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Nr. ore</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" >&nbsp;</div>
        </div>
        <div class="col-md-3 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Metode de predare</div>

        </div>
        <div class="col-md-2 cell">
             <div class="row" style="border-bottom: 1.5px solid;">Observatii</div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12 cell">Bibliografie</div>
        
    </div>
</div>
<div class = "container " style="border: 1px solid;">
    
    <div class="row">
        <div class="col-md-6 cell">
            <div class="row" style="border-bottom: 1.5px solid;">8.2 Seminar / laborator / proiect</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" >&nbsp;</div>
        </div>
        <div class="col-md-1 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Nr. ore</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" >&nbsp;</div>
        </div>
        <div class="col-md-3 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Metode de predare</div>

        </div>
        <div class="col-md-2 cell">
             <div class="row" style="border-bottom: 1.5px solid;">Observatii</div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12 cell">Bibliografie</div>
        
    </div>
</div>
<br><br>
<div class="container "><b>9. Coroborarea conţinuturilor disciplinei cu aşteptările reprezentanţilor comunităţii epistemice, asociaţiilor profesionale şi angajatorilor reprezentativi din domeniul aferent programului</b></div>
<div class = "container " style="border: 1px solid;">

    <div class="row">
        <div class="col-md-12 cell">
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
        </div>
    </div>
</div>
<br><br><br>
<div class="container "><b>10. Evaluare</b></div>

<div class = "container " style="border: 1px solid;">

    <div class="row">
        <div class="col-md-3 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Tip activitate</div>
            <div class="row" style="border-bottom: 1.5px solid;">10.4 Curs</div>
            <div class="row">10.5 Seminar/Laborator /Proiect</div>
        </div>
        <div class="col-md-3 cell">
            <div class="row" style="border-bottom: 1.5px solid;">10.1 Criterii de evaluare</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row">&nbsp;</div>

        </div>
        <div class="col-md-3 cell">
            <div class="row" style="border-bottom: 1.5px solid;">10.2 Metode de evaluare</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row">&nbsp;</div>

        </div>
        <div class="col-md-3
         cell">
            <div class="row" style="border-bottom: 1.5px solid;">10.3 Pondere din nota finală</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row">&nbsp;</div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 cell">
            <div class="row" >10.6 Standard minim de performanţă</div>
        </div>
    </div>
</div>
<br><br><br>

<div class = "container " style="border: 1px solid;">

    <div class="row">
        <div class="col-md-3 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Data completării:<br>zz.ll.aaaa</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
        </div>
        <div class="col-md-3 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Titulari</div>
            <div class="row" style="border-bottom: 1.5px solid;">Curs</div>
            <div class="row" >Aplicatii</div>
            <div class="row" >&nbsp;</div>
            <div class="row" >&nbsp;</div>
        </div>
        <div class="col-md-4 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Prenume NUME</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
        </div>
        <div class="col-md-2 cell">
            <div class="row" style="border-bottom: 1.5px solid;">Semnătura</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
            <div class="row" style="border-bottom: 1.5px solid;">&nbsp;</div>
        </div>
    </div>
</div>


<br><br><br><br><br><br>
<div class = "container " style="border: 1px solid;">

    <div class="row">
        <div class="col-md-6 ">
            <div class="row" >Data avizării în Consiliul Departamentului <br><br>____________________________<br>&nbsp;</div>
            <div class="row" >Data aprobării în Consiliul Facultății <br><br>____________________________<br>&nbsp;</div>
        </div>
         <div class="col-md-6 ">
            <div class="row" >Director Departament <br>Prof.dr.ing. <br><br>&nbsp;</div>
            <div class="row" >Decan<br>Prof.dr.ing. <br><br>&nbsp;</div>
        </div>
    </div>
</div></div>
<br><br><br>
<button type="submit" class="btn btn-primary col-md-1" style="margin-left: 45%" id="export_pdf">Export PDF</button>

<button type="submit" class="btn btn-primary col-md-1" style="margin-left: 45%" id="cmd">Export PDF</button>

</body>
</html>

<script>

$('#export_pdf').click(function (e) {

var htmlContent = $("#fisa_disc").html();



console.log($(".td_select").find(":selected").text())

    e.preventDefault();
    $.ajax({

    type: 'POST',
    url: 'create_pdf2.php',
    data: {"htmlContent": htmlContent },
    dataType: 'html',
    cache: false,
    success: function (result) {
    window.open(result);
    },
    });
    });

$("#cmd").click(function(){

    var doc=new jsPDF;
    doc.fromHTML(($("#fisa_disc").html(),15,15));
    doc.save("asdf.pdf");
})





</script>

