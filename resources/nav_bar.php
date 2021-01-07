<?php
/**
 * Created by PhpStorm.
 * User: Diana
 * Date: 1/12/2020
 * Time: 5:11 PM
 */
include 'php\DbConnection.php';
include 'php\validate_user.php';

$dbCon = new DbConnection();
$specializations_L = mysqli_query($dbCon->getCon(), "SELECT * FROM specializari WHERE ((SELECT id_ciclu_studii FROM domenii WHERE id=id_domeniu)=(SELECT id from ciclu_studii WHERE denumire='Licenta' )) ");
$specializations_M = mysqli_query($dbCon->getCon(), "SELECT * FROM specializari WHERE ((SELECT id_ciclu_studii FROM domenii WHERE id=id_domeniu)=(SELECT id from ciclu_studii WHERE denumire='Master' ))");
$domains = mysqli_query($dbCon->getCon(), "SELECT denumire FROM domenii ");
?>

<div class="container ">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">


        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
            <?php if(($_SESSION['user_role']==1)||($_SESSION['user_role']==0)) { echo '
                <li class="nav-item " ><a class="nav-link" href="home.php">Acasa </a></li>

                <li  class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Discipline </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="adaugare_disciplina.php">Adaugare disciplineee</a>
                        <li><a class="dropdown-item"> Licenta &raquo </a>
                            <ul class="submenu dropdown-menu">'?>
                                <?php foreach ($specializations_L as $specialization_name){ ?>
                                <li>
                                    <p class="dropdown-item specs" name="spec" id=<?php echo $specialization_name['id'] ?> >
                                        <?php

                                        echo $specialization_name['denumire'];
                                        } ?>
                                    <?php echo'</p>
                                </li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"> Master &raquo </a>
                            <ul class="submenu dropdown-menu">
                                <?php foreach ($specializations_M as $specialization_name){ ?>
                                <li>
                                    <p class="dropdown-item specs" name="spec" id=';?><?php echo $specialization_name['id'] ?><?php echo' >'?>
                                        <?php

                                        echo $specialization_name['denumire'];
                                         ?>
                                 <?php echo' </p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a  class="nav-link" href="plan_invatamant.php">Plan de invatamant </a></li>';}?>
                <li class="nav-item"><a class="nav-link" href="fisa_disciplinei.php">Fisa disciplinei </a></li>
               <?php if(($_SESSION['user_role']==1)||($_SESSION['user_role']==0)) {
                   echo'<li  class="nav-item"><a class="nav-link" href="domenii_spec.php">Domenii/Specializari </a></li> ';}
              if(($_SESSION['user_role']==0)){echo '<li class="nav-item"><a class="nav-link" href="utilizatori.php">Utilizatori </a></li>';}
               if(($_SESSION['user_role']==1)||($_SESSION['user_role']==0)) { echo'<li class="nav-item"><a  class="nav-link" href="Search.php">Cautare pdf</a></li>';}?></ul>
               <ul class="navbar-nav ml-auto">  <li   class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Contul meu </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="parola.php"> Schimbare parola </a>

                        </li>
                        <li><a class="dropdown-item" href ="LogOut.php">Log Out </a></li>
                    </ul>
                </li>
               </ul>

                <input type="text" hidden value="" id="specialization">




        </div> <!-- navbar-collapse.// -->

    </nav>
</div><!-- container //  -->
<script>
    $(document).ready(function () {
        $('p[name="spec"]').click(function (e) {
            e.preventDefault();
            var spec = $(this).attr("id");
            document.location = "disciplines.php?specialization=" + spec;

        })






    });
</script>
