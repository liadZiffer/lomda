<?php
session_start();
// var_dump($_SESSION['iduserType']);
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
    $db->Redirect("score.php");
}
else if ( sizeof($_SESSION['gameQuashtion']) == sizeof($_SESSION['Answers']) ){
    
    $db->Redirect("casualEndTest.php");
}
?>
<?php include 'header.php';?>

            <!-- Menu -->
        <div id="questions-main">
        <div class="navbar-wrap navbar-black">
                <?php include 'navbar.php';?>
            </div>
            <div class="questions-list-wrap">
                <ul class=" row list-group list-group-horizontal list-inline mx-auto justify-content-center">
                        <?php
                        $corret = 0;
                        $wrong = 0;
                        for ($index = 0; $index < sizeof($_SESSION['gameQuashtion']); $index++) {
                            ?>
                            <li class="list-group-item questions-number font-weight-bold" style="
                                <?php
                                if (isset($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]])) {
                                    if ($_SESSION['Answers'][$_SESSION['gameQuashtion'][$index]]) {
                                        $corret++;
                                        ?>
                                            background-color: #006738;
                                           color:#fff;
                                           <?php
                                       } else {
                                           $wrong++;
                                           ?>
                                            background-color: #be1e2d;
                                           color:#fff;
                                           border:3px solid #ed1c24!important;
                                       <?php }
                                       ?>

                                   <?php } ?>

                                   <a href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][$index] ?> > <?php echo $index + 1 ?></a>
                                   </li>    
                            <?php } ?>

                    </ul>
            </div>



            <div  class="courses">
                <div  class="container-fluid">
                    <div class="row">

                            <div class="col-sm-12 text-left assitant-extra-bold questions-score-wrap"dir="rtl"> 
                                <h3 class="correct-ans-sum"><?php echo $corret ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> נכונות</h3>
                                <h3 class="wrong-ans-sum"><?php echo $wrong ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> שגויות</h3>

                                </div>
                    </div>
                </div>
                <!-- end worng-correct wrap-->
                <div class="container text-center dir-rtl questions-inner-wrap relative">

                                    <?php
                                    if (isset($_GET['Quashtions'])) {
                                        $Question = $db->GetQuestionById($_GET['Quashtions']);
                                    }

                                    if (!isset($_SESSION['Answers'][$_GET['Quashtions']])) {
                                        ?>
                                        <form action="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_GET['Quashtions'] ?>" method="POST">
                                            <h3 class="font-weight-bold"><?php echo $Question['Question']; ?></h3><?php
                                    if (!empty($Question['QuestionImage'])) {
                                            ?>
                                               <img height="200" width="200" alt="photo" src="<?php echo str_replace("../", "", $Question['QuestionImage']); ?>"><br>

                                            <?php }
                                            ?>
                                            <table class="text-right display-questions-wrap">
                                                <?php
                                                $numbers = range(1, 4);
                                                shuffle($numbers);
                                                for ($index1 = 0; $index1 < 4; $index1++) {
                                                    ?>
                                                    <tr>
                                                        <td class="radio-btn-answer"> <input <?php if (isset($_SESSION['Answers'][$_GET['Quashtions']])) { ?>  disabled <?php } ?>  type="radio" name="answer" value="<?php echo $numbers[$index1]; ?>"><label for="answer"></label>
                                                            <!-- <div class="check"><div class="inside"></div></div> -->
                                                        </td>
                                                        <td class="choice-answer font-weight-bold"><?php echo " " . $Question['Answer' . $numbers[$index1]] ?></td>
                                                        <td><?php
                                            if (!empty($Question['AnswerImage' . $numbers[$index1]])) {
                                                        ?><img src="<?php echo $Question['AnswerImage' . $numbers[$index1]] ?>" height="200" width="200">  <?php } ?></td>
                                                    </tr>
                                                <?php } ?>
                                                        <p class="font-weight-bold" style="color: red"><?php echo $error ?></p>

                                            </table>
                                           <div class="container">

                                                <div class="row approve-question-wrap">
                                                        <input class="approve-question" <?php if (isset($_SESSION['Answers'][$_GET['Quashtions']])) { ?>  disabled<?php } ?> type="submit" name="submit" value="אשר תשובה">
                                                        <?php if (array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) != sizeof($_SESSION['gameQuashtion']) - 1) { ?><a class="next-question" href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) + 1] ?>">שאלה הבאה</a><?php } ?>

                                                        <?php if (array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) != 0) { ?><a class="back-to-question"  href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) - 1] ?>">דלג</a><?php } ?>
                                                </div>
                                            </div>    
                                        </form>
                                        <?php
                                    }
                                    if (isset($_SESSION['Answers'][$_GET['Quashtions']])) {
                                        if ($_SESSION['Answers'][$_GET['Quashtions']]) {
                                            ?>
                                            <h2 class="correct-question">תשובה נכונה</h2>
                                            <?php
                                        } else {
                                            ?>
                                            <h2 class="error-question">תשובה שגויה</h2> 
                                        <?php } ?>
                                        <h3><?php echo $Question['Question']; ?></h3>
                                        <p>פיתרון: <?php echo$Question['Answer' . $Question['CorrectAnswer']] ?></p>
                                        <p>הסבר: <?php echo $Question['explanation'] ?></p>
                                        <?php if (array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) != sizeof($_SESSION['gameQuashtion']) - 1) { ?><a class="next-question" href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) + 1] ?>">שאלה הבאה</a><?php } ?>

<?php if (array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) != 0) { ?><a class="back-to-question"  href="Quashtions.php?subject=<?php echo $_GET['subject'] ?>&Quashtions=<?php echo $_SESSION['gameQuashtion'][array_search($_GET['Quashtions'], $_SESSION['gameQuashtion']) - 1] ?>">אחורה</a><?php } ?>
                                        <?php
                                    }
                                    ?>

                                    
                            </div>
                            </div>
                        </div>
                    </div>



            </div>

            <!-- Display advertisments -->

            <div class="container btmAdvertise">

            <div class="adv-title row text-center">
                            <h2 class="our-ptns text-center font-weight-bold"><a href="ourPartners.php?subject=<?php echo $_SESSION['subject']; ?>">השותפים שלנו</a></h2>
                        </div>
                    <div class="row main_adv">
                        <?php
                //get relevant ads by user id city
                $relevantAdsByCity = $db->getAdvertismentDetailsByIdCity($userIdCity,$idSubjectQuestion);

                //check if theres result for subject test and for city - if yes - display in html
                if($relevantAdsByCity && mysqli_num_rows($relevantAdsByCity)){
                    
                    while ($row = mysqli_fetch_array($relevantAdsByCity)) {?>
                        <div class="business-info col-lg-3">
                            <p class="businessName font-weight-bold">
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
                <?php include 'footer.php';?>