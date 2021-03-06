<?php
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (isset($_POST['login'])) {
    if ($db->ForgetPaaword($_POST['email'], $_POST['birthdate'])) {
        $result = $db->GetUserDetails($_POST['email']);
        $password = $result['password'];
    } else {
        $error = "אחד או יותר פרטים לא נכונים";
    }
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>כניסה</title>
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
        <!-- Global site tag (gtag.js) - Google Analytics -->
    </head>
    <body>

        <div class="super_container">

            <!-- Header -->

            <header class="header">
                <!-- Top Bar -->
                <div class="top_bar">
                    <div class="top_bar_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">

                                </div>
                            </div>
                        </div>
                    </div>				
                </div>
                <!-- Header Content -->
                <div class="header_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                    <div class="logo_container">
                                        <a href="index.php">
                                            <div class="logo_text"><img src="templateImages/logo.png"></div>
                                        </a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>



            <div class="counter">
                <div class="counter_background" style="background-image:url(templateImages/counter_background.jpg)"></div>
                <div class="container">

                    <br><br><br><br><br><br><br><br>

                    <div class="counter_form">
                        <div class="row fill_height">
                            <div class="col fill_height">

                                <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" action="forgetPassword.php" method="POST" dir="rtl">
                                    <div class="counter_form_title">כניסה</div>
                                    <input type="email" class="counter_input" placeholder="Email:" name="email" value="<?php
                                    if (isset($_POST['email'])) {
                                        echo $_POST['email'];
                                    }
                                    ?>" required="required">
                                    <input type="date" class="counter_input" placeholder="תאריך לידה:" name="birthdate" required="required" dir="rtl">


                                    <?php
                                    if (!empty($error)) {
                                        ?>
                                        <label style="color: red"><?php echo $error; ?></label><br>

                                    <?php } ?>
                                    <button type="submit" name="login" class="counter_form_button">שחזר</button><br>
                                    <?php if (isset($password)) { ?><p style="color: black;font-size: 20px">הסיסמא היא:<?php echo $password ?></p><?php } ?>
                                    <a href="login.php">חזרה</a>

                                </form>






                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
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


            <!-- Footer -->
            <footer class="footer">
                <div class="footer_background" style="background-image:url(templateImages/footer_background.png)"></div>
                <div class="container">
                    <div class="row footer_row">
                        <div class="col">
                            <div class="footer_content">
                                <div class="row">

                                    <div class="col-lg-3 footer_col">

                                        <!-- Footer About -->
                                        <div class="footer_section footer_about">
                                            <div class="footer_logo_container">
                                                <a href="#">
                                                    <div class="footer_logo_text"><img src="templateImages/logo.png"></div>
                                                </a>
                                            </div>

                                            <!--<div class="footer_social">
                                                    <ul>
                                                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    </ul>
                                            </div>-->
                                        </div>

                                    </div>

                                    <div class="col-lg-3 footer_col">

                                        <!-- Footer Contact -->
                                        <div class="footer_section footer_contact">
                                            <div class="footer_title">צור קשר</div>
                                            <div class="footer_contact_info" dir="rtl">
                                                <ul>
                                                    <li>Email: chaim.10wave@gmail.com</li>
                                                    <li style="text-align: right">טלפון:  08-664-4435</li>
                                                    <li style="text-align: right">עמק האלה 250, מודיעין-מכבים-רעות</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>





                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </footer>

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