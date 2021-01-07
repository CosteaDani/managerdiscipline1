<?php
/**
 * Created by PhpStorm.
 * User: Diana
 * Date: 1/12/2020
 * Time: 5:11 PM
 */
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();


$degree_level = mysqli_query($dbCon->getCon(), "SELECT * FROM ciclu_studii ");
//$study_plans = scandir('resources/study_plans');
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
            $("#nav-bar").load("resources/nav_bar.php");
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

    <br><br><br>
    <div class="row">
        <div class="col-md-6">
    <form action="create_study_plan.php" method="get">
        <h3>Creare plan de invatamant</h3>

        <div class="form-group row col-md-8">

            <label for="degree_level">Ciclu studii</label>
            <select required id="degree_level"  name="degree_level" class="form-control">
                <option disabled selected value></option>
                <?php foreach ($degree_level as $degree_level_name){?>
                <option name="degree_level" id="<?php echo $degree_level_name['id'] ?>" value="<?php echo $degree_level_name['denumire'] ?>"><?php echo $degree_level_name['denumire'];} ?></option>
            </select>

        </div>
        <div class="form-group row col-md-8">

                <label for="domain">Domeniu</label>
                <select required id="domain" name="domain" class="form-control">

                </select>

            </div>




            <div class="form-group row col-md-8">
                <label >Specializare</label>
                <select required id="choose_spec"  name="id_spec" class="form-control">
                    <option disabled selected value></option>




                </select>

            </div>

            <div class="form-group row col-md-4">
                <label for="year">An de studiu</label>
                <select required id="year" name="year" class="form-control">
                    <option selected></option>

                    <option  value="1" > 1</option>
                    <option  value="2" > 2</option>
                    <option  value="3" > 3</option>
                    <option  value="4" > 4</option>
                </select>
            </div>

        <div class="form-group row col-md-8">
            <label >Rector:</label>
            <input required name="rector" class="form-control" type="text">

        </div>

        <div class="form-group row col-md-8">
            <label >Decan:</label>
            <input required name="dean" class="form-control" type="text">

        </div>

        <div class="form-group row col-md-8">
            <label >Director departament:(DEPARTAMENT, Nume )</label>
            <input required name="director" class="form-control" type="text">

        </div>



        <button type="submit" class="btn btn-primary col-md-2">Creare</button>
    </form></div>


    </div>


    <br><br>
<!--    <div class="list-group">-->
<!--        <p class="list-group-item list-group-item-action active">-->
<!--            Planuri de invatamant-->
<!--        </p>-->
<!--        --><?php //foreach ($study_plans as $study_plan) {
//            if($study_plan == '.' || $study_plan == '..'){continue;}?>
<!--        <a href="resources/study_plans/--><?php //echo $study_plan;?><!-- " class="list-group-item list-group-item-action">--><?php //echo $study_plan;?><!--</a>-->
<!--        --><?php //}?>
<!--    </div>-->
</div>
</body>
</html>

<script>
    $(document).ready(function(){


        $("[name='degree_level']").change(function (event) {
            let progstudies_id = $("option[name='degree_level']:selected").attr('id');
            console.log(progstudies_id);
            $('#domain').empty();
            $('#choose_spec').empty();

            $('#domain').append("<option selected disabled</option>")


            if ($(('select[name="degree_level"]')).find(('option:selected')).text()=="Master"){
                $(('select[name="year"]')).find(("option[value='3']")).attr("disabled", "disabled");
                $(('select[name="year"]')).find(("option[value='4']")).attr("disabled", "disabled");
            }
            else {
                $(('select[name="year"]')).find(("option[value='3']")).removeAttr("disabled","disabled");
                $(('select[name="year"]')).find(("option[value='4']")).removeAttr("disabled","disabled");
            }


            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'dropdown_domain.php',
                data: {progstudies_id:progstudies_id},
                dataType: 'json',
                cache: false,

                success: function (response) {

                    var len= response.length;


                    for(var i=0; i<len;i++){
                        var id =response[i]['id'];
                        var name =response[i]['name'];

                        $('#domain').append("<option name='domain_name' value='"+id+"'>"+name+"</option>");

                    }

                },

            });

        });

        $('#domain').change(function (event) {
            let domain_id = $("option[name='domain_name']:selected").val();


            $('#choose_spec').empty();
            $('#choose_spec').append("<option selected disabled</option>")

            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'dropdown_spec.php',
                data: {domain_id:domain_id},
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




    })

</script>