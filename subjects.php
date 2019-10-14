<?php
session_start();
unset($_SESSION['subject']);
unset($_SESSION['gameQuashtion']);
unset($_SESSION['Answers']);
include_once 'DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser'])) {
    $db->Redirect("login.php");
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>נושאים לבחירה</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Unicat project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="styles/about.css">
        <link rel="stylesheet" type="text/css" href="styles/about_responsive.css">
        <style>
            p{
                color: white;
                text-align: right;
            }

        </style>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138749872-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-138749872-1');
        </script>
    </head>
    <body>

        <div class="super_container">

            <!-- Header -->

            <header class="header">

                <?php include_once './navbar.php'; ?>


                <div  class="courses">
                    <div  class="section_background parallax-window" data-parallax="scroll" data-image-src="templateImages//courses_background.jpg" data-speed="0.8"></div>
                    <br><br><br><br><br>
                    <div  class="container">
                        <div class="row">
                            <div class="col">

                                <div class="col-sm-8 text-left "dir="rtl"> 
                                    <center>
                                        <h1>בחירת נושא</h1>
                                        <table class="table table-striped" >
                                            <thead>
                                                <tr>

                                                    <th scope="col" >שם נושא</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = $db->GetAllSubjectQuestions();
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        $Questions = $db->GetQuestionsBySubjectQuestionsId($row['idSubjectQuestion']);
                                                        if ($Questions->num_rows > 0) {
                                                            ?>
                                                            <td><a href="Quashtions.php?subject=<?php echo $row['idSubjectQuestion']; ?>"><?php echo $row['Subject_name'] ?></a></td>
                                                        <?php } ?>

                                                    </tr>
                                                <?php }
                                                ?>


                                            </tbody>
                                        </table> 
                                    </center>
                                </div>
                            </div>
                        </div>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>><br><br><br><br><br><br>><br><br>
                    </div>


                </div>

                <!-- Partners -->

                <div class="partners">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="partners_slider_container">
                                    <div class="owl-carousel owl-theme partners_slider">

                                        <!-- Partner Item -->
                                        <div class="owl-item partner_item"><img src="templateImages/partner_1.png" alt=""></div>

                                        <!-- Partner Item -->
                                        <div class="owl-item partner_item"><img src="templateImages/partner_2.png" alt=""></div>

                                        <!-- Partner Item -->
                                        <div class="owl-item partner_item"><img src="templateImages/partner_3.png" alt=""></div>

                                        <!-- Partner Item -->
                                        <div class="owl-item partner_item"><img src="templateImages/partner_4.png" alt=""></div>

                                        <!-- Partner Item -->
                                        <div class="owl-item partner_item"><img src="templateImages/partner_5.png" alt=""></div>

                                        <!-- Partner Item -->
                                        <div class="owl-item partner_item"><img src="templateImages/partner_6.png" alt=""></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



        </div>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="styles/bootstrap4/popper.js"></script>
        <script src="styles/bootstrap4/bootstrap.min.js"></script>
        <script src="plugins/greensock/TweenMax.min.js"></script>
        <script src="plugins/greensock/TimelineMax.min.js"></script>
        <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
        <script src="plugins/greensock/animation.gsap.min.js"></script>
        <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
        <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
        <script src="plugins/easing/easing.js"></script>
        <script src="plugins/parallax-js-master/parallax.min.js"></script>
        <script src="plugins/colorbox/jquery.colorbox-min.js"></script>
        <script src="js/about.js"></script>
    </body>
</html>