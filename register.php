<?php
$notShowUserType = array(1, 3);
include_once './DB/dbconnect.php';
$db = new dbconnect();
$error = "";
if (isset($_POST['register'])) {
    if ($db->IsUserExist($_POST['email'])) {
        $error .= "אימייל קיים<br>";
    }
    $phone = str_replace("-", "", $_POST['phone']);
    if (!is_numeric($phone)) {
        $error .= "מספר טלפון לא חוקי<br>";
    }
    if ($_POST['idcity'] == 0) {
        $error = "לא נבחרה עיר<br>";
    }
    if (empty($error)) {
        $result = $db->InsertUser($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['idcity'], $phone, $_POST['birthdate'], $_POST['iduserType']);
        if ($result < 1) {
            $error = "משתמש לא התווסף";
        } else {
            session_start();
            $_SESSION['iduser'] = $result;
            $_SESSION['fullname'] = $_POST['firstname'] . ' ' . $_POST['lastname'];
            $_SESSION['iduserType'] = $_POST['iduserType'];
            $db->Redirect("login.php");
            $error = "משתמש  התווסף";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>הרשמה</title>
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
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="counter_content">
                                <center> <h2 class="counter_title" style="font-family: 'Heebo', sans-serif;">הרשם עכשיו</h2></center>

                                <!-- Milestones -->

                                <div class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">



                                    <!-- Milestone -->
                                    <div class="milestone">
                                        <div class="milestone_counter" data-end-value="18" data-sign-after="+">0</div>
                                        <div class="milestone_text">נושאי תרגול</div>
                                    </div>

                                    <!-- Milestone -->
                                    <div class="milestone">
                                        <div class="milestone_counter" data-end-value="670" data-sign-after="+">0</div>
                                        <div class="milestone_text">שאלות</div>
                                    </div>

                                    <!-- Milestone -->
                                    <div class="milestone">
                                        <div class="milestone_counter" data-end-value="300" data-sign-after="+">0</div>
                                        <div class="milestone_text">מבחנים שבוצעו</div>
                                    </div>

                                    <!-- Milestone -->
                                    <div class="milestone">
                                        <div class="milestone_counter" data-end-value="1200" data-sign-after="+">0</div>
                                        <div class="milestone_text">חברים</div>
                                    </div>

                                    <!-- Milestone -->
                                    <div class="milestone">
                                        <div class="milestone_counter" data-end-value="500" data-sign-after="+">0</div>
                                        <div class="milestone_text">שיתופים</div>
                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="counter_form">
                        <div class="row fill_height">
                            <div class="col fill_height">
                                <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" action="register.php" method="POST">

                                    <input type="email" class="counter_input" placeholder="Email:" name="email" value="<?php
if (isset($_POST['email'])) {
    echo $_POST['email'];
}
?>" required="required">
                                    <input type="password" class="counter_input" placeholder="סיסמא:" name="password" value="<?php
                                    if (isset($_POST['password'])) {
                                        echo $_POST['password'];
                                    }
?>" required="required">
                                    <input dir="rtl" type="text" class="counter_input" placeholder="שם פרטי:" name="firstname" value="<?php
                                    if (isset($_POST['firstname'])) {
                                        echo $_POST['firstname'];
                                    }
?>" required="required">
                                    <input dir="rtl" type="text" class="counter_input" placeholder="שם משפחה:" name="lastname" value="<?php
                                    if (isset($_POST['lastname'])) {
                                        echo $_POST['lastname'];
                                    }
?>" required="required">

                                    <select name="idcity" id="counter_select" class="counter_input counter_options" dir="rtl">
                                        <option <?php if (isset($_POST['idcity']) && $row['idcity'] == $_POST['idcity']) { ?> selected <?php } ?>  value="0">בחר עיר</option>

                                        <?php
                                        $cities = $db->GetAllCities();
                                        if ($cities->num_rows > 0) {
                                            while ($row = $cities->fetch_assoc()) {
                                                ?>
                                                <option <?php if (isset($_POST['idcity']) && $row['idcity'] == $_POST['idcity']) { ?> selected <?php } ?>  value="<?php echo $row['idcity'] ?>"><?php echo $row['city_name'] ?></option>

                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="0" disabled="">אין ערים</option>
                                        <?php } ?>
                                    </select>
                                    <input dir="rtl" type="text" class="counter_input" placeholder="טלפון:" name="phone" value="<?php
                                        if (isset($_POST['phone'])) {
                                            echo $_POST['phone'];
                                        }
                                        ?>" required="required">
                                    <input type="date" class="counter_input" placeholder="תאריך לידה:" name="birthdate" required="required" dir="rtl">
                                    <select name="iduserType" id="counter_select" class="counter_input counter_options" dir="rtl">
                                        <?php
                                        $usertypes = $db->GetAlluserTypes();
                                        if ($usertypes->num_rows > 0) {
                                            while ($row = $usertypes->fetch_assoc()) {
                                                if (!in_array($row['iduserType'], $notShowUserType)) {
                                                    ?>
                                                    <option <?php if (isset($_POST['iduserType']) && $row['iduserType'] == $_POST['iduserType']) { ?> selected <?php } ?>  value="<?php echo $row['iduserType'] ?>"><?php echo $row['userType_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <option value="0" disabled="">אין סוגי משתמש</option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?php
                                    if (!empty($error)) {
                                        ?>
                                        <label style="color: red"><?php echo $error; ?></label><br>

                                    <?php } ?>
                                    <button type="submit" name="register" class="counter_form_button">הרשם</button>
                                </form>
                            </div>
                        </div>
                    </div>

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