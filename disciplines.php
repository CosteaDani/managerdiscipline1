<?php
/**
 * Created by PhpStorm.
 * Date: 1/19/2020
 * Time: 6:59 PM
 */
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();

$specialization = $_GET['specialization'];
$sql = "SELECT * FROM discipline WHERE id_specializare='$specialization' AND id_promotie=(SELECT id  FROM promotii WHERE id_ciclu_studii=(SELECT id_ciclu_studii FROM specializari WHERE id='$specialization') ORDER BY id DESC LIMIT 1) ORDER BY cod ASC ";
$result = mysqli_query($dbCon->getCon(), $sql);
$i = 1;

$spec = mysqli_query($dbCon->getCon(), "SELECT * FROM specializari ");
$ciclu_studii = mysqli_query($dbCon->getCon(), "SELECT * FROM ciclu_studii ");

//    while ($row = $result->fetch_assoc()){
//        echo $row[1];
//    }
?>
<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">
    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">
    <link rel="stylesheet" type="text/css" href="resources\css\semantic.min.css">


</head>
<body>
<div id="nav-bar"></div>
<div class="container">
    <div id="nav-bar"></div>
    <br><br><br>
    <form action="disciplines.php" method="get">
        <div class="row">
            <div class="form-group col-md-2">
                <label for="denumire">Denumire</label>
                <input type="text" id="input" onkeyup="Search()" placeholder="Cautare materie..." class="form-control">
            </div>
            <!--            <div class="form-group col-md-2">-->
            <!--                <input type="text" name="specialization" hidden value="-->
            <?php //echo $specialization;?><!--">-->
            <!--                <label for="year">An de studiu</label>-->
            <!--                <input type="text" name="year" class="form-control" id="year">-->
            <!--            </div>-->
        </div>

        <!--        <button type="submit" class="btn btn-primary col-md-1" style="margin-left: 40%;">Cauta</button>-->

    </form>


    <!-- FORMULAR EDITARE DISCIPLINA-->


    <div class="container " >

        <form  id='edit_discipline' style="border: 1px grey solid; width: 50%; border-radius: 10px;margin-bottom: 10px">
            <div class="form-group row" style="margin-top: 5px"> <div class="col-sm-12" style="font-size: 20px"> <i  class="window close outline icon"></i></div></div>
            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Denumire</label>
                <div class="col-sm-5">
                    <input name="name" class="form-control">
                </div>
            </div>

            <!-- ----Select------>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Program de studii</label>
                <div class="col-sm-5">
                    <select id="edit_progstudii" name="progstudii" class="form-control">
                        <option disabled selected value></option>
                        <?php foreach ($ciclu_studii as $progstudii_name){?>
                        <option name='progstudii_name' value="<?php echo $progstudii_name['id'] ?>"><?php echo $progstudii_name['denumire'];} ?></option>
                    </select>

                </div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Specializare</label>
                <div class="col-sm-5">
                    <select id="edit_spec" name="spec" class="form-control">


                    </select>

                </div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Cod</label>
                <div class="col-sm-2">
                    <input  name="code" class="form-control">
                </div>
            </div>



            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Credite</label>
                <div class="col-sm-2">
                    <input  name="credits" class="form-control">
                </div>
            </div>


            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">An</label>
                <div class="col-sm-2">
                    <select name="year" class="form-control ">
                        <option disabled selected value></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>

                    </select></div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Semestru</label>
                <div class="col-sm-2">
                    <select name="semester" class="form-control ">
                        <option disabled selected value></option>
                        <option value="1">1</option>
                        <option value="2">2</option>


                    </select></div>
            </div>



            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Ore de curs/saptamana</label>
                <div class="col-sm-2">
                    <input  name="course" class="form-control">
                </div>
            </div>

            <div style="margin-left: 5px;"  class="form-group row">
                <label class="col-sm-5 col-form-label">Ore de seminar/saptamana</label>
                <div class="col-sm-2">
                    <input  name="seminary" class="form-control">
                </div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Ore de laborator/saptamana</label>
                <div class="col-sm-2">
                    <input  name="laboratory" class="form-control">
                </div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Ore de proiect/saptamana</label>
                <div class="col-sm-2">
                    <input name="project" class="form-control">
                </div>
            </div>
            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-md-5 col-form-label">Ore de cercetare (Master)</label>
                <div class="col-md-2">
                    <input name="research" class="form-control">
                </div>
            </div>
            <div style="margin-left: 20px;" class="form-group row">
                <label style="width: 230px "class=" col-form-label">Practica: (ex. 3sapt. x 30ore = 90)</label>

                <div style="width: 40px ">
                    <input name="weeks" class="form-control" disabled="disabled">
                </div>
                <label style="width: 50px " class=" col-form-label">sapt x</label>
                <div style="width: 40px ">
                    <input name="hours" class="form-control" disabled="disabled">
                </div>
                <label style="width: 50px " class="col-form-label">ore=</label>
                <div style="width: 50px ">
                    <input name="practice" class="form-control" disabled="disabled">
                </div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Modul de evaluare</label>
                <div class="col-sm-5">
                    <select name="evaluation" class="form-control ">
                        <option disabled selected value></option>
                        <option value="E">Examen</option>
                        <option value="C">Colocviu</option>
                        <option value="V">Verficare</option>
                    </select>
                </div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Tip disciplina</label>
                <div class="col-sm-5">
                    <select name="obs" class="form-control" >
                        <option disabled selected value></option>
                        <option value="DF">Discipline fundamentale</option>
                        <option value="DID">Discipline ingineresti in domeniu</option>
                        <option value="DC">Discipline complementare</option>
                        <option value="DS">Discipline de specialitate</option>
                    </select>
                </div>
            </div>

            <div style="margin-left: 5px;" class="form-group row">
                <label class="col-sm-5 col-form-label">Optionalitate</label>
                <div class="col-sm-5">
                    <select name="opt" class="form-control" >
                        <option disabled selected value></option>
                        <option value="DOB">Disc obligatorii</option>
                        <option value="DOP">Disc optionale</option>
                        <option value="FAC">Disc facultative</option>
                    </select>
                </div>
            </div>


            <div  class="form-group row">
                <div class="col-sm-10">

                    <button style="margin-bottom: 5px; margin-left: 5px"  name="save_discipline" class="btn btn-secondary">Adaugare</button>
                </div>
            </div>

        </form>
    </div>


    <br><br>
    <table class="table table-bordered" id="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Denumire</th>
            <th scope="col">an</th>
            <th scope="col">semestru</th>
            <th scope="col">Edit/Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php

        while ($row = $result->fetch_assoc()) {
            echo " <tr>
            <th scope='row'>" . $row['cod'] . "</th>
            <td>" . $row['denumire'] . "</td>
            <td>" . $row['an'] . "</td>
            <td>" . $row['semestru'] . "</td>
            <td>
                <button class='btn-info btn edit_btn_disc' data-id=" . $row['id'] . " id='btn-edit'> Edit</button>
                <button class='btn-danger btn del_btn_disc' data-id=" . $row['id'] . " id='btn-delete'>Delete</button>
            </td>
        </tr>";
            $i++;

        } ?>
        </tbody>
    </table>

</div>
</body>
</html>
<script>



        function Search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        $( document ).ready(function() {


            $('#edit_discipline').hide();






             $('.del_btn_disc').click(function () {


            var disc_id = $(this).data("id");
            console.log(disc_id);
            var conf = confirm("DORITI SA STERGETI ACEASTA DISCIPLINA?");
            if (conf == true) {

                var action = 'DELETE';
                console.log(action);
                $.ajax({
                    url: "action_discipline.php",
                    method: "POST",
                    data: {disc_id: disc_id, action: action},
                    dataType: "json",
                    success: function (response) {

                        location.reload();
                        alert(response);

                    }
                });
            }
        })
            $('.edit_btn_disc').click(function () {




                $('#edit_spec').empty();

                var id = $(this).data("id");
                $('#edit_discipline').val(id);

                console.log(id);
                action = 'EDIT';
                console.log(action);

                $.ajax({
                    url: "action_discipline.php",
                    method: "POST",
                    data: {id: id, action:action},
                    dataType: "json",
                    success: function (row) {
                        $('#edit_discipline').find(('input[name="name"]')).val(row.denumire);
                        $('#edit_discipline').find(('select[name="progstudii"]')).find(('option[value='+row.id_ciclu_studii+']')).attr("selected","selected");

                        let progstudies_id = ($('select[name="progstudii"]')).find(("option[name='progstudii_name']:selected")).val();

                        $.ajax({
                            type: 'POST',
                            url: 'dropdown_edit_spec.php',
                            data: {progstudies_id:progstudies_id},
                            dataType: 'json',
                            cache: false,

                            success: function (response) {

                                var len= response.length;


                                for(var i=0; i<len;i++){
                                    var id =response[i]['id'];
                                    var name =response[i]['name'];

                                    $('#edit_spec').append("<option value='"+id+"'>"+name+"</option>");

                                }
                                $('#edit_discipline').find(('#edit_spec')).find(('option[value='+row.id_specializare+']')).attr("selected","selected");
                            },

                        });

                        $('#edit_discipline').find(('input[name="code"]')).val(row.cod);
                        $('#edit_discipline').find(('input[name="credits"]')).val(row.nr_credite);
                        $('#edit_discipline').find(('select[name="year"]')).find(('option[value='+row.an+']')).attr("selected","selected");
                        $('#edit_discipline').find(('select[name="semester"]')).find(('option[value='+row.semestru+']')).attr("selected","selected");
                        $('#edit_discipline').find(('input[name="course"]')).val(row.ore_curs);
                        $('#edit_discipline').find(('input[name="seminary"]')).val(row.ore_seminar);
                        $('#edit_discipline').find(('input[name="laboratory"]')).val(row.ore_laborator);
                        $('#edit_discipline').find(('input[name="project"]')).val(row.ore_proiect);
                        $('#edit_discipline').find(('input[name="research"]')).val(row.cercetare);
                        $('#edit_discipline').find(('input[name="practice"]')).val(row.practica);
                        $('#edit_discipline').find(('input[name="weeks"]')).val();
                        $('#edit_discipline').find(('input[name="hours"]')).val();

                        $('#edit_discipline').find(('select[name="evaluation"]')).find(('option[value='+row.evaluare+']')).attr("selected","selected");
                        $('#edit_discipline').find(('select[name="obs"]')).find(('option[value='+row.obs+']')).attr("selected","selected");
                        $('#edit_discipline').find(('select[name="opt"]')).find(('option[value='+row.optionalitate+']')).attr("selected","selected");
                        $('#edit_discipline').show();

                        if ($(('select[name="progstudii"]')).find(('option:selected')).text()=="Master"){
                            $(('select[name="year"]')).find(("option[value='3']")).attr("disabled", "disabled");
                            $(('select[name="year"]')).find(("option[value='4']")).attr("disabled", "disabled");
                            $(('input[name="practice"]')).attr("disabled", "disabled");
                            $(('input[name="weeks"]')).attr("disabled", "disabled");
                            $(('input[name="hours"]')).attr("disabled", "disabled");
                            $(('input[name="research"]')).removeAttr("disabled", "disabled");


                        }
                        else {
                            $(('select[name="year"]')).find(("option[value='3']")).removeAttr("disabled","disabled");
                            $(('select[name="year"]')).find(("option[value='4']")).removeAttr("disabled","disabled");
                            $(('input[name="practice"]')).removeAttr("disabled", "disabled");
                            $(('input[name="weeks"]')).removeAttr("disabled", "disabled");
                            $(('input[name="hours"]')).removeAttr("disabled", "disabled");
                            $(('input[name="research"]')).attr("disabled", "disabled");
                        }


                        console.log(row);

                        console.log(row.id_specializare);
                    },
                    error: function(){
                        console.log('ERROR');
                    }
                })

            })

            $('#edit_progstudii').change(function () {
                let progstudies_id = $("option[name='progstudii_name']:selected").val();

                if ($(('select[name="progstudii"]')).find(('option:selected')).text()=="Master"){
                    $(('select[name="year"]')).find(("option[value='3']")).attr("disabled", "disabled");
                    $(('select[name="year"]')).find(("option[value='4']")).attr("disabled", "disabled");
                    $(('input[name="practice"]')).attr("disabled", "disabled");
                    $(('input[name="weeks"]')).attr("disabled", "disabled");
                    $(('input[name="hours"]')).attr("disabled", "disabled");
                    $(('input[name="research"]')).removeAttr("disabled", "disabled");


                }
                else {
                    $(('select[name="year"]')).find(("option[value='3']")).removeAttr("disabled","disabled");
                    $(('select[name="year"]')).find(("option[value='4']")).removeAttr("disabled","disabled");
                    $(('input[name="practice"]')).removeAttr("disabled", "disabled");
                    $(('input[name="weeks"]')).removeAttr("disabled", "disabled");
                    $(('input[name="hours"]')).removeAttr("disabled", "disabled");
                    $(('input[name="research"]')).attr("disabled", "disabled");
                }

                $('#edit_spec').empty();
                $.ajax({
                    type: 'POST',
                    url: 'dropdown_edit_spec.php',
                    data: {progstudies_id:progstudies_id},
                    dataType: 'json',
                    cache: false,

                    success: function (response) {

                        var len= response.length;


                        for(var i=0; i<len;i++){
                            var id =response[i]['id'];
                            var name =response[i]['name'];

                            $('#edit_spec').append("<option value='"+id+"'>"+name+"</option>");

                        }

                    },

                });

            })



            $('button[name ="save_discipline"]').click(function (event) {

                event.preventDefault();

                var link=$(location).attr('href');
                var  action = 'UPDATE';
                var id=$('#edit_discipline').val();
                var spec=$('#edit_discipline').find(('#edit_spec')).find(('option:selected')).val();
                var name=$('#edit_discipline').find(('input[name="name"]')).val();
                var progstudii= $('#edit_discipline').find(('select[name="progstudii"]')).find(('option:selected')).val();
                var code= $('#edit_discipline').find(('input[name="code"]')).val();
                var credits= $('#edit_discipline').find(('input[name="credits"]')).val();
                var year=$('#edit_discipline').find(('select[name="year"]')).find(('option:selected')).val();
                var semester=$('#edit_discipline').find(('select[name="semester"]')).find(('option:selected')).val();
                var course= $('#edit_discipline').find(('input[name="course"]')).val();
                var seminary=$('#edit_discipline').find(('input[name="seminary"]')).val();
                var laboratory=$('#edit_discipline').find(('input[name="laboratory"]')).val();
                var project=$('#edit_discipline').find(('input[name="project"]')).val();
                var research=$('#edit_discipline').find(('input[name="research"]')).val();
                var weeks=$('#edit_discipline').find(('input[name="weeks"]')).val();
                var hours=$('#edit_discipline').find(('input[name="hours"]')).val();
                var practice=$('#edit_discipline').find(('input[name="practice"]')).val();
                var evaluation=$('#edit_discipline').find(('select[name="evaluation"]')).find(('option:selected')).val();
                var obs=$('#edit_discipline').find(('select[name="obs"]')).find(('option:selected')).val();
                var opt=$('#edit_discipline').find(('select[name="opt"]')).find(('option:selected')).val();



                $.ajax({
                    url: "action_discipline.php",
                    method: "POST",
                    data: {action:action,
                        id:id,
                        name:name,
                        spec:spec,
                        progstudii:progstudii,
                        code:code,
                        credits:credits,
                        year:year,
                        semester:semester,
                        course:course,
                        seminary:seminary,
                        laboratory:laboratory,
                        project:project,
                        research:research,
                        weeks:weeks,
                        hours:hours,
                        practice:practice,
                        evaluation:evaluation,
                        obs:obs,
                        opt:opt,
                        link:link},
                    dataType: "json",
                    success: function (result) {
                        alert(result.response);
                        window.location.replace(result.link);

                    },
                    error:function(){
                        alert('Nu s-au putut efectua modificari!');
                    }

                });

            })

            $('.window').click(function(){
                $(this).closest('form').find("input").val("");
                $(this).closest('form').hide();
            })

    });
</script>
