<?php
session_start();
if (isset($_SESSION['login']) and ($_SESSION['cat'] == "1" or $_SESSION['cat'] == "10")) {
    include('connexion.php');

    $r = "SELECT  date_fin FROM date_fin where type=1 order by id_date DESC";
    $req = mysqli_query($link, $r);
    $dsd = mysqli_fetch_array($req);
    $niv = "";

    if (isset($_POST['submit'])) {

        $_SESSION['code_depart'] = $_POST['depart'];
        
        header('location:liste_candidat.php');
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Welcome - Université des Comores</title>
        <link rel="shortcut icon" href="./assets/img/udc.png">
        <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="./node_modules/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="./assets/css/main.css">
        <link rel="stylesheet" href="./assets/css/css.css">
        <script src="./node_modules/jquery/dist/jquery.min.js"></script>
        <script type="text/javaScript">
            $(document).ready(function(){
                    $('#faculte2').on('change',function(){
                        var code_facult=$(this).val();
                        if(code_facult){
                            $.ajax({
                                type:'POST',
                                url:'ajax1.php',
                                data:'code_facult='+code_facult,
                                
                                success:function(html){
                                	
                                    $('#departement').html(html);
                                    
                                }
                            });
                        }
                        else{
                                $('#departement').html('<option value="">D\'abord la competition</option>');
                                
                        }
                    });

                    $('#departement').on('change',function(){
                        var code_depart= $(this).val();
                        if(code_depart){
                            $.ajax({
                                type:'POST',
                                url:'ajax1.php',
                                data:'code_depart='+code_depart,
                                success:function(html){
                                   
                                }
                            });
                        }
                       
                    });
                })
            </script>
    </head>

    <body>


        <section class="main-wrapper">
            <aside class="left-aside">
                <div class="fontLogo">
                    <div class="img-rd">
                        <img src="./assets/img/udc.png" alt="profile image">
                    </div>
                    <h6 class="m-3 text-center"><strong class="titre"> Université des Comores</strong></h6>
                    <hr>
                </div>
                <nav class="nav-aside">
                    <?php
                    switch ($_SESSION['cat']) {
                        case 1:
                            include('interfaces/superAdminRubrique.php');
                            break;
                        case 2:
                            include('interfaces/administrationRubrique.php');
                            break;
                        case 3:
                            include('interfaces/agtScolariteRubrique.php');
                            break;
                        case 4:
                            include('interfaces/scolariteRubrique.php');
                            break;
                        case 5:
                            include('interfaces/desRubrique.php');
                            break;
                        case 6:
                            include('interfaces/gestionnaireRubrique.php');
                            break;
                        case 7:
                            include('interfaces/agentComptaRubrique.php');
                            break;
                        case 8:
                            include('interfaces/adminRubrique.php');
                            break;
                        case 10:
                            include('interfaces/desvRubrique.php');
                            break;
                    }
                    ?>
                    <li class="bord"><a href="profil.php"><i class="icon-user"></i> &nbsp; <span class="nav-item-text">Changer mon mot de passe</span></a></li>

                    <li><a href="deconnexion.php"><i class="icon-logout"></i> &nbsp; <span class="nav-item-text">Déconnexion</span></a></li>

                    </ul>
                </nav>
            </aside>
            <main class="main-content">
                <h4 align="right"><strong><?php echo $_SESSION['prenom'] . " " . $_SESSION['nom'] ?> </strong></h4>
                <h5 align="right" style="color:#00b185;"> <strong><?php echo  $_SESSION['libelle'] . " "; ?></strong></h5>

                <h5 align="left" style="margin-top:-70px;margin-bottom:120px;margin-left:-60px;"> <?php echo (date('d-m-Y')); ?></h5>
                <h5 align="left" style="margin-top:-100px;margin-bottom:130px;margin-left:-60px;color:#00b185;"> Fin de préinscription : <?php echo $dsd['date_fin']; ?></h5>
                </div>


                <div class="text-center mb-5">
                    <h1 class="soft-title-1">Fait un choix </h1>
                    <hr />
                </div>

                <div class="row">
                    <div class="col-12">
                        <form action="choix_dep_dossier.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <h4 style=""></h4>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputcomp1">Composantes <?php  ?></label>
                                    <select id="faculte2" class="form-control" name="faculte2">
                                        <option value="">---Choisir---</option>
                                        <?php
                                        $pics = mysqli_query($link, "SELECT * FROM faculte ");
                                        while ($dat = mysqli_fetch_array($pics)) { ?>
                                            <option value="<?php echo $dat['code_facult']; ?>"><?php echo utf8_encode($dat['design_facult']); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                               
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-3">
                                    <h4 style=""></h4>
                                </div>
                            <div class="form-group col-md-4">
                                    <label for="inputcomp1">Départements</label>
                                    <select id="departement" class="form-control" name="depart">
                                        <option value="">---Choisir---</option>



                                    </select> <br>
                                    <input type="submit" value="Valider" name="submit" class="btn btn-primary btn-md">

                                </div>

                                
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4"></div>
                                <div class="form-group col-md-8">
                                </div>

                            </div>





                        </form>
                    </div>
                </div>
                <!-- <script src="./node_modules/jquery/dist/jquery.min.js"></script> -->
                <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
                <!--  <script src="./assets/js/app.js"></script>
    <script src="./assets/js/choixdepins.js"></script>
    <script src="./assets/js/choixdep.js"></script>
    <script src="./assets/js/choix_dep_liste.js"></script>
    <script src="./assets/js/choixdeptrans.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/dep_op_cl.js"></script>
    <script src="./assets/js/datatable.js"></script>    
              -->
    </body>

    </html>
<?php } else { ?>
    <h3 align="center" style="font-family:arial;margin-top:20%;">D&eacute;sol&eacute;, vous n'avez pas les privil&eacute;ges d'acc&eacute;der &agrave; cette page!<br> Cliquez<a href="userInterface.php"> ici </a> pour retourner &agrave; la page d accueil ! </h3>
<?php }
