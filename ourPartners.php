
<?php
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduserType'])) {
    $db->Redirect("login.php");
}
echo $_GET['subject'];
$getSubjectQuestionName = $db->GetSubjectQuestionNameBySubjectId($_GET['subject']);
include 'header.php';


?>



<section id="our-partners">
    <div class="container our-partners-wrap">
        <div class="row">
            <h1 class="text-center title"> השותפים שלנו במבחן: <?php echo $getSubjectQuestionName['Subject_name']; ?> </h1>
            <p>
                 כאן מופיעים כל המפרסמים במבחן :
                <span><b><?php echo $getSubjectQuestionName["Subject_name"]; ?></b></span>
            </p>
            <?php
                //get relevant ads by user id city
                $getAllAdvBySubjectId = $db->getAdvertismentDetailsBySubjectIdQuestion($_GET['subject']);

                //check if theres result for subject test and for city - if yes - display in html
                if($getAllAdvBySubjectId && mysqli_num_rows($getAllAdvBySubjectId)){
                    
                    while ($row = mysqli_fetch_array($getAllAdvBySubjectId)) {?>
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
</section>

<?php include 'footer.php'; ?>