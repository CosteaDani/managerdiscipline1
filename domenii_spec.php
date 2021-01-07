<?php

include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();

$sql = "SELECT * FROM domenii  ";

$result = mysqli_query($dbCon->getCon(), $sql);

$i = 1;
$ciclu_studii = mysqli_query($dbCon->getCon(), "SELECT * FROM ciclu_studii ");


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
    <link rel="stylesheet" type="text/css" href="resources\css\jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="resources\css\jquery-ui.theme.min.css">

    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">
    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">
    <link rel="stylesheet" type="text/css" href="resources\css\semantic.min.css">


</head>
<body>

<div id="nav-bar"></div>
<div class="container">
     <br><br>
    <div class="form-group row">
        <div class="col-sm-2">
            <button  id="btn_domain"  name="submit" class="btn btn-primary">Domeniu nou   </button>
        </div>
        <div class="col-sm-2">
            <button  id="btn_spec"  name="submit" class="btn btn-primary">Specializare noua   </button>
        </div>
    </div>



   <br><br>


    <form action="action_domain.php" id='add_domain'style="border: 1px grey solid; width: 40%; border-radius: 10px;margin-bottom: 10px" method="get">
        <div class="form-group row" style="margin-top: 5px"> <div class="col-sm-12" style="font-size: 20px"> <i  class="window close outline icon"></i></div></div>
        <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;"class="col-sm-5 col-form-label">Denumire domeniu:</label>
           
            <div class="col-sm-6">
                <input required type="text" name="name"  class="form-control" />
            </div>
        </div>

        <div class="form-group row">
            <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Ciclu de studii:</label>
            <div class="col-sm-6">
                <select  id="progstudii" name="progstudii" class="form-control">
                    <option disabled selected value></option>
                    <?php foreach ($ciclu_studii as $progamstudii_name){?>
                    <option  value="<?php echo $progamstudii_name['id'] ?>"><?php echo $progamstudii_name['denumire'];} ?></option>
                </select>

            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
            
                <button style="margin-bottom: 5px; margin-left: 5px"type="submit"  name="submit_domain" class="btn btn-secondary">Adaugare</button>
            </div>
        </div>

    </form>
</div>

<div class="container">



   <br><br>


    <form  id='add_spec' style="border: 1px grey solid; width: 40%; border-radius: 10px;margin-bottom: 10px" >
        <div class="form-group row" style="margin-top: 5px"> <div class="col-sm-12" style="font-size: 20px"> <i  class="window close outline icon"></i></div></div>
        <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Denumire specializare:</label>
            <div class="col-sm-6">
                <input required name="name" class="form-control">
            </div>
        </div>
                <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Abreviere specializare:</label>
            <div class="col-sm-6">
                <input required name="abv_spec" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Ciclul de studii</label>
            <div class="col-sm-6">
                <select  name="progstudii"  class="form-control">
                    <option disabled selected value></option>
                    <?php foreach ($ciclu_studii as $progamstudii_name){?>
                    <option name="progstudii_name" value="<?php echo $progamstudii_name['id'] ?>"><?php echo $progamstudii_name['denumire'];} ?></option>
                </select>

            </div>
        </div>

            <div class="form-group row">
                <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Domeniul specializarii:</label>
                <div class="col-sm-6">
                    <select  id="choose_domain" name='domain_name' class="form-control">

                    </select>

                </div>
            </div>


        <div class="form-group row">
            <div class="col-sm-10">
                <button style="margin-bottom: 5px; margin-left: 5px" type="submit"  name="submit_spec" class="btn btn-secondary">Adaugare</button>
            </div>
        </div>

    </form></div>

<!-- FORMULAR EDITARE DOMENIU-->


<div class="container">
    <form  id='edit_domain'style="border: 1px grey solid; width: 40%; border-radius: 10px;margin-bottom: 10px" >
        <div class="form-group row" style="margin-top: 5px"> <div class="col-sm-12" style="font-size: 20px"> <i  class="window close outline icon"></i></div></div>
        <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;"class="col-sm-5 col-form-label">Denumire domeniu:</label>
           
            <div class="col-sm-6">
                <input required type="text" name="name"  class="form-control" />
            </div>
        </div>

        <div class="form-group row">
            <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Program de studii:</label>
            <div class="col-sm-6">
                <select   name="edit_progstudii" class="form-control">
                    <option  selected>Choose...</option>
                    <?php mysqli_data_seek($ciclu_studii, 0); while ($progstudii_name = $ciclu_studii->fetch_assoc()) { ?>
                    <option name="progstudii_name" data-id="<?php echo $progstudii_name['id']; ?>"><?php echo $progstudii_name['denumire']; }?></option>
                </select>
                <input name='progstudii_id' id="edit_progstudii_id" type="text" hidden value="" >
            </div>
        </div>



        <div class="form-group row">
            <div class="col-sm-10">
            
                <button style="margin-bottom: 5px; margin-left: 5px"type="submit"  id="save_domain" class="btn btn-secondary">Adaugare</button>
            </div>
        </div>

    </form>
</div>

<!-- FORMULAR EDITARE Spec-->
<div class="container">

<form  id='edit_spec' style="border: 1px grey solid; width: 40%; border-radius: 10px;margin-bottom: 10px" method="get">
    <div class="form-group row" style="margin-top: 5px"> <div class="col-sm-12" style="font-size: 20px"> <i  class="window close outline icon"></i></div></div>
        <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Denumire specializare:</label>
            <div class="col-sm-6">
                <input required name="name" class="form-control">
            </div>
        </div>
                <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Abreviere specializare:</label>
            <div class="col-sm-6">
                <input required name="abv_spec" class="form-control">
            </div>
        </div>
    <div class="form-group row">
        <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Ciclul de studii</label>
        <div class="col-sm-6">
            <select  name="progstudii"  class="form-control">
                <option disabled selected value></option>
                <?php foreach ($ciclu_studii as $progamstudii_name){?>
                <option name="progstudii_name" value="<?php echo $progamstudii_name['id'] ?>"><?php echo $progamstudii_name['denumire'];} ?></option>
            </select>

        </div>
    </div>

    <div class="form-group row">
        <label style="margin-left: 5px;" class="col-sm-5 col-form-label">Domeniul specializarii:</label>
        <div class="col-sm-6">
            <select  id="edit_choose_domain" name='edit_domain_name' class="form-control">

            </select>

        </div>
    </div>


        <div class="form-group row">
            <div class="col-sm-10">
                <button style="margin-bottom: 5px; margin-left: 5px" type="submit"  name="save_spec" class="btn btn-secondary">Adaugare</button>
            </div>
        </div>

    </form></div>
</div>




<div class="container">
    <h3>Licenta</h3>
<table class="table table-bordered" id="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Denumire</th>

        <th scope="col">Edit/Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql1= "SELECT  * FROM domenii WHERE id_ciclu_studii = 1";
    $result= mysqli_query($dbCon->getCon(), $sql1);
    mysqli_data_seek($result, 0);
    while ($row = $result->fetch_assoc()) {

        echo " <tr  class='domain_row'>
            <th  style='width :5%'scope='row'>" . $i . "</th>
            <td style='width: 50%'>" . $row['denumire'] . "</td>
         <td style='width: 45%'>
                <button class='btn-info btn edit_btn_domain' data-id=" . $row['id'] . " > Editare</button>
                <button class='btn-danger btn del_btn_domain' data-id=" . $row['id'] . " name='delete_domain'>Stergere</button>
                
                <button  style='float : right' class='btn-secondary btn spec' >Specializari<i class=\"caret down icon\"></i></button>
            </td>
        </tr>";
        $id=$row['id'];
        $sql2= "SELECT  * FROM specializari WHERE id_domeniu = '$id'";
        $result2 = mysqli_query($dbCon->getCon(), $sql2);
        $j=1;
        while($row2=$result2->fetch_assoc()){


            echo "
            <tr style='background-color: rgba(0,0,0,0.2)' class='spec_row'>
                
                <th  style='width: 5%' scope='row'>" . $j . "</th>
                <th style='width: 50%' scope='row'>" . $row2['denumire'] . " - " . $row2['abreviere'] . "</th>
                   
                <td style='width: 45%'>
                    <button class='btn-info btn btn_edit_spec' data-id=" . $row2['id'] . " > Editare</button>
                    <button class='btn-danger btn del_btn_spec' data-id=" . $row2['id'] . ">Stergere</button>
                </td>
            </tr>";
            $j++;
        }

        $i++;
    } ?>
    </tbody>
</table>
</div>

<br><br>

<div class="container">
    <h3>Master</h3>
    <table class="table table-bordered" id="table2">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Denumire</th>

            <th scope="col">Edit/Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql3= "SELECT  * FROM domenii WHERE id_ciclu_studii = 2";
        $result3= mysqli_query($dbCon->getCon(), $sql3);
        mysqli_data_seek($result3, 0);
        while ($row3 = $result3->fetch_assoc()) {
          if ($row3['id_ciclu_studii'] = 2){

            echo " <tr  class='domain_row'>
            <th  style='width :5%'scope='row'>" . $i . "</th>
            <td style='width: 50%'>" . $row3['denumire'] . "</td>
         <td style='width: 45%'>
                <button class='btn-info btn edit_btn_domain' data-id=" . $row3['id'] . " > Editare</button>
                <button class='btn-danger btn del_btn_domain' data-id=" . $row3['id'] . " name='delete_domain'>Stergere</button>
                
                <button  style='float : right' class='btn-secondary btn spec' >Specializari<i class=\"caret down icon\"></i></button>
            </td>
        </tr>";
            $id=$row3['id'];
            $sql4= "SELECT  * FROM specializari WHERE id_domeniu = '$id'";
            $result4 = mysqli_query($dbCon->getCon(), $sql4);
            $j=1;
            while($row4=$result4->fetch_assoc()){


                echo "
            <tr style='background-color: rgba(0,0,0,0.2)' class='spec_row'>
                
                <th  style='width: 5%' scope='row'>" . $j . "</th>
                <th style='width: 50%' scope='row'>" . $row4['denumire'] . " - " . $row4['abreviere'] . "</th>
                   
                <td style='width: 45%'>
                    <button class='btn-info btn btn_edit_spec' data-id=" . $row4['id'] . " > Editare</button>
                    <button class='btn-danger btn del_btn_spec' data-id=" . $row4['id'] . ">Stergere</button>
                </td>
            </tr>";
                $j++;
            }

            $i++;
          }}?>
        </tbody>
    </table>
</div>

</body>





</body>
</html>

<script>

    $( document ).ready(function() {
        $('.spec_row').hide();
        $('.dialog_confirm').hide();

        $('#add_domain').hide();
        $('#add_spec').hide();
        $('#edit_domain').hide();
        $('#edit_spec').hide();
       
        // CREATE DOMAIN AND SPEC

        $('#btn_domain').click(function(){
        $('#add_domain').show();
        })

        $('#btn_spec').click(function(){
        $('#add_spec').show();
        })




        $('.spec').click(function (event) {
            $(event.currentTarget).closest('.domain_row').nextUntil('.domain_row').toggle();

        })

        $("[name='progstudii']").change(function (event) {
            let progstudies_id = $("option[name='progstudii_name']:selected").val();
            console.log(progstudies_id);
            $('#choose_domain').empty();


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

                        $('#choose_domain').append("<option value='"+id+"'>"+name+"</option>");

                    }

                },

            });

        });





        // EDIT AND DELETE DOMAIN
            
        $('.edit_btn_domain').click(function () {
            var id = $(this).data("id");
        $('#edit_domain').val(id);
        console.log(id);
        action = 'EDIT';
        console.log(action);

            $.ajax({
                url: "action_domain.php",
                method: "POST",
                data: {id: id, action: action},
                dataType: "json",
                success: function (row) {
                    $('#edit_domain').find(('input[name="name"]')).val(row.denumire);
                    $('#edit_domain').find(('option[data-id='+row.id_ciclu_studii+']')).attr("selected","selected");
                    $('#edit_domain').show();

                },
                error: function(){
                    console.log(action);
                }
            })

        })

        $('#edit_progstudii').change(function () {
            let progstudii_id = $("option[name='progstudii_name']:selected").data("id");
            $('#edit_progstudii_id').attr('value',progstudii_id);

        })

        $('#save_domain').click(function () {
           action = 'UPDATE';
           id=$('#edit_domain').val();
            var name=$('#edit_domain').find(('input[name="name"]')).val();
            var ciclu_studii_id=$('#edit_domain').find(('select[name="edit_progstudii"]')).find(('option:selected')).data("id");
            console.log(name);


            $.ajax({
                url: "action_domain.php",
                method: "POST",
                data: {action:action, id:id,name:name,ciclu_studii_id:ciclu_studii_id},
                dataType: "json",
                success: function (response) {
                    alert(response);
                }

            });

        })

        $('.del_btn_domain').click(function(event){
            var domain_id = $(this).data("id");
            var conf = confirm("TOATE SPECIALIZARILE CARE APARTIN DOMENIULUI VOR FI STERSE! Doriti sa continuati?");
            if (conf == true){
                console.log(domain_id);
                var action='DELETE';
                console.log(action);

                $.ajax({
                    url:"action_domain.php",
                    method:"POST",
                    data:{domain_id:domain_id,action:action},
                    dataType:"json",
                   
                    success:function(response){
                        location.reload();
                      alert(response);
                    }
                });
            }
        });



            //EDIT AND DELETE SPEC


        $('.del_btn_spec').click(function(){

            var spec_id = $(this).data("id");
            console.log(spec_id);
            var conf = confirm("DORITI SA STERGETI ACEASTA SPECIALIZARE?");
            if (conf == true){


                var action='DELETE';


                $.ajax({
                    url:"action_spec.php",
                    method:"POST",
                    data:{spec_id:spec_id,action:action},
                    dataType:"json",
                    success:function(response)
                    {

                        location.reload();
                        alert(response);

                    }
                });
            }
        })


        $('.btn_edit_spec').click(function () {

            $('#edit_choose_domain').empty();

            var id = $(this).data("id");

        $('#edit_spec').val(id);

        action = 'EDIT';

            $.ajax({
                url: "action_spec.php",
                method: "POST",
                data: {id: id, action: action},
                dataType: "json",
                success: function (row) {



                    $('#edit_spec').find(('input[name="name"]')).val(row.denumire);
                    $('#edit_spec').find(('input[name="abv_spec"]')).val(row.abreviere);
                    $('#edit_spec').find(('select[name="progstudii"]')).find(('option[value='+row.id_ciclu_studii+']')).attr("selected","selected");

                    let progstudies_id = ($('select[name="progstudii"]')).find(("option[name='progstudii_name']:selected")).val();
                    console.log(progstudies_id);


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

                                $('#edit_choose_domain').append("<option value='"+id+"'>"+name+"</option>");

                            }
                            $('#edit_spec').find(('#edit_choose_domain')).find(('option[value='+row.id_domeniu+']')).attr("selected","selected");
                        },

                    });


                    $('#edit_spec').show();
                    console.log(row);
                },


            })

        })

        $("[name='progstudii']").change(function (event) {
            let progstudies_id = $("option[name='progstudii_name']:selected").val();

            $('#edit_choose_domain').empty();


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

                        $('#edit_choose_domain').append("<option value='"+id+"'>"+name+"</option>");

                    }

                },

            });

        });

        $('button[name ="save_spec"]').click(function () {

           action = 'UPDATE';
           id=$('#edit_spec').val();
            var name=$('#edit_spec').find(('input[name="name"]')).val();
            var abr=$('#edit_spec').find(('input[name="abv_spec"]')).val();
            var progstudies= $('#edit_spec').find(('select[name="progstudii"]')).find(('option:selected')).val();
            var domain_id=$('#edit_spec').find(('#edit_choose_domain')).find(('option:selected')).val();


            $.ajax({
                url: "action_spec.php",
                method: "POST",
                data: {action:action, id:id,name:name,domain_id:domain_id,abr:abr,progstudies:progstudies},
                dataType: "json",
                success: function (response) {
                    alert(response);
                },
                error: function(){
                    alert(2);
                }
            });

        })

        $("[name='submit_spec']").click(function () {

            var action='CREATE';
            var name=$('#add_spec').find(('input[name="name"]')).val();
            var abr=$('#add_spec').find(('input[name="abv_spec"]')).val();
            var progstudies= $('#add_spec').find(('select[name="progstudii"]')).find(('option:selected')).val();
            var domain=$('#add_spec').find(('select[name="domain_name')).find(('option:selected')).val();

            $.ajax({
                url: 'action_spec.php',
                method:'POST',
                data: {action:action, name:name, abr:abr, progstudies:progstudies, domain:domain},
                dataType: 'json',


                success: function (response) {
                    alert(response);
                },
                error: function(){
                    alert(domain);
                }
            })

        });




             $('.window').click(function(){
            $(this).closest('form').find("input").val("");
            $(this).closest('form').hide();
        })
 
    });


</script>
