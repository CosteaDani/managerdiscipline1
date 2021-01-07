<?php
/**
 * Created by PhpStorm.
 * User: Diana
 * Date: 1/22/2020
 * Time: 10:10 PM
 */

include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$id_disc = $_GET['id_disc'];

//$fisa_disc = mysqli_query($dbCon->getCon(), "SELECT * FROM fisediscipline WHERE id_disciplina = '$id_disc'");
//$fisa_disc = $fisa_disc->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="resources\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">
    <link rel="stylesheet" type="text/css" href="resources\css\fisa_disc.css">
    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">
    <link rel="stylesheet" type="text/css" href="resources\css\semantic.min.css">

    <script src="resources\js\jquery-3.4.1.min.js"></script>
    <script src="resources\js\bootstrap.min.js"></script>
    <script src="resources\js\menu.js"></script>
    <script src="resources\js\semantic.min.js"></script>
    <script src="resources\js\myjs.js"></script>


</head>
<body>

<div id="nav-bar"></div>
<br><br>
<input id="disc_id" value="<?php echo $id_disc; ?>" hidden>

<!--<input type="text" id="id_fisa_disc" hidden value="--><?php //echo $fisa_disc['id']?><!--">-->
<!--<input type="text" id="id_disc" value="--><?php //echo $fisa_disc['id_disciplina']?><!-- " hidden>-->
<!--<div class="container" id="fisa_disc">--><?php //echo $fisa_disc['content']?><!--</div>-->

<br><br>

<div class="container">

    <ul class="nav nav-tabs" style="font-size: 15px">
        <!--            <li  class="nav-item  " ><a  class="nav-link active " data-toggle="tab" href="#home">Home</a></li>-->
        <!--            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a></li>-->
        <!--            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a></li>-->
        <!--            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu3">Menu 3</a></li>-->
    </ul>

    <div class="tab-content" id="content">

    </div>
</div>


</body>
</html>
<script>


    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    $(document).ready(function () {


        // $( "textarea" ).each(function( index ) {
        //     $(this).show();
        //     $(this).focus();
        //     $(this).append("asdqwe");
        //     var input_parent = $(this).parent();
        //     input_parent.append($(this).val());
        //     $(this).contents().filter(function() {
        //         return this.nodeType === 3;
        //     }).remove();
        //     $(this).hide();
        //     console.log( index + ": " + $( this ).text() );
        // });
        $(function () {
            $("#nav-bar").load("resources\\nav_bar.php");
        });


        var id_disc = $('#disc_id').val();
        $.post("get_disc_files.php", {id_disc: id_disc}, function (result) {

            var len = result.length;
            console.log(result);


            for (var i = 0; i < len; i++) {
                $('.nav-tabs').append('<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#fisa' + result[i]['id_disc'] + '">' + result[i]['spec_name'] + '</a></li>')
                $('.tab-content').append('<div data-id=' + result[i]['id_disc'] + ' id="fisa' + result[i]['id_disc'] + '" class="tab-pane fade in active"><div class="container" >' + result[i]['content'] + '' +
                    ' </div><button type="submit" class="btn btn-primary col-md-2" style="margin-left: 45%" name="save_disc">Salvare</button> ' +
                    '<button  type="submit" class="btn btn-primary col-md-2" style="margin-left: 45%" id="export_pdf" name="export_pdf">Export PDF</button></div>');


            }

            $('.nav-tabs').find('li:first').children('a').addClass("active");
            $('.tab-pane:first').addClass('show');
        }, "json");


////////////////////////////////////////////////////
        $(document).on('click', '.input_td', function (e) {

            e.preventDefault();
            var input = $(this).find("textarea");
            input.show();
            input.focus();

        });
        $(document).on('focus', '.input_element', function (e) {
            e.preventDefault();
            var input_parent = $(this).siblings('pre').find('span');
            var text = input_parent.text();
            // text = text.replace( '<br>','\n');
            if (input_parent.text() != "") {
                $(this).val(text);
            }
            input_parent.contents().filter(function () {
                return this.nodeType === 3;
            }).remove();
        });
        $(document).on('focusout', '.input_element', function (e) {
            e.preventDefault();
            var input_parent = $(this).siblings('pre').find('span');
            var text = $(this).val();
            // text = text.replace(/(?:\r\n|\r|\n)/g, '<br>');
            input_parent.append(text);
            $(this).val("");
            $(this).hide();

        });


        $(document).on('change', '.td_select', function (event) {

            console.log($(event.currentTarget).val());
            $(event.currentTarget).prev().css('display', 'block');
            $(event.currentTarget).prev().html($(event.currentTarget).val());

            $(event.currentTarget).css('display', 'none');


        })

        $(document).on('click', '.comp', function (event) {

            $(event.currentTarget).css('display', 'none');
            $(event.currentTarget).next().css('display', 'block');


        })


        $(document).on('click', 'button[name="save_disc"]', function (e) {
            var htmlContent = $(e.currentTarget).siblings('.container').html();
            var id_disc = $(e.currentTarget).parent().data('id');


            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save_fisa_disc.php',
                data: {"htmlContent": htmlContent, "id_disc": id_disc, "edit": 1},
                dataType: 'html',
                cache: false,
                success: function (result) {
                    // console.log(result);
                    window.location.replace(result);

                },
            });
        });

        $('#content').change(function (e) {
            e.preventDefault();
            $('#export_pdf').prop('disabled', true);
            $('#export_pdf').attr('title', "Salvati fisa disciplinei inainte de a creea fisierul pdf");
        })


        $(document).on('click', 'button[name="export_pdf"]', function (e) {
            var spans = $('span');
            for (let i = 0; i < spans.length; i++) {

                let text = spans[i].innerText;
                text = text.replace('<br>', '\n');

                spans[i].innerText = text;

            }
            var pre_array = $('pre');
            for (let i = 0; i < pre_array.length; i++) {
                cont = pre_array[i].firstChild;
                pre_array[i].replaceWith(cont);
            }

            $('.td_select').remove();

            var htmlContent = $(e.currentTarget).siblings('.container').html();
            var id_disc = $(e.currentTarget).parent().data('id');
            var id_promotion = getUrlParameter('id_promo');

            e.preventDefault();
            $.ajax({

                type: 'POST',
                url: 'create_pdf.php',
                data: {"htmlContent": htmlContent, "id_disc": id_disc, "id_promo" : id_promotion},
                dataType: 'html',
                cache: false,
                success: function (result) {
                    console.log(result);
                    location.reload();
                    window.open(result);
                },
            });
        });
    });
</script>
