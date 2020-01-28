<?php
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduserType'])) {
    $db->Redirect("login.php");
}
?>
<?php include 'header.php';?>
<div id="casualEndTest">
            <div class="navbar-wrap navbar-black ">
                <?php include 'navbar.php';?>
            </div>
            <div class = "container">
            <div class="menu-summary-wrapper">
                    <ul class="menu-summary">
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
                    </ul>
            </div>
                    <div class = "row">
                        <div class = "col">
                            <div class = "col-sm-12 text-center info-casualtest-data">
                            <p class="casual-summary-points">ציון המבחן שלך הוא: <?php echo round(100 / sizeof($_SESSION['Answers']) * $corret); ?></p>
                                <h3 class="total-answers-casual"> סך התשובות הנכונות במבחן: <?php echo $corret
                        ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> 
                                </h3>
                                <h3 class="total-answers-casual"> סך התשובות השגויות במבחן:<?php echo $wrong ?>/<?php echo sizeof($_SESSION['gameQuashtion']) ?> </h3>
                            </div>
                            <div class="total-info text-center">
                        
                                <p class="casual-register dir-rtl font-weight-bold">  רוצה להמשיך למבחן המלא שלנו הכולל 25 שאלות ולא דוגמא של 5 בלבד? 
                                   
                                </p>
                                <p>
                                    <a href="/">לרישום מהיר בחינם!</a>
                                </p>                                    
                                <a class="casual-register dir-rtl" href="subjects.php">חזרה לרשימת נושאים</a>
                                <div class="result-success-casual text-center">
                                    <img src="./images/site-images/success-result.png" class="img-responsive" alt="סיום מבחן" title="סיום מבחן" aria-label="1">
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>





                <?php unset($_SESSION['subject']);
                unset($_SESSION['gameQuashtion']);
                unset($_SESSION['Answers']);
                ?>



        </div>
            <?php include 'footer.php';?>