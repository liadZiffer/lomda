<?php
$notShowUserType = array(1, 3);
include_once './DB/dbconnect.php';
$db = new dbconnect();
?>

<form action method="POST" id="register-form">
<div class="form-row">
    <div class="form-group col-md-6">
      <label class="sr-only" for="inputPassword4">שם משפחה</label>
      <input type="text" name="lastName" class="form-control form-rounded text-right" id="lastName" placeholder="שם משפחה">
    </div>
    <div class="form-group col-md-6">
      <label class="sr-only" for="email">שם פרטי</label>
      <input type="text" class="form-control form-rounded text-right" name="firstName" id="firstName" placeholder="שם פרטי" >
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="sr-only" for="inputPassword4">סיסמא</label>
      <input type="password" name="password-register" class="form-control form-rounded text-right" id="password-register" placeholder="סיסמא"
      >
    </div>
    <div class="form-group col-md-6">
      <label class="sr-only" for="email">כתובת מייל</label>
      <input type="email" class="form-control form-rounded text-right" name="email-register" id="email-register" placeholder="כתובת מייל" value="<?php
            if (isset($_POST['email'])) {
                echo $_POST['email'];
                 }?>"
            >
    </div>
  </div>
  <!--end first row reg form-->
  <div class="form-row">
    <div class="form-group col-md-6">
        <label class="sr-only" for="phone">טלפון</label>
        <input type="text" class="form-control form-rounded text-right" id="phone-register" placeholder="מספר טלפון"  name="phone-register" value="<?php
            if (isset($_POST['phone'])) {
                echo $_POST['phone'];
            }
            ?>"
        >
    </div>
    <div class="form-group col-md-6" id="city-reg-wrap">
        <label class="sr-only" for="idcity" dir='rtl'>בחר עיר</label>
        <select class="form-control form-rounded text-right pull-left" name="idcity-register" id="idcity-register" >
            <option <?php if (isset($_POST['idcity']) && $row['idcity'] == $_POST['idcity']) { ?> selected <?php } ?>  value="0">בחר עיר</option>

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
            <?php } ?>
        </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label class="sr-only"  for="inputCity">סוג משתמש</label>
                                          <select id="iduserType" name="iduserType"  class="form-control form-rounded col-md-12" dir="rtl">
                                          <option <?php if (isset($_POST['iduserType']) && $row['iduserType'] == $_POST['iduserType']) { ?> selected <?php } ?>  value="0">בחר משתמש</option>
                                        <?php
                                        $usertypes = $db->GetAlluserTypes();
                                        if ($usertypes->num_rows > 0) {
                                            while ($row = $usertypes->fetch_assoc()) {
                                                if (!in_array($row['iduserType'], $notShowUserType)) {
                                                    ?>
                                                    <option <?php if (isset($_POST['iduserType']) && $row['iduserType'] == $_POST['iduserType']) { ?> selected <?php } ?>  value="<?php echo $row['iduserType'] ?>"><?php echo $row['userType_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <option value="0" disabled="">אין סוגי משתמש</option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?php
                                    if (!empty($error)) {
                                        ?>
                                        <label style="color: red"><?php echo $error; ?></label><br>
                                        
                                    <?php } ?>
    </div>
  </div>
  <p class="show_msg-register"></p>
  <button type="submit" name="register" class="btn btn-primary col-md-12" id="submit-register">הרשם</button>

</form>

