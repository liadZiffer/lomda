<?php
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduserType'])) {
    $db->Redirect("login.php");
}
if (!isset($_SESSION['subject'])) {
    $_SESSION['subject'] = $_GET['subject'];
}
if ($_SESSION['subject'] != $_GET['subject']) {
    unset($_SESSION['subject']);
    $_SESSION['subject'] = $_GET['subject'];
    unset($_SESSION['gameQuashtion']);
}
if (!isset($_SESSION['gameQuashtion'])) {
    $_SESSION['gameQuashtion'] = array();
    $result = $db->GetQuestionsBySubjectQuestionsIdAndQnty($_GET['subject'], 25);
    while ($row = $result->fetch_assoc()) {
        $_SESSION['gameQuashtion'][] = $row['idQuestion'];
    }
    if (!isset($_SESSION['Answers'])) {
        $_SESSION['Answers'] = array();
    }
    $db->Redirect("Quashtions.php?subject=" . $_GET['subject'] . "&Quashtions=" . $_SESSION['gameQuashtion'][0]);
}
$error = "";
if (isset($_POST['submit'])) {
    if (!isset($_POST['answer'])) {
        $error = "לא ניבחרה תשובה";
    }
    if (empty($error)) {
        $Question = $db->GetQuestionById($_GET['Quashtions']);

        if ($_POST['answer'] == $Question['CorrectAnswer']) {
            $_SESSION['Answers'][$_GET['Quashtions']] = TRUE;
        } else {
            $_SESSION['Answers'][$_GET['Quashtions']] = FALSE;
        }
    }
}
if (sizeof($_SESSION['gameQuashtion']) == sizeof($_SESSION['Answers'])) {
    $db->Redirect("score.php");
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
                                            <?php
                                            for ($index = 0; $index < sizeof($_SESSION['gameQuashtion']); $index++) {
                                                ?>
                                                <li><a  
                                                    <?php
                                                    if (isset($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]])) {
                                                        if ($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]]) {
                                                            ?>
                                                                style="color: green"
                                                                <?php
                                                            } else {
                                                                ?>
                                                                style="color: red"
                                                            <?php }
                                                            ?>

                                                        <?php } ?>

                                                        href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][$index] ?>"><?php echo $index + 1 ?></a></li>    
                                                <?php } ?>
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
                            ?>
                            <li><a style="
                                <?php
                                if (isset($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]])) {
                                    if ($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]]) {
                                        $corret++;
                                        ?>
                                           color: green;
                                           <?php
                                       } else {
                                           $wrong++;
                                           ?>
                                           color: red;
                                       <?php }
                                       ?>

                                   <?php } ?>

                                   " href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][$index] ?>"><?php echo $index + 1 ?></a></li>    
                            <?php } ?>
                        <li><a href="login.php"> התנתק</a></li>
                    </ul>

                </nav>
            </div>



            <div  class="courses">
                <div  class="section_background parallax-window" data-parallax="scroll" data-image-src="templateImages//courses_background.jpg" data-speed="0.8"></div>
                <br><br><br><br><br>
                <div  class="container">
                    <div class="row">
                        <div class="col">

                            <div class="col-sm-12 text-left "dir="rtl"> 
                                <h3 style="font-family: 'Heebo', sans-serif;"><?php echo $corret ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> נכונות</h3>
                                <h3 style="font-family: 'Heebo', sans-serif;"><?php echo $wrong ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> שגויות</h3>
                                <center>


                                    <?php
                                    if (isset($_GET['Quashtions'])) {
                                        $Question = $db->GetQuestionById($_GET['Quashtions']);
                                    }

                                    if (!isset($_SESSION['Answers'][$_GET['Quashtions']])) {
                                        ?>
                                        <form action="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_GET['Quashtions'] ?>" method="POST">
                                            <h3 style="font-family: 'Heebo', sans-serif;"><?php echo $Question['Question']; ?></h3><br><?php
                                    if (!empty($Question['QuestionImage'])) {
                                            ?>
                                                <br><img height="200" width="200" alt="photo" src="<?php echo str_replace("../", "", $Question['QuestionImage']); ?>"><br>

                                            <?php }
                                            ?>
                                            <table style="color: black;text-align: right;">
                                                <tr>

                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <?php
                                                $numbers = range(1, 4);
                                                shuffle($numbers);
                                                for ($index1 = 0; $index1 < 4; $index1++) {
                                                    ?>
                                                    <tr>
                                                        <td> <input <?php if (isset($_SESSION['Answers'][$_GET['Quashtions']])) { ?>  disabled <?php } ?> style="height: 15px;width: 15px" type="radio" name="answer" value="<?php echo $numbers[$index1]; ?>"></td>
                                                        <td style="font-size: 20px;font-family: 'Heebo', sans-serif;"><?php echo " " . $Question['Answer' . $numbers[$index1]] ?></td>
                                                        <td><?php
                                            if (!empty($Question['AnswerImage' . $numbers[$index1]])) {
                                                        ?><img src="<?php echo $Question['AnswerImage' . $numbers[$index1]] ?>" height="200" width="200">  <?php } ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td></td>
                                                    <td> <p style="color: red"><?php echo $error ?></p></td>
                                                </tr>
                                            </table>

                                            <br>



                                            <input <?php if (isset($_SESSION['Answers'][$_GET['Quashtions']])) { ?>  disabled<?php } ?> type="submit" name="submit" value="אשר תשובה"> <br>
                                        </form>
                                        <?php
                                    }
                                    if (isset($_SESSION['Answers'][$_GET['Quashtions']])) {
                                        if ($_SESSION['Answers'][$_GET['Quashtions']]) {
                                            ?>
                                            <h2 style="color: green">תשובה נכונה</h2>
                                            <?php
                                        } else {
                                            ?>
                                            <h2 style="color: red">תשובה שגויה</h2> 
                                        <?php } ?>
                                        <h3><?php echo $Question['Question']; ?></h3>
                                        <p style="color: black;font-size: 20px;font-family: 'Heebo', sans-serif;">פיתרון: <?php echo$Question['Answer' . $Question['CorrectAnswer']] ?></p>
                                        <p style="color: black;font-size: 20px;font-family: 'Heebo', sans-serif;">הסבר: <?php echo $Question['explanation'] ?></p>
                                        <?php
                                    }
                                    ?>
                                    <br>
                                    <?php if (array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) != 0) { ?><a style="font-size: 20px" href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) - 1] ?>">אחורה</a><?php } ?>&nbsp&nbsp&nbsp&nbsp&nbsp<?php if (array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) != sizeof($_SESSION['gameQuashtion']) - 1) { ?><a style="font-size: 20px;" href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) + 1] ?>">שאלה הבאה</a><?php } ?>
                                </center>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                </div>


            </div>

            <!-- Partners -->

            <div class="partners">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="partners_slider_container">
                                <div class="owl-carousel owl-theme partners_slider">

                                    <?php
                                    if ($_SESSION['idcity'] == 0) {
                                        $result = $db->GetAllAdvertisementsLimit(5);
                                    } else {
                                        $result = $db->GetAllAdvertisementsByCity($_SESSION['idcity']);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        ?>


                                        <!-- Partner Item -->
                                        <div class="owl-item partner_item"><img width="300" height="200" src="<?php echo str_replace("../", "", $row['image']); ?>" alt="בעיה בתמונה"></div>
                                        <?php }
                                        ?>


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