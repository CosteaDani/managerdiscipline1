<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="resources\jquery-master\src\jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="resources\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources\css\login.css">

    <meta charset="UTF-8">

</head>
<body>
<form id="home_id" action="logIn.php" method="post">
    <?php if(isset($_GET['fisadisc'])) {?> <input name="id_disc" type="hidden" value=<?php echo $_GET['fisadisc']; ?>><?php }?>
    <div class="container form-inline">
        <div class="col-lg-3 col-md-3 col-sm-2"></div>
        <div class="col-lg-6 col-md-6 col-sm-8">
            <div class="logo">
                <img src="resources\logo.jpg" alt="Logo">
            </div>
            <div class="row loginbox" align="center">
                <div class="col-lg-12">
                    <span class="singtext">Sign in </span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <input class="form-control" name="user" type="text" placeholder="Please enter your user name">
                </div>
                <div class="col-lg-12  col-md-12 col-sm-12">
                    <input class="form-control" name="pass" type="password" placeholder="Please enter password">
                </div>
                <div class="col-lg-12  col-md-12 col-sm-12">
                    <button type="submit" class="btn  submitButton" name="login_btn">Submit </button>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>