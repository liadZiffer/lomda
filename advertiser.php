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
            <h1>דף מפרסם עצמאית</h1>
        </div>
    <form role="form"  method="post" action="/" id="form" class="validate">
    <div class="row">
    <div class="col col-lg-8 col-md-8 col-sm-8">
    <div class="col col-md-12">
        <div class="form-group">
          <label for="first">שם החברה</label>
          <input type="text" class="form-control"  name="businessName" placeholder="שם החברה" id="businessName">
        </div>
      </div>
      <div class="col col-md-12">
        <div class="form-group">
          <label for="last">שם פרטי</label>
          <input type="text" class="form-control"  name="name" placeholder="שם פרטי" id="last">
        </div>
      </div>
      <div class="col col-md-12">
        <div class="form-group">
          <label for="first">שם משפחה</label>
          <input type="text" class="form-control" name="surname" placeholder="שם משפחה" id="first">
        </div>
      </div>

      <div class="col col-md-12">
        <div class="form-group">
          <label for="last">כתובת דף הבית של החברה</label>
          <input type="text" class="form-control" name="website" placeholder="כתובת דף הבית של החברה" id="website">
        </div>
      </div>
      <div class="col col-md-12">
        <div class="form-group">
          <label for="last"></label>מספר טלפון</label>
          <input type="tel" class="form-control"  name="phone" placeholder="מספר טלפון"id="phone">
        </div>
      </div>
      <div class="col col-md-12">

        <div class="form-group">
        <label for="email">כתובת מייל</label>
                <input type="email" class="form-control" name="businessEmail" id="businessEmail" placeholder="כתובת אימייל">
        </div>
        </div>
        </div><!--end business info-->
        <div class="col col-lg-4 col-md-4 col-sm-4">
  <div class="imgUp">
    <div class="imagePreview"></div>
<label class="btn btn-primary">
										    			העלאת תמונת פרסומת<input type="file" class="uploadFile img" name="image" style="width: 0px;height: 0px;overflow: hidden;">
				</label>
  </div>
    </div>
    </div>


    <button type="submit" class="btn btn-primary">עדכן עכשיו!</button>
  </form>

    </div>
    <!--end container-->

</div>
</section>
<?php include 'footer.php'; ?>
