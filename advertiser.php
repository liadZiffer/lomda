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
//handle upload file to server
if (isset($_POST['advertiser'])) {
  $adDetails=$db->GetAdvertismentByUserId($_SESSION['iduser']);
  
  if(empty($adDetails['file_name']) ||
   (!empty($_FILES['file']['name']) &&
     substr($adDetails['file_name'],
     strpos($adDetails['file_name'],'/')+1,
     strlen($adDetails['file_name'])-strpos($adDetails['file_name'],'/'))!=$_FILES['file']['name']))
    {
    $fileName = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $max_size = 100000;
    $targetDir = "images/";
    $fileName = $targetDir . $fileName;
    $extension = substr($fileName, strpos($fileName, '.') + 1);
    $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(isset($fileName) && !empty($fileName)){
      if(in_array($fileType, $allowTypes)){
        if(file_exists($fileName))
        {
          unlink($fileName);
        }
        if(move_uploaded_file($tmp_name, $fileName)){
          
          $tempName=substr($fileName,0,strpos($fileName,'/')+1)."image".date("dmYHis").rand(1,1000000).substr($fileName,
          strpos($fileName,'.'),
          strlen($fileName)-strpos($fileName,'.'));
          rename($fileName,$tempName);
          $fileName=$tempName;
          $smsg = "Uploaded Successfully";
    
        }else{
          $fmsg = "Failed to Upload File";
        }
      }else{
        $fmsg = "File size should be 100 KiloBytes & Only JPEG File";
      }
    }else{
      $fmsg = "Please Select a File";
    }
  }
  else
  {

    $fileName=$adDetails['file_name'];
  }



//end handle upload file to server

    $phone = str_replace("-", "", $_POST['phone']);
    if (!is_numeric($phone)) {
        $error .= "מספר טלפון לא חוקי<br>";
    }
    $idUser = $_SESSION['iduser'];
    if (empty($error)) {
      if($db->isAdExixt($_SESSION['iduser']))
      {
        $result = $db->updateAdvertismentInfo($_GET['idAdvertisement'],$_POST['businessName'], $_POST['firstName'], $_POST['lastName'], $_POST['website'], $phone, $_POST['businessEmail'],$fileName);
      }
      else
      {
        $result = $db->InsertAdvertismentInfo($idUser,$_POST['businessName'], $_POST['firstName'], $_POST['lastName'], $_POST['website'], $phone, $_POST['businessEmail'],$fileName);
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
          $getAdImg = $db->getAdImg($_SESSION['iduser']);
        }
      ?>
    <form role="form" id="advform"  action="advertiser.php<?php if(isset($result)){echo "?idAdvertisement=".$result['idAdvertisement'];} ?>" method="POST" enctype="multipart/form-data" class="validate">
      
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
  <div class="imgUp form-group">
    <div class="imagePreview" style="background:url('<?php if(isset($getAdImg)){echo $getAdImg['file_name'];} ?>')!important;background-repeat: no-repeat;background-position: center center;border: 1px solid;width: 100%;height: 28em;"></div>
<label for="InputFile" class="btn btn-primary">בחר פרסומת להעלאה</label>
<input type="file" value="<?php if(isset($result)){echo $result['file_name'];} ?>" class="uploadFile img" name="file" id="InputFile" >
	  
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