<?php
//*
/*
ADVERTISER EDIT PAGE
*/
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 4) {
  //var_dump( $_SESSION['iduser']);
    $db->Redirect("../login.php");
}
$error = "";

if (isset($_POST['advertiser'])) {
    $phone = str_replace("-", "", $_POST['phone']);
    if (!is_numeric($phone)) {
        $error .= "מספר טלפון לא חוקי<br>";
    }
    $idUser = $_SESSION['iduser'];
    if (empty($error)) {
      if($db->isAdExixt($_SESSION['iduser']))
      {
        $result = $db->updateAdvertismentInfo($_GET['idAdvertisement'],$_POST['businessName'], $_POST['firstName'], $_POST['lastName'], $_POST['website'], $phone, $_POST['businessEmail']);
      }
      else
      {
        $result = $db->InsertAdvertismentInfo($idUser,$_POST['businessName'], $_POST['firstName'], $_POST['lastName'], $_POST['website'], $phone, $_POST['businessEmail']);
      }
        
        if ($result < 1) {
          var_dump('hey');
          exit;
            $error = "משתמש לא התווסף";
        }
        else
        {
          //send success message to advertiser main page
          $message = 'הפרטים נוספו בהצלחה!';
          $_SESSION['message'] = $message;
          $db->Redirect("advertiserMainRoute.php");
        }
        
    }//end handle error
}
?>
<?php include 'header.php'; ?>

<section id="advertiser-main">
<div class="row">
    <div class="container">
    <div  class="courses">
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
        <?php 
        if($db->isAdExixt($_SESSION['iduser'])){
          $result = $db->getAdExixst($_SESSION['iduser']);
        }
      ?>
    <form role="form" id="advform"  action="advertiser.php<?php if(isset($result)){echo "?idAdvertisement=".$result['idAdvertisement'];} ?>" method="POST" class="validate">
      
    <p class="show_error"></p>
    <div class="row">
    <div class="col col-lg-8 col-md-8 col-sm-8">
    <div class="col col-md-12">
        <div class="form-group">
          <label for="first">שם החברה</label>
          <input type="text" class="form-control" value="<?php if(isset($result)){echo $result['businessName'];} ?>"  name="businessName" placeholder="שם החברה" id="businessName">
        </div>
      </div>
      <div class="col col-md-12">
        <div class="form-group">
          <label for="last">שם פרטי</label>
          <input type="text" class="form-control" value="<?php if(isset($result)){echo $result['firstName'];} ?>"  name="firstName" placeholder="שם פרטי" id="firstName">
        </div>
      </div>
      <div class="col col-md-12">
        <div class="form-group">
          <label for="first">שם משפחה</label>
          <input type="text" class="form-control" name="lastName" value="<?php if(isset($result)){echo $result['lastName'];} ?>" placeholder="שם משפחה" id="lastName">
        </div>
      </div>

      <div class="col col-md-12">
        <div class="form-group">
          <label for="last">כתובת דף הבית של החברה</label>
          <input type="text" class="form-control" name="website" value="<?php if(isset($result)){echo $result['website'];} ?>" placeholder="כתובת דף הבית של החברה" id="website">
        </div>
      </div>
      <div class="col col-md-12">
        <div class="form-group">
          <label for="last"></label>מספר טלפון</label>
          <input type="tel" class="form-control"  name="phone" value="<?php if(isset($result)){echo $result['phone'];} ?>" placeholder="מספר טלפון"id="phone">
        </div>
      </div>
      <div class="col col-md-12">

        <div class="form-group">
        <label for="email">כתובת מייל</label>
                <input type="email" class="form-control" value="<?php if(isset($result)){echo $result['businessEmail'];} ?>" name="businessEmail" id="businessEmail" placeholder="כתובת אימייל">
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


    <button type="submit" id="sendAdv" name="advertiser" class="btn btn-primary">עדכן עכשיו!</button>
  </form>

    </div>
    <!--end container-->

</div>
</section>
<?php include 'footer.php'; ?>
