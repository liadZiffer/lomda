<?php
//*
/*
ADVERTISING  EDIT PAGE OF ADVERTISER
*/
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 4) {
    $db->Redirect("../login.php");
}
else{
  $result = $db->CheckAdvExixtForUser($_SESSION['email']);
}
$error = "";
if(empty($result['idAdvertisement'])){
    $error = "ראשית, יש למלא פרטי מפרסם ואחר-כך לחזור להמשך הוספת/עריכת פרסומת";
}



//handle upload file to server
if (isset($_POST['advertising'])) {
    $startdate = date_create($_POST['startDate']);
    $endDate = date_create($_POST['endDate']);
    $formatedStartDate = date_format($startdate,'Y-m-d');
    $formatedEndDate = date_format($endDate,'Y-m-d');
    $diff = date_diff($startdate, $endDate);
    $diff = str_replace("+", "", $diff->format("%R%a"));
    if ($diff <= 0) {
        $error.="תאריך התחלה קטן או שווה לתאריך סיום<br>";
    }

      $idUser = $_SESSION['iduser'];
      if (empty($error)) {
        if($db->isAdExixt($_SESSION['iduser']))
        {
          $result = $db->updateAdvertisment($_GET['idAdvertisement'],$_POST['advertisingName'], $_POST['idSubjectQuestion'], $_POST['idcity'], $_POST['slogen'],$_POST['shortSlogen'],$formatedStartDate,$formatedEndDate);
        }
          if ($result < 1) {
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
  
  <section id="advertising-main">
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
           <?php if($error){?>
        <div class="link-for-adv-info text-center">
            <span class="error"><?php echo $error ?></span>
            <a href="advertiser.php?fullname=<?php echo $_SESSION['fullname'] ?>">עבור תחילה להוספת פרטי פרסומת</a>
        </div>
<?php }
else{
?>

        </div>
              </div>

          <div class="text-center">
              <h1>הוספת ועריכת פרסומת</h1>
          </div>
          <?php 
          if($db->isAdExixt($_SESSION['iduser'])){
            $result = $db->getAdExixst($_SESSION['iduser']);
            // var_dump($result);
            // exit;
            $getAdImg = $db->getAdImg($_SESSION['iduser']);
          }
        ?>
      <form role="form" id="advertisingForm"  action="advertising.php<?php if(isset($result)){echo "?idAdvertisement=".$result['idAdvertisement'];} ?>" method="POST" enctype="multipart/form-data" class="validate">
        
      <p class="show_error"></p>
      <div class="row">
      <div class="col col-lg-12 col-md-12 col-sm-12">
      <div class="col col-md-12">
          <div class="form-group">
            <input type="text" class="form-control" value="<?php if(isset($result)){echo $result['advertisingName'];} ?>"  name="advertisingName" placeholder="שם הפרסומת" id="advertisingName">
          </div>
        </div>
        <div class="col col-md-12">
          <div class="form-group">
            <select name="idcity">
                <option <?php if (isset($_POST['idcity']) && $row['idcity'] == $_POST['idcity']) { ?> selected <?php } ?>  value="0">כל עיר</option>
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
                <?php }
                ?>
            </select>         
            </div>
        </div>
        <div class="col col-md-12">
          <div class="form-group">
            <input type="text" class="form-control" value="<?php if(isset($result)){echo $result['slogen'];} ?>"  name="slogen" placeholder="סלוגן פרסומת" id="slogen">
          </div>
        </div>
        <div class="col col-md-12">
          <div class="form-group">
            <input type="text" class="form-control" name="shortSlogen" value="<?php if(isset($result)){echo $result['shortSlogen'];} ?>" placeholder="סלוגן קצר" id="shortSlogen">
          </div>
        </div>
  
        <div class="col col-md-12">
          <div class="form-group">
          <select name="idSubjectQuestion" id="idSubjectQuestion">
                <?php
                $cities = $db->GetAllSubjectQuestions();
                if ($cities->num_rows > 0) {
                    while ($row = $cities->fetch_assoc()) {
                        ?>
                        <option <?php if (isset($_POST['idSubjectQuestion']) && $row['idSubjectQuestion'] == $_POST['idSubjectQuestion']) { ?> selected <?php } ?>  value="<?php echo $row['idSubjectQuestion'] ?>"><?php echo $row['Subject_name'] ?></option>
                        <?php
                    }
                } else {
                    ?>
                    <option value="0" disabled="">אין ערים</option>
                <?php }
                ?>
            </select>          
        </div>
        </div>
        <div class="col col-md-12">
          <div class="form-group">
          <label for="last"></label>תאריך התחלה</label>
            <input name="startDate" type="date" value="<?php if(isset($result)){echo $result['startdate'];} ?>"  id="startDate" placeholder="הזן תאריך התחלה לפרסומת">         
         </div>
        </div>
        <div class="col col-md-12">
          <div class="form-group">
            <label for="last"></label> תאריך סיום</label>
            <input name="endDate" type="date" id="endDate" value="<?php if(isset($result)){echo $result['enddate'];} ?>"  placeholder="הזן תאריך סיום לפרסומת">         
         </div>
        </div>
          </div><!--end business info-->
      </div>
  
  
      <button type="submit" id="sendAdv" name="advertising" class="btn btn-primary">עדכן עכשיו!</button>
    </form>
  
      </div>
      <!--end container-->
  
  </div>
  </section>
  <?php include 'footer.php'; ?>
                <?php } ?>