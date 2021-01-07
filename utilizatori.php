<?php


include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$sql = "SELECT * FROM utilizatori ORDER BY nume ASC";
$result = mysqli_query($dbCon->getCon(), $sql);
$i=1;?>
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


    <br><br>
    <div class="form-group row">
        <div class="col-sm-4">
            <button  id="add_user"  name="submit" class="btn btn-primary"><i class="add user icon"></i>Utilizator nou</button>
        </div>
    </div>

<!--FORMULAR adaugare-->

    <form action="action_users.php" id='add_user_form' style="border: 1px grey solid; width: 40%; border-radius: 4px;margin-bottom: 10px" method="get">
        <div class="form-group row" style="margin-top: 5px"> <div class="col-sm-12" style="font-size: 20px"> <i  class="window close outline icon"></i></div></div>
        <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;" class="col-sm-4 col-form-label">Cont utilizator:</label>
            <div class="col-sm-6">
                <input name="username" class="form-control">
            </div>
        </div>

            <div class="form-group row">
                <label style="margin-left: 5px;"class="col-sm-4 col-form-label">Nume:</label>
                <div class="col-sm-6">
                    <input name="name" class="form-control">
                </div>
            </div>

        <div class="form-group row">
            <label style="margin-left: 5px;" class="col-md-4 col-form-label">Tip utilizator</label>
            <div class="col-md-6">
                <select name="rol" class="form-control ">
                    <option disabled selected value></option>
                    <option value="1">Secretariat</option>
                    <option value="2">Profesor</option>
                </select></div>
        </div>
        <button type="submit" id="add"  style="margin-bottom: 5px; margin-left: 5px" name="submit" class="btn btn-secondary">Adauga</button> </form>


<!-- FORMULAR EDITARE-->

    <form  id='edit_user_form' style="border: 1px grey solid; width: 40%; border-radius: 4px;margin-bottom: 10px" method="get">
        <div class="form-group row" style="margin-top: 5px"> <div class="col-sm-12" style="font-size: 20px"> <i  class="window close outline icon"></i></div></div>
        <div class="form-group row" style="margin-top: 10px">
            <label style="margin-left: 5px;" class="col-sm-4 col-form-label">Cont utilizator:</label>
            <div class="col-sm-6">
                <input name="username" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label style="margin-left: 5px;"class="col-sm-4 col-form-label">Nume:</label>
            <div class="col-sm-6">
                <input name="name" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label  style="margin-left: 5px;" class="col-md-4 col-form-label">Tip utilizator</label>
            <div class="col-md-6">
                <select name="rol" class="form-control ">
                    <option disabled selected value></option>
                    <option value="1">Secretariat</option>
                    <option value="2">Profesor</option>
                </select></div>
        </div>
        <button type="submit" id="save"  style="margin-bottom: 5px; margin-left: 5px"  class="btn btn-secondary">Salveaza</button> </form>






    <table class="table table-bordered" id="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nume</th>
            <th scope="col">Cont utilizator</th>

            <th scope="col">Editare/stergere</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) {
            echo " <tr>
            <th scope='row'>" . $i . "</th>
            <td>" . $row['nume'] . "</td>
            <td>" . $row['cont_utilizator'] . "</td>
            <td>
                <button class='btn-info btn' data-id=" . $row['id'] . " name='btn-edit'> Editare</button>
                <button class='btn-danger btn del_btn_user' data-id=" . $row['id'] . " id='btn-delete'>Stergere</button>
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
    $( document ).ready(function() {
        $('.alert').hide();
        var id;
        var action;
        $('#add_user_form').hide();
        $('#edit_user_form').hide();

        $('#add_user').click(function () {
            $('#add_user_form').show();
        })


        $('button[name="btn-edit"]').click(function () {

            var id = $(this).data("id");
            $('#edit_user_form').val(id);


            console.log(id);
            action = 'EDIT';
            console.log(action);

            $.ajax({
                url: "action_users.php",
                method: "POST",
                data: {id: id, action: action},
                dataType: "json",
                success: function (row) {
                    $('#edit_user_form').find(('input[name="username"]')).val(row.cont_utilizator);
                    $('#edit_user_form').find(('input[name="name"]')).val(row.nume);
                    $('#edit_user_form').find(('select[name="rol"]')).find(('option[value='+row.rol+']')).attr("selected","selected");
                    $('#edit_user_form').show();

                },
                error: function(){
                    console.log(action);
                }
            })

        })



        $('#save').click(function () {
           action = 'UPDATE';
           id=$('#edit_user_form').val();
           console.log($('#edit_user_form').val());
            var name=$('#edit_user_form').find(('input[name="name"]')).val();
            console.log(name);

            var username=$('#edit_user_form').find(('input[name="username"]')).val();
            console.log(username);
            var role=$('#edit_user_form').find(('select[name="rol"]')).find(('option:selected')).val();
            $.ajax({
                url: "action_users.php",
                method: "POST",
                data: {action:action, id:id,name:name, username:username,role:role},
                dataType: "json",
                success: function (response) {
                    alert(response);

                }

            });

      })


        $('.del_btn_user').click(function(){
            var user_id = $(this).data("id");
            var conf = confirm("ACEST UTILIZATOR VA FI ȘTERS! Doriți să continuați?");
            if(conf == true){
                console.log(user_id);
                var action='DELETE';
                console.log(action);
                $.ajax({
                    url: "action_users.php",
                    method:"POST",
                    data:{user_id:user_id,action:action},
                    dataType:"json",

                    success:function(response){
                        location.reload();
                        alert(response);

                    }

                });
            }
        });



        $('.window').click(function(){
            $(this).closest('form').find("input").val("");
            $(this).closest('form').hide();

        })


  })



</script>


