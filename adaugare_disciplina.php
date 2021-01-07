<?php

include 'resources\php\DbConnection.php';
$dbCon = new DbConnection();

$programstudies = mysqli_query($dbCon->getCon(), "SELECT * FROM ciclu_studii ");

$specializations = mysqli_query($dbCon->getCon(), "SELECT * FROM specializari ");



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
        $(function(){
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



    <br><br>


    <form >
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Denumire</label>
            <div class="col-md-3">
                <input required name="name" class="form-control">
            </div>
        </div>

        <!-- ----Select------>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Ciclul de studii</label>
            <div class="col-md-3">
                <select required id="progstudii" name="progstudii" class="form-control">
                    <option disabled selected value></option>
                    <?php foreach ($programstudies as $progstudies_name){?>
                    <option name="progstudii_name" value="<?php echo $progstudies_name['id'] ?>"><?php echo $progstudies_name['denumire'];} ?></option>
                </select>

            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" >Specializare</label>
            <div class="col-md-3">
            <select required id="choose_spec"  name="id_spec" class="form-control">




            </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Cod</label>
            <div class="col-md-1">
                <input  name="code" class="form-control">
            </div>
        </div>



        <div class="form-group row">
            <label class="col-md-3 col-form-label">Credite</label>
            <div class="col-md-1">
                <input  name="credits" class="form-control">
            </div>
        </div>


        <div class="form-group row">
            <label class="col-md-3 col-form-label">An</label>
            <div class="col-md-1">
                <select name="year" class="form-control ">
                    <option disabled selected value></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>

                </select></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Semestru</label>
            <div class="col-md-1">
                <select name="semester" class="form-control ">
                    <option disabled selected value></option>
                    <option value="1">1</option>
                    <option value="2">2</option>


                </select></div>
        </div>



        <div class="form-group row">
            <label class="col-md-3 col-form-label">Ore de curs/saptamana</label>
            <div class="col-md-1">
                <input  name="course" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Ore de seminar/saptamana</label>
            <div class="col-md-1">
                <input  name="seminary" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Ore de laborator/saptamana</label>
            <div class="col-md-1">
                <input  name="laboratory" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Ore de proiect/saptamana</label>
            <div class="col-md-1">
                <input name="project" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Ore de cercetare (Master)</label>
            <div class="col-md-1">
                <input name="research" class="form-control" disabled="disabled">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Practica: (ex. 3sapt. x 30ore = 90)</label>

            <div class="col-md-1">
                <input name="weeks" class="form-control" disabled="disabled">
            </div>
            <label class="col-md-1 col-form-label">sapt x </label>
            <div class="col-md-1">
                <input name="hours" class="form-control" disabled="disabled">
            </div>
            <label class="col-md-1 col-form-label">ore = </label>
            <div class="col-md-1">
                <input name="practice" class="form-control" disabled="disabled">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Modul de evaluare</label>
            <div class="col-md-3">
                <select name="evaluation" class="form-control ">
                    <option disabled selected value></option>
                    <option value="E">Examen</option>
                    <option value="C">Colocviu</option>
                    <option value="V">Verficare</option>
                </select></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Tip disciplina</label>
            <div class="col-md-3">
                <select name="obs" class="form-control" >
                    <option disabled selected value></option>
                    <option value="DF">Discipline fundamentale</option>
                    <option value="DID">Discipline ingineresti in domeniu</option>
                    <option value="DC">Discipline complementare</option>
                    <option value="DS">Discipline de specialitate</option>
                    <option value="DA">Discipline de aprofundare</option>
                </select></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Optionalitate</label>
            <div class="col-md-3">
                <select name="opt" class="form-control" >
                    <option disabled selected value></option>
                    <option value="DOB">Disc obligatorii</option>
                    <option value="DOP">Disc optionale</option>
                    <option value="FAC">Disc facultative</option>
                </select></div>
        </div>




        <div class="form-group row">
            <div class="col-md-10">
                <button type="submit"  name="submit" class="btn btn-primary submit">Adaugare</button>
            </div>
        </div>

    </form>

</div>


<script src="resources\js\dropdown_select.js"></script>
<script>
    $(document).ready(function(){
        $('#progstudii').change(function (event) {
            let progstudies_id = $("option[name='progstudii_name']:selected").val();

            $('#choose_spec').empty();


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

            event.preventDefault();
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

                        $('#choose_spec').append("<option value='"+id+"'>"+name+"</option>");

                    }

                },

            });

        });

        $('.submit').click(function(e){
            e.preventDefault();


            var action='CREATE';

            var spec=$(('#choose_spec')).find(('option:selected')).val();
            var name=$(('input[name="name"]')).val();
            var progstudii= $(('select[name="progstudii"]')).find(('option:selected')).val();
            var code= $(('input[name="code"]')).val();
            var credits= $(('input[name="credits"]')).val();
            var year=$(('select[name="year"]')).find(('option:selected')).val();
            var semester=$(('select[name="semester"]')).find(('option:selected')).val();
            var course= $(('input[name="course"]')).val();
            var seminary=$(('input[name="seminary"]')).val();
            var laboratory=$(('input[name="laboratory"]')).val();
            var project=$(('input[name="project"]')).val();
            var research=$(('input[name="research"]')).val();

            var weeks=$(('input[name="weeks"]')).val();
            var hours=$(('input[name="hours"]')).val();
            var practice=$(('input[name="practice"]')).val();

            var evaluation=$(('select[name="evaluation"]')).find(('option:selected')).val();
            var obs=$(('select[name="obs"]')).find(('option:selected')).val();
            var opt=$(('select[name="opt"]')).find(('option:selected')).val();


                $.ajax({
                    url:"action_discipline.php",
                    method:"POST",
                    data:{action:action,spec:spec,name:name,progstudii:progstudii,code:code,credits:credits,year:year,semester:semester,course:course,seminary:seminary,laboratory:laboratory,project:project,research:research,weeks:weeks, hours:hours,practice:practice,evaluation:evaluation,obs:obs,opt:opt},
                    dataType:"json",

                    success:function(response){

                        alert(response);
                        location.reload();
                    },
                    error: function(response){
                        console.log(response);
                    }

                });
            })
        });



</script>

</body>

</html>

