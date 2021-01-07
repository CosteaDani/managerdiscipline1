<?php
/**
 * Created by PhpStorm.
 * User: Dumit
 * Date: 1/12/2020
 * Time: 5:11 PM
 */
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
$dbCon = new DbConnection();
$specializations = mysqli_query($dbCon->getCon(), "SELECT denumire as denumire,id as id FROM specializari ");
$promotions = mysqli_query($dbCon->getCon(), "SELECT * FROM promotii ");
$disciplines = mysqli_query($dbCon->getCon(), "SELECT denumire as denumire,id as id FROM discipline ");
$programstudies = mysqli_query($dbCon->getCon(), "SELECT * FROM ciclu_studii ");

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="resources\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources\css\nav_bar.css">
    <link rel="stylesheet" type="text/css" href="resources\css\fisa_disc.css">
    <link rel="stylesheet" type="text/css" href="resources\css\dropdown.css">
    <link rel="stylesheet" type="text/css" href="resources\css\semantic.min.css">
    <link rel="stylesheet" type="text/css" href="resources\css\icon.css">


    <script src="resources\js\jquery-3.4.1.min.js"></script>
    <script src="resources\js\bootstrap.min.js"></script>
    <script src="resources\js\menu.js"></script>
    <script src="resources\js\semantic.min.js"></script>
    <script src="resources\js\discipline_file_functions.js"></script>
    <script>
        $(function () {
            $("#nav-bar").load("resources\\nav_bar.php");
        });
    </script>

    <style>

    </style>
</head>
<body>

<div id="nav-bar"></div>


<div class="container">
    <div id="nav-bar"></div>
    <br><br><br>
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post">
                <h3>Creare fisa disciplina</h3>
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="promotii">Promotii</label>
                        <select id="promo" required name="promotion" class="form-control">
                            <option selected>Alegeti promotia</option>
                            <?php foreach ($promotions

                            as $prom_name){ ?>
                            <option value="<?php echo $prom_name['id'] ?>"
                                    name="prom_name"> <?php echo $prom_name['inceput'] . "-" . $prom_name['sfarsit'];
                                } ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div id="search_box" class="form-group  col-md-8">
                        <label>Disciplina:</label>
                        <input required id="disc" class="form-control" type="text" autocomplete="off"
                               placeholder="Cautare disciplina"/>
                        <ul class="list-group" id="result"></ul>

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="specializari">Specializare</label>
                        <input required id="spec" class="form-control" disabled>
                        <div id="checkboxes">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary col-md-2 mr-5" id="create_btn">Creare</button>
            </form>
        </div>

        <div class="col-md-6">
            <form action="" method="get">
                <h3>Incarcare fisa disciplina</h3>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="promotii">Promotii</label>
                        <select id="prom" name="prom" class="form-control">
                            <option selected>Alegeti promotia</option>
                            <?php foreach ($promotions

                            as $prom_name){ ?>
                            <option value="<?php echo $prom_name['id'] ?>"
                                    name="upload_prom_name"> <?php echo $prom_name['inceput'] . "-" . $prom_name['sfarsit'];
                                } ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3 form-group mr-5">
                        <label for="promotii_upload">Ciclu de studii</label>
                        <select id="progstudii_upload" name="progstudii_upload" class="form-control">
                            <option disabled selected></option>
                            <?php foreach ($programstudies

                            as $progstudies_name){ ?>
                            <option name="progstudii_name_upload"
                                    value="<?php echo $progstudies_name['id'] ?>"><?php echo $progstudies_name['denumire'];
                                } ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="specializari">Specializare</label>
                        <select id="spec_upload" name="spec" class="form-control">
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group  col-md-8">
                        <label>Disciplina</label>
                        <select id="choose_disc" name="id_disc" class="form-control">

                        </select>
                    </div>
                </div>


                <input class="ml-5 " type="file" id="upload" name="file">
                <input class=" btn btn-primary" id="upload_btn" type="submit">
            </form>
        </div>
    </div>


    <form action="">
        <h3 class="mt-5">Editare fisa disciplina</h3>

        <div class="form-row ">
            <div class="form-group col-md-4">
                <label for="promotii">Promotii</label>
                <select id="prom_edit" name="prom" class="form-control">
                    <option selected>Alegeti promotia</option>
                    <?php foreach ($promotions

                    as $prom_name){ ?>
                    <option value="<?php echo $prom_name['id'] ?>"
                            name="edit_prom_name"> <?php echo $prom_name['inceput'] . "-" . $prom_name['sfarsit'];
                        } ?></option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3 form-group mr-5">
                <label for="promotii_edit">Ciclu de studii</label>
                <select id="progstudii_edit" name="progstudii_edit" class="form-control">
                    <option disabled selected></option>
                    <?php foreach ($programstudies

                    as $progstudies_name){ ?>
                    <option name="progstudii_name_edit"
                            value="<?php echo $progstudies_name['id'] ?>"><?php echo $progstudies_name['denumire'];
                        } ?></option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="specializari">Specializare</label>
                <select id="spec_edit" name="spec" class="form-control">

                </select>
            </div>
        </div>

        <div class="form-group row col-md-4">
            <label>Disciplina</label>
            <select id="choose_disc_edit" name="id_disc" class="form-control">

            </select>
        </div>

        <button type="submit" class="btn btn-primary col-md-1" id="edit_btn">Editare</button>
    </form>
</div>
<br><br>
<?php if(($_SESSION['user_role']==1)||($_SESSION['user_role']==0)){?>
<div class="container">
    <form action="post">
        <h3 class="mt-5">Afisare discipline</h3>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="promotii">Promotii</label>
                <select id="promotion_search" name="prom" class="form-control">
                    <option selected>Choose...</option>
                    <?php foreach ($promotions

                    as $prom_name){ ?>
                    <option value="<?php echo $prom_name['id'] ?>"
                            name="edit_prom_name"> <?php echo $prom_name['inceput'] . "-" . $prom_name['sfarsit'];
                        } ?></option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="promotii_edit">Ciclu de studii</label>
                <select id="progstudii_search" name="progstudii_search" class="form-control">
                    <option disabled selected></option>
                    <?php foreach ($programstudies

                    as $progstudies_name){ ?>
                    <option name="progstudii_name_search"
                            value="<?php echo $progstudies_name['id'] ?>"><?php echo $progstudies_name['denumire'];
                        } ?></option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="specializari">Specializare</label>
                <select id="specialization_search" name="spec" class="form-control">
                    <option selected>Choose...</option>

                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-md-1" id="search_btn" style="margin-left: 45%">Cautare</button>
    </form>
    <br>
    <table class="table" id="disciplines_table">
        <thead>
        <tr>
            <th scope="col">Cod</th>
            <th scope="col">Denumire</th>
            <th scope="col">Fisa Disciplina</th>
            <th scope="col">Actiune</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div><?php }?>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#progstudii_upload').change(function (event) {
            let progstudies_id = $("option[name='progstudii_name_upload']:selected").val();
            $('#spec_upload').empty();
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'dropdown_file.php',
                data: {progstudies_id: progstudies_id},
                dataType: 'json',
                cache: false,

                success: function (response) {
                    var len = response.length;
                    $('#spec_upload').append("<option>Alegeti o specializare</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['name'];

                        $('#spec_upload').append("<option value='" + id + "'>" + name + "</option>");

                    }
                },
            });
        });

        $('#progstudii_edit').change(function (event) {
            let progstudies_id = $("option[name='progstudii_name_edit']:selected").val();
            $('#spec_edit').empty();
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'dropdown_file.php',
                data: {progstudies_id: progstudies_id},
                dataType: 'json',
                cache: false,

                success: function (response) {
                    $('#spec_edit').append("<option selected>Alegeti o specializare</option>")
                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['name'];

                        $('#spec_edit').append("<option value='" + id + "'>" + name + "</option>");
                    }
                },
            });
        });
        //Search discipline
        $('#disc').on("keyup input", function () {
            var searchKeyword = $(this).val();

            var id_promotion = $('select[name="promotion"]').find('option:selected').val();

            if (searchKeyword.length == 0) {
                $('#disc').val('');
            }

            if (searchKeyword.length >= 1) {
                $.post('search_disc.php', {keywords: searchKeyword, id_promotion: id_promotion}, function (data) {
                    $('#result').empty();
                    var len = data.length;
                    for (var i = 0; i < len; i++) {
                        var name = data[i]['name'];
                        $('#result').append("<li  class='list-group-item list-group-item-action '>" + name + "</li>");
                    }
                }, "json");
            } else {
                $('#result').empty();
            }
        });

        $('#result').on('click', '.list-group-item', function (event) {

            $('#result').empty();
            var name = $(event.currentTarget).text();

            $('#checkboxes').empty();
            $('#disc').val(name);

            if ($('#disc').val() != '') {
                var disc_name = $('#disc').val();
                var id_promotion = $('select[name="promotion"]').find('option:selected').val();



                $.post('disc_file_choose_spec.php', {
                    disc_name: disc_name,
                    id_promotion: id_promotion
                }, function (data) {
                    var len = data.length;


                    for (var i = 0; i < len; i++) {

                        var name = data[i]['name'];
                        var id = data[i]['id'];
                        $('#checkboxes').append('<div class="form-check"><label for="checkbox' + i + '" class="form-check-label "> <input  class="form-check-input" id=checkbox' + i + ' type="checkbox" value=' + id + ' >' + name + '</label></div>')
                    }
                }, "json");

                $('#checkboxes').append('<p>Selectati specializarile</p>');
            } else {
                ($('p').remove());
            }
        })

        $(document).on("change", "input[type='checkbox']", function (event) {
                var id_spec = $(event.currentTarget).val();
                var name_spec = $(event.currentTarget).parent().text();
                console.log(id_spec);
                console.log(name_spec);
                var name_array = [];
                $("input:checkbox[type=checkbox]:checked").each(function () {
                    name_array.push($(this).parent().text());
                });
                $('#spec').val(name_array);

                var id_array = [];
                $("input:checkbox[type=checkbox]:checked").each(function () {
                    id_array.push($(this).val());
                });
                $('#spec').data('id', id_array);
                console.log($('#spec').data('id'));
            }
        )

        //  Upload - dropdown discipline
        $('#spec_upload').change(function (event) {

            let spec_id = $('#spec_upload').find("option:selected").val();
            let prom_id = $("option[name='upload_prom_name']:selected").val();
            console.log(spec_id);
            var action = 'CREATE';
            $('#choose_disc').empty();

            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'dropdown_disc.php',
                data: {spec_id: spec_id, prom_id: prom_id, action: action},
                dataType: 'json',
                success: function (response) {
                    var len = response.length;
                    $('#choose_disc').append("<option name='disc_name'>Alegeti o disciplina</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['name'];
                        $('#choose_disc').append("<option name='disc_name' value='" + id + "'>" + name + "</option>");

                    }
                },
            });
        });

// edit - dropdown discipline

        $('#spec_edit').change(function () {

            let prom_id = $("option[name='edit_prom_name']:selected").val();
            let spec_id = $('#spec_edit').find("option:selected").val();
            console.log(prom_id);
            console.log(spec_id);
            var action = 'EDIT';
            console.log(action);
            $('#choose_disc_edit').empty();

            $.ajax({
                type: 'POST',
                url: 'dropdown_disc.php',
                data: {spec_id: spec_id, action: action, prom_id: prom_id},
                dataType: 'json',
                success: function (response) {

                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['name'];
                        $('#choose_disc_edit').append("<option name='disc_name_edit' value='" + id + "'>" + name + "</option>");
                    }
                }
            })

        })
//UPLOAD
        $('#upload').change(function () {
            $('#create_btn').attr('disabled', 'disabled');
        })
        $('#upload_btn').on('click', function (e) {
            e.preventDefault();
            var file_data = $('#upload').prop('files')[0];
            console.log(file_data);
            let disc_id = $("option[name='disc_name']:selected").val();
            if (file_data != undefined) {
                var form_data = new FormData();
                form_data.append('id', disc_id);
                form_data.append('file', file_data);
                $.ajax({
                    type: 'POST',
                    url: 'upload_disc_file.php',
                    contentType: false,
                    data: form_data,
                    processData: false,
                    success: function (response) {
                        alert(response);
                        $('#upload').val('');
                    }
                })
            } else {
                alert('Incarcati un fisier pdf!')
            }
        });
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        $('#edit_btn').click(function (e) {
            e.preventDefault();

            var id = $('#choose_disc_edit').children(":selected").val();
            var url = 'edit_disc_file.php' + "?id_disc=" + id + "&edit=1";
            document.location = url;
        })
        $('#create_btn').click(function (e) {
            e.preventDefault();
            var id_promo = $('#promo').find('option:selected').val();
            var id_spec = $('#spec').data('id');
            var disc = $('#disc').val();

            $.ajax({
                type: 'POST',
                url: 'get_id_disc.php',
                data: {disc: disc, id_promo: id_promo, id_spec: id_spec},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    var id_disc = [];
                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        id_disc.push(id);
                    }
                    var url = 'create_disc_file.php' + "?id_disc=" + id_disc + "&id_spec=" + id_spec + "&id_promo=" + id_promo;
                    document.location = url;
                }
            });
        })


        $('#progstudii_search').change(function (event) {
            let progstudies_id = $("option[name='progstudii_name_search']:selected").val();
            $('#specialization_search').empty();
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'dropdown_file.php',
                data: {progstudies_id: progstudies_id},
                dataType: 'json',
                cache: false,

                success: function (response) {
                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['name'];

                        $('#specialization_search').append("<option value='" + id + "'>" + name + "</option>");
                    }
                },
            });
        });

        $('#search_btn').click(function (e) {
            e.preventDefault();
            var id_prom = $('#promotion_search').find('option:selected').val();
            var id_spec = $('#specialization_search').find('option:selected').val();
            var discipline_file_exists;
            $('#disciplines_table ').find('tbody').empty();
            console.log();
            $.ajax({
                type: 'POST',
                url: 'dropdown_disc.php',
                dataType: 'json',
                data: {prom_id: id_prom, spec_id: id_spec, action: 'SEARCH'},
                success: function (response) {
                    console.log(response);

                    var len = response.length;
                    for (var i = 0; i < len; i++) {

                        if (response[i]['discipline_file'] == 0) {
                            discipline_file_exists = "<i class='times circle icon big' style='color: red'></i>"
                        } else {
                            discipline_file_exists = "<i class='check circle icon big' style='color: green'></i>"
                        }
                        $('#disciplines_table').append("<tr><td>" + response[i]['cod'] + " </td><td>" + response[i]['name'] + " </td><td>" + discipline_file_exists + " </td><td><button class='btn btn-danger btn_delete' data-id_disc='"+response[i]['id']+"'>Stergere</button></td></tr>");
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        })

        $(document).on('click' ,'.btn_delete',function (e) {
            // e.preventDefault();
            var id_prom = $('#promotion_search').find('option:selected').val();
            var id_spec = $('#specialization_search').find('option:selected').val();
            var id_disc = $(e.currentTarget).data('id_disc');
            $.ajax({
                type: 'POST',
                url: 'dropdown_disc.php',
                dataType: 'json',
                data: {prom_id: id_prom, spec_id: id_spec, action: 'DELETE',id_disc: id_disc},
                success: function (response) {
                    alert(response);

                },
                error: function (response) {
                    console.log(response);
                }
            });
        })

    })
</script>
