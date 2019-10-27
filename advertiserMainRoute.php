<?php
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 4) {
    $db->Redirect("../login.php");
}
?>
<?php include 'header.php'; ?>

<section id="advertiser-main">
<div class="row">
    <div class="container">
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
        
      </div>


            </div>
        <div class="text-center">
            <h1>תפריט ראשי - דף מפרסם</h1>
            
        </div>
        <div class="link-for-adv-info text-center">
            <a href="advertiser.php?fullname=<?php echo $_SESSION['fullname'] ?>">ערוך פרטי פרסומת</a>
        </div>

    </div>
    <!--end container-->

</div>
</section>
<?php include 'footer.php'; ?>
