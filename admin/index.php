<?php
session_start();
include_once '../DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 1) {
    $db->Redirect("../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>כניסת אדמין</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Unicat project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
        <link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="../styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="../styles/responsive.css">
    </head>
    <body>

        <div class="super_container">

            <?php include_once './navbar.php'; ?>



            <!-- Popular Courses -->

            <div  class="courses">
                <div  class="section_background parallax-window" data-parallax="scroll" data-image-src="../templateImages//courses_background.jpg" data-speed="0.8"></div>
                <div  class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section_title_container text-center" dir="rtl">
                                <h2 class="section_title">שלום <?php echo $_SESSION['fullname'] ?></h2>                            
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>><br><br><br><br><br><br>><br><br><br><br><br><br><br>
                </div>


            </div>

            <script src="../js/jquery-3.2.1.min.js"></script>
            <script src="../`styles/bootstrap4/popper.js"></script>
            <script src="../`styles/bootstrap4/bootstrap.min.js"></script>
            <script src="../plugins/greensock/TweenMax.min.js"></script>
            <script src="../plugins/greensock/TimelineMax.min.js"></script>
            <script src="../plugins/scrollmagic/ScrollMagic.min.js"></script>
            <script src="../plugins/greensock/animation.gsap.min.js"></script>
            <script src="../plugins/greensock/ScrollToPlugin.min.js"></script>
            <script src="../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
            <script src="../plugins/easing/easing.js"></script>
            <script src="../plugins/parallax-js-master/parallax.min.js"></script>
            <script src="../js/custom.js"></script>
    </body>
</html>
