<?php
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduserType'])) {
    $db->Redirect("login.php");
}

if (!isset($_SESSION['subject'])) {
    $_SESSION['subject'] = $_GET['subject'];
    echo($_SESSION['iduserType']);
}
if ($_SESSION['subject'] != $_GET['subject']) {
    unset($_SESSION['subject']);
    $_SESSION['subject'] = $_GET['subject'];
    unset($_SESSION['gameQuashtion']);
}
//get the id of subject selected by user
$idSubjectQuestion = $_SESSION['subject'];
//get the idcity by iduser
$userIdCity = $db->GetUserCityByUserId($_SESSION['iduser'])['idcity'];

if (!isset($_SESSION['gameQuashtion'])) {
    $_SESSION['gameQuashtion'] = array();
    if($_SESSION['iduserType'] == 2){//unregistered user show only 5 questions
        $result = $db->GetQuestionsBySubjectQuestionsIdAndQnty($_GET['subject'], 25);
    }
    else{
        $result = $db->GetQuestionsBySubjectQuestionsIdAndQnty($_GET['subject'], 5);
    }
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
        $error = "לא נבחרה תשובה";
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
//if its casual user redirect to different sum page info than register user
if (sizeof($_SESSION['gameQuashtion']) == sizeof($_SESSION['Answers']) && $_SESSION['iduserType'] == 2) {
    $db->Redirect("casualEndTest.php");
}
else if ( sizeof($_SESSION['gameQuashtion']) == sizeof($_SESSION['Answers']) ){
    $db->Redirect("score.php");
}
?>
<?php include 'header.php';?>

            <!-- Menu -->
        <section id="questions-main">
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

            <!-- Display advertisments -->

            <div class="container btmAdvertise">


                <div class="row">

                    <div class="col-sm-8 main_adv">
                        <div class="adv-title">
                            <h2><a href="ourPartners.php?subject=<?php echo $_SESSION['subject']; ?>">השותפים שלנו</a></h2>
                        </div>
                        <?php
                //get relevant ads by user id city
                $relevantAdsByCity = $db->getAdvertismentDetailsByIdCity($userIdCity,$idSubjectQuestion);

                //check if theres result for subject test and for city - if yes - display in html
                if($relevantAdsByCity && mysqli_num_rows($relevantAdsByCity)){
                    
                    while ($row = mysqli_fetch_array($relevantAdsByCity)) {?>
                                                 <div class="business-info">
                        <p class="businessName">
                            <span>++++++++</span>
                            <?php echo $row['businessName'] ?>
                        </p>
                        <p class="advertisingName"><?php echo $row['advertisingName'] ?></p>
                        <p class="slogen"><?php echo $row['slogen'] ?></p>
                        <p class="businessEmail"><?php echo $row['businessEmail'] ?></p>
                        <p class="file_name">
                            <img src="<?php echo $row['file_name']?>" >
                        </p>
                       

                    </div>  

                          <?php  } 
 
                }
                else{?>
                    <p class="advertisingName">אין מפרסמים בעיר שלך</p>
                <?php }?>
                
             
                    </div>
                    

                </div>
            </div>
        </section><!-- END QUESTIONS SECTION -->


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