<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';

$dbCon = new DbConnection();

$sql="SELECT *  FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Licenta') ORDER BY id DESC LIMIT 1";
$result = mysqli_query($dbCon->getCon(), $sql)->fetch_assoc();
$sql1="SELECT * FROM promotii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Master') ORDER BY id DESC LIMIT 1";
$result1 = mysqli_query($dbCon->getCon(), $sql1)->fetch_assoc();

$domain_L=mysqli_query($dbCon->getCon(), "SELECT * FROM domenii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Licenta')");
$domain_M=mysqli_query($dbCon->getCon(), "SELECT * FROM domenii WHERE id_ciclu_studii=(SELECT id FROM ciclu_studii WHERE denumire='Master')");

$current_year=date('Y');

$limit = new DateTime($current_year.'-10-01');
$today=new DateTime('now');
if($today <= $limit)  { $current_year=$current_year-1;}




?>
<head>
    <title> home </title>
    <link rel="stylesheet" type="text/css" href="resources\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">
    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">
    <link rel="stylesheet" type="text/css" href="resources\css\semantic.min.css">

    <script src="resources\js\jquery-3.4.1.min.js"></script>
    <script src="resources\js\bootstrap.min.js"></script>
    <script src="resources\js\menu.js"></script>
    <script src="resources\js\semantic.min.js"></script>
    <script>
        $(function () {
            $("#nav_bar").load("resources\\nav_bar.php");
        });

    </script>
</head>

<body>




<div id="nav_bar"></div>
<br><br><br>

<div class="container">

    <div class="form-group row">


        <div style='margin-bottom: 20px' class="col-sm-5">
            <h2> Promotia curenta al ciclului de Licenta: <?php echo ($result['inceput'].'-'.$result['sfarsit']); ?></h2>
        </div></div>

    <div class="form-group row">

        <div class="col-sm-2">
            <button  id="add_promotion"  name="submit" class="btn btn-primary"><i style="font-size: 15px"class="graduation cap icon"></i>Promotie noua  </button>
        </div>

        <form  id='new_promotion' style="border: 1px grey solid; width: 40%; border-radius: 4px;margin-bottom: 10px" method="post">

            <div class="form-group row" style="margin-top: 10px">
                <label style="margin-left: 5px;" class="col-sm-4 col-form-label">Perioada:</label>
                <div class="col-sm-3">
                    <input readonly="readonly" id="start" value="<?php echo $current_year; ?>" class="form-control" required>
                </div>
                <div style="font-size: 20px">
                    -
                </div>

                <div class="col-sm-3">
                    <input  readonly="readonly" id="end" value=<?php echo $current_year+4; ?>  class="form-control" required>
                </div>

            </div>
            <input  hidden name="cicle" value='Licenta'  class="form-control">
            <button type="submit" id="save"  style="margin-bottom: 5px; margin-left: 5px"  class="btn btn-secondary">Salveaza</button> </form>

    </div>
<br><br>

    <div class="form-group row">


        <div style='margin-bottom: 20px' class="col-sm-5">
            <h2> Promotia curenta al ciclului de Master: <?php echo ($result1['inceput'].'-'.$result1['sfarsit']); ?></h2>
        </div></div>
    <div class="form-group row">

        <div class="col-sm-2">
            <button  id="add_promotion_M"  name="submit" class="btn btn-primary"><i style="font-size: 15px"class="graduation cap icon"></i>Promotie noua  </button>
        </div>

        <form  id='new_promotion_M' style="border: 1px grey solid; width: 40%; border-radius: 4px;margin-bottom: 10px" method="post">

            <div class="form-group row" style="margin-top: 10px">
                <label style="margin-left: 5px;" class="col-sm-4 col-form-label">Perioada:</label>
                <div class="col-sm-3">
                    <input readonly="readonly" id="start_M" value="<?php echo $current_year; ?>" class="form-control" required>
                </div>
                <div style="font-size: 20px">
                    -
                </div>

                <div class="col-sm-3">
                    <input readonly="readonly" id="end_M" value=<?php echo $current_year+2; ?>  class="form-control" required>
                </div>

            </div>
            <input  hidden name="cicle" value='Master'  class="form-control">
            <button type="submit" id="save_M"  style="margin-bottom: 5px; margin-left: 5px"  class="btn btn-secondary">Salveaza</button> </form>

    </div>

<!--    <h3>Licenta</h3>-->
    <table class="table mt-5">
        <h3>Licenta:</h3>
        <thead>
        <tr>

            <th scope="col">Domeniu</th>
            <th scope="col">Program de studiu</th>
            <th scope="col" style="width: 25%" colspan="4">An de studii</th>
        </tr>
        </thead>

        <tbody>
        <?php

        while($row=mysqli_fetch_assoc($domain_L)){
            $id=$row['id'];
            $spec=mysqli_query($dbCon->getCon(), "SELECT * FROM specializari WHERE id_domeniu='$id'");
            ?>
            <tr><td rowspan="<?php echo mysqli_num_rows($spec);?>"><?php echo $row['denumire'];?></td>

            <?php $i=0; while($row2=mysqli_fetch_assoc($spec)){?>
                <?php
                if($i==0){?> <td class="name_spec" id=<?php echo $row2['abreviere']?>> <?php echo $row2['denumire'];?></td>
                    <td><a href="resources/pi/<?php echo ($current_year).'-'.($current_year+4).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an1.pdf'?>" >Anul I</a></td>
                    <td><a href="resources/pi/<?php echo ($current_year-1).'-'.($current_year+3).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an2.pdf'?>">Anul II</a></td>
                    <td> <a href="resources/pi/<?php echo ($current_year-2).'-'.($current_year+2).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an3.pdf'?>">Anul III</a></td>
                    <td><a href="resources/pi/<?php echo ($current_year-3).'-'.($current_year+1).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an4.pdf'?>">Anul IV</a></td>

                    </tr>
                <?php }
                else {?> <tr><td class="name_spec" id=<?php echo $row2['abreviere']?> >
                        <?php  echo $row2['denumire'];?> </td>
                    <td><a href="resources/pi/<?php echo ($current_year).'-'.($current_year+4).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an1.pdf'?>" >Anul I</a></td>
                    <td><a href="resources/pi/<?php echo ($current_year-1).'-'.($current_year+3).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an2.pdf'?>">Anul II</a></td>
                    <td> <a href="resources/pi/<?php echo ($current_year-2).'-'.($current_year+2).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an3.pdf'?>">Anul III</a></td>
                    <td><a href="resources/pi/<?php echo ($current_year-3).'-'.($current_year+1).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an4.pdf'?>">Anul IV</a></td>
                </tr>
                <?php }  $i++;} ?>

        <?php  }

        ?>

        </tbody>
    </table>
<br><br><br>
    <h3>Master:</h3>
    <table class="table mt-5">
        <thead>
        <tr>

            <th scope="col">Domeniu</th>
            <th scope="col">Program de studiu</th>
            <th scope="col" style="width: 25%" colspan="4">An de studii</th>
        </tr>
        </thead>

        <tbody>
        <?php

        while($row=mysqli_fetch_assoc($domain_M)){
            $id=$row['id'];
            $spec=mysqli_query($dbCon->getCon(), "SELECT * FROM specializari WHERE id_domeniu='$id'");
            ?>
            <tr><td rowspan="<?php echo mysqli_num_rows($spec);?>"><?php echo $row['denumire'];?></td>

            <?php $i=0; while($row2=mysqli_fetch_assoc($spec)){?>
                <?php
                if($i==0){?> <td class="name_spec" id=<?php echo $row2['abreviere']?>> <?php echo $row2['denumire'];?></td>
                    <td><a href="resources/pi/<?php echo ($current_year).'-'.($current_year+2).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an1.pdf'?>" >Anul I</a></td>
                    <td><a href="resources/pi/<?php echo ($current_year-1).'-'.($current_year+1).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an2.pdf'?>">Anul II</a></td>
<!--                    <td> <a href="resources/pi/--><?php //echo ($current_year-3).'-'.($current_year+1).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an3.pdf'?><!--">Anul III</a></td>-->
<!--                    <td><a href="resources/pi/--><?php //echo ($current_year-4).'-'.($current_year).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an4.pdf'?><!--">Anul IV</a></td>-->

                    </tr>
                <?php }
                else {?> <tr><td class="name_spec" id=<?php echo $row2['abreviere']?> >
                        <?php  echo $row2['denumire'];?> </td>
                    <td><a href="resources/pi/<?php echo ($current_year-1).'-'.($current_year+1).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an1.pdf'?>" >Anul I</a></td>
                    <td><a href="resources/pi/<?php echo ($current_year-2).'-'.($current_year).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an2.pdf'?>">Anul II</a></td>
<!--                    <td> <a href="resources/pi/--><?php //echo ($current_year-3).'-'.($current_year+1).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an3.pdf'?><!--">Anul III</a></td>-->
<!--                    <td><a href="resources/pi/--><?php //echo ($current_year-4).'-'.($current_year).'/'.$row2['abreviere'].'/PI_'.$row2['abreviere'].'-an4.pdf'?><!--">Anul IV</a></td>-->
                </tr>
                <?php }  $i++;} ?>

        <?php  }

        ?>

        </tbody>
    </table>
</div>

</body>
<br><br><br><br><br><br><br><br><br><br><br><br>
<script>
    $(document).ready(function(){

        $('#new_promotion').hide();
        $('#add_promotion').click(function(){
            $('#new_promotion').toggle();
        });
        $('#new_promotion_M').hide();
        $('#add_promotion_M').click(function(){
            $('#new_promotion_M').toggle();
        });

        $('#save').click(function(){

            const start=$('#start').val();
            const end=$('#end').val();
            const cicle=$(('#save')).siblings('input[name="cicle"]').val()

            $.ajax({url:"action_promotion.php",
                method:"POST",
                data:{start:start,end:end,cicle:cicle},
                dataType:"json",
                success:function(response)
                {
                   if(response==1){
                       alert("Promotia curenta a fost schimbata in "+start+"-"+end+"!");
                       window.location.replace('home.php?ciclu-studii=licenta');
                   }
                   else if(response==0){
                       alert("Aceasta este deja promotia curenta!");
                   }
                },
                error: function()
                {
                    alert(2);
                }
            })
        })

        $('#save_M ').click(function(){

            const start_M=$('#start_M').val();
            const end_M=$('#end_M').val();
            const cicle=$(('#save_M')).siblings('input[name="cicle"]').val();


            $.ajax({url:"action_promotion.php",
                method:"POST",
                data:{start_M:start_M,end_M:end_M,cicle:cicle},
                dataType:"json",
                success:function(response)
                {
                    if(response==1){
                        alert("Promotia curenta a fost schimbata in "+start_M+"-"+end_M+"!");
                        window.location.replace('home.php?ciclu-studii=master');
                    }
                    else if(response==0){
                        alert("Aceasta este deja promotia curenta!");
                    }
                },
                error: function () {
                    alert(2);
                }
            })
        })

        let params = (new URL(document.location)).searchParams;



        if(params.get('ciclu-studii')=='master'){
            const start=$('#start').val();
            const end=$('#end').val();
            const cicle=$(('#save_M')).siblings('input[name="cicle"]').val();
            console.log(cicle);

            $('.container').append(' <div  data-backdrop="static"  data-keyboard="false" id="myModal" role="dialog"> <div class="modal-dialog"><div class="modal-content"> <div class="modal-header"></div><div class="modal-body"><p>Doriti sa se adauge disciplinele conform planului de invatamant de anul trecut?</p></div><div class="modal-footer"><button  id="yes" type="button" class="btn btn-default" >Da</button> <button type="button" id="no" class="btn btn-default" >Nu</button></div> </div></div> </div>');
            $("#myModal").modal('show');

            $("body > *").not("body > .btn-default").on('click', function(){
                $('#myModal').modal('show');
            })



            $(".close").on('click',function(){
                $("#myModal").modal('hide');
            })

            $('#yes').on('click',function(){

                $.ajax({
                    url: 'new_promotion.php',
                    method:"POST",
                    data:{start:start,end:end,cicle:cicle},
                    dataType:"json",
                    success:function(response){
                        alert(response);
                        // if ((response)==1){ alert('succes');}
                        // else {alert('fail');}
                    },
                })
                window.location.replace('home.php');
            })
            $('#no').on('click',function(){
                window.location.replace('home.php');
            })

        }

        if(params.get('ciclu-studii')=='licenta'){
            const start=$('#start').val();
            const end=$('#end').val();
            const cicle=$(('#save')).siblings('input[name="cicle"]').val();

            $('.container').append(' <div  data-backdrop="static"  data-keyboard="false" id="myModal" role="dialog"> <div class="modal-dialog"><div class="modal-content"> <div class="modal-header"></div><div class="modal-body"><p>Doriti sa se adauge disciplinele conform planului de invatamant de anul trecut?</p></div><div class="modal-footer"><button  id="yes" type="button" class="btn btn-default" >Da</button> <button type="button" id="no" class="btn btn-default" >Nu</button></div> </div></div> </div>');
            $("#myModal").modal('show');

            $("body > *").not("body > .btn-default").on('click', function(){
                $('#myModal').modal('show');
            })



            $(".close").on('click',function(){
                $("#myModal").modal('hide');
            })

            $('#yes').on('click',function(){

                $.ajax({
                    url: 'new_promotion.php',
                    method:"POST",
                    data:{start:start,end:end,cicle:cicle},
                    dataType:"json",
                    success:function(response){
                        alert(response);
                        // if ((response)==1){ alert('succes');}
                        // else {alert('fail');}
                    },
                })
                window.location.replace('home.php');
            })
            $('#no').on('click',function(){
                window.location.replace('home.php');
            })

        }


    })





</script>
