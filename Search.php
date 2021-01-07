<?php
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';


$dbCon = new DbConnection();
//$sql = "SELECT * FROM promotii ORDER BY id DESC LIMIT 1";
//$result = mysqli_query($dbCon->getCon(), $sql)->fetch_assoc();
$programstudies = mysqli_query($dbCon->getCon(), "SELECT * FROM ciclu_studii ");
?>
<html>
<head>

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


    <form>
        <div class="form-row">
            <div class="form-group col-md-2 mr-5">
                <label for="choose_promotion">Promotia:</label>
                <select required class="form-control" id="promo">
                    <option disabled selected value=""></option>
                    <?php $promotions = mysqli_query($dbCon->getCon(), 'SELECT * from promotii');

                    $array = [];
                    while ($promotion = $promotions->fetch_assoc()) {

                        $start = $promotion['inceput'];
                        $end = $promotion['sfarsit'];

                        $row = $promotion['inceput'] . "-" . $promotion['sfarsit'];
                        echo(' <option>' . $row . '</option>');
                    } ?>
                </select>
            </div>



                <div class="col-md-3 form-group mr-5">
                    <label for="promotii">Ciclu de studii</label>
                    <select id="progstudii" name="progstudii" class="form-control">
                        <option disabled selected></option>
                        <?php foreach ($programstudies as $progstudies_name){?>
                        <option name="progstudii_name" value="<?php echo $progstudies_name['id'] ?>"><?php echo $progstudies_name['denumire'];} ?></option>
                    </select>
                </div>


            <div class="col-md-3 form-group mr-5">
                <label for="choose_specialization">Specializarea:</label>
                <select required class="form-control" id="choose_spec">
                    <option disabled selected></option>
                    <?php $specializations = mysqli_query($dbCon->getCon(), 'SELECT * from specializari');


                    while ($row = mysqli_fetch_assoc($specializations)) {


                        echo(' <option value="' . $row['abreviere'] . '">' . $row["denumire"] . '</option>');
                    } ?>
                </select>
            </div>


        </div>
        <div class="form-group">
            <button type="button" id="search" class="btn btn-info">Cautare</button>
        </div>


    </form>
</div>
<div class="container mt-5">
    <ul class="list-group list-group-flush" id="pdf_list">


    </ul>


</div>


</body>
</html>

<script>
    $(document).ready(function () {


        $('#progstudii').change(function (event) {
            let progstudies_id = $("option[name='progstudii_name']:selected").val();

            $('#choose_spec').empty();

            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'dropdown_spec_search.php',
                data: {progstudies_id:progstudies_id},
                dataType: 'json',
                cache: false,

                success: function (response) {

                    var len= response.length;


                    for(var i=0; i<len;i++){
                        var abv =response[i]['abv'];
                        var name =response[i]['name'];

                        $('#choose_spec').append("<option value='"+abv+"'>"+name+"</option>");

                    }

                },

            });

        });


        $('#search').on('click', function () {

            const spec = $('#choose_spec').find(':selected').val();
            const year = $('#year').find(':selected').text();
            const promo = $('#promo').find(':selected').val();

            $('#pdf_list').empty();
            $('#pdf_list').append('<h3 class="list-group-item">Planurile de invatamant si fisele disciplinelor pentru promotia' + promo + ', specializarea ' + spec + '</h3>');
            $('#pdf_list').append('<h4  class="list-group-item"><i id="downloadAll" class="download icon "></i>Download all</h4>');
            console.log(spec);
            console.log(year);
            console.log(promo);
            const path = "resources/pi/" + promo + "/" + spec;
            let action = 'DISPLAY';

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'action_search.php',
                data: {spec: spec, promo: promo, action: action},
                success: function (response) {

                    for (let i = 0; i < response.length; i++)
                        $('#pdf_list').append('<li class="list-group-item"><a download  href="' + path + '/' + response[i] + '"><i class="download icon"></i></a> <a  target="_blank" href="' + path + '/' + response[i] + '">' + response[i] + '</a></li>');
                    console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }

            })

            $('#downloadAll').click(function () {

                let action = 'DOWNLOAD';
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'action_search.php',
                    data: {spec: spec, year: year, promo: promo, action: action},
                    success: function (response) {
                        window.location = response;
                        $.ajax({
                            type:"POST",
                            dataType:'json',
                            url:'action_search.php',
                            data:{fileName: response}

                        })
                       // $('h4').append('<a download  href="' +response +' ">asd</a>');
                    },
                    error: function (response) {
                        window.location = response;
                        // console.log(response);

                    }

                })
            });


        })


    })
</script>