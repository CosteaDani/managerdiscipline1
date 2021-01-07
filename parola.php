<?php


include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';

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


    <br><br>

    <form  id='pass_change' style="border: 1px grey solid; width: 40%; border-radius: 4px;margin-bottom: 10px"  >

        <div class="form-group row">
            <label style="margin-left: 5px;"class="col-sm-4 col-form-label">Parola veche:</label>
            <div class="col-sm-6">
                <input type="password" id="pass_old" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label style="margin-left: 5px;"class="col-sm-4 col-form-label">Parola noua:</label>
            <div class="col-sm-6">
                <input type="password" id="pass_new" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label style="margin-left: 5px;"class="col-sm-4 col-form-label">Parola noua din nou:</label>
            <div class="col-sm-6">
                <input type="password" id="pass_confirm" class="form-control" required>
            </div>
        </div>
        <button type="submit" id="schimbare"  style="margin-bottom: 5px; margin-left: 5px"  class="btn btn-secondary">Salveaza</button>
</form>
</div>

</body>
</html>
<script>
    $(document).ready(function() {
        $('#schimbare').click(function() {
            var action='SUBMIT';
            console.log(action);
            var oldPass = $("#pass_old").val();
            console.log(oldPass);
            var newPass = $("#pass_new").val();
            console.log(newPass);
            var confirmPass = $("#pass_confirm").val();
            console.log(confirmPass);

            $.ajax({
                url: "action_pass.php",
                method: "POST",
                data:{action:action,oldPass:oldPass,newPass:newPass,confirmPass:confirmPass},
                dataType: "json",

                success:function(response) {
                    console.log(response)
                    alert(response);
                },
                error:function(response){
                    console.log(response)
                    alert(response);
                }
            });

        })

    })

</script>