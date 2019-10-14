<?php
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduserType'])) {
    $db->Redirect("login.php");
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>שאלות</title>
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
        <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
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


                <!-- Header Content -->
                <div class="header_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                    <div class="logo_container">
                                        <a href="./index.php">
                                            <div class="logo_text"><img src="templateImages/logo.png"></div>
                                        </a>
                                    </div>
                                    <nav class="main_nav_contaner ml-auto">
                                        <ul class="main_nav">
                                            <li ><a href="subjects.php">בית</a></li>

                                            <li><a href="login.php"> התנתק</a></li>
                                        </ul>


                                        <!-- Hamburger -->


                                        <div class="hamburger menu_mm">
                                            <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                                        </div>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </header>

            <!-- Menu -->

            <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
                <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
                <nav class="menu_nav">
                    <ul class="menu_mm">
                        <li class="menu_mm"><a href="subjects.php">בית</a></li>
                        <?php
                        $corret = 0;
                        $wrong = 0;
                        for ($index = 0; $index < sizeof($_SESSION['gameQuashtion']); $index++) {

                            if (isset($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]])) {
                                if ($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]]) {
                                    $corret++;
                                } else {
                                    $wrong++;
                                }
                            }
                        }
                        ?>
                        <li><a href = "login.php"> התנתק</a></li>
                    </ul>

                </nav>
            </div>



            <div class = "courses">
                <div class = "section_background parallax-window" data-parallax = "scroll" data-image-src = "templateImages//courses_background.jpg" data-speed = "0.8"></div>
                <br><br><br><br><br>
                <div class = "container">
                    <div class = "row">
                        <div class = "col">

                            <div class = "col-sm-7 text-left "dir = "rtl">
                                <h3 style = "font-family: 'Heebo', sans-serif;"><?php echo $corret
                        ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> נכונות</h3>
                                <h3 style="font-family: 'Heebo', sans-serif;"><?php echo $wrong ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> שגויות</h3>

                                <p style="font-size: 40px;font-family: 'Heebo', sans-serif;color: black;">ציון:<?php echo round(100 / sizeof($_SESSION['Answers']) * $corret); ?></p>
                                <a style="float: right" href="subjects.php">חזרה לרשימת נושאים</a>




                            </div>
                        </div>
                    </div>
                    <br><br><br>
                </div>
                <?php unset($_SESSION['subject']);
                unset($_SESSION['gameQuashtion']);
                unset($_SESSION['Answers']);
                ?>


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