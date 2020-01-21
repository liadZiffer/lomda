<?php
$notShowUserType = array(1, 3);
include_once './DB/dbconnect.php';
$db = new dbconnect();
$error = "";
if (isset($_POST['register'])) {
    if ($db->IsUserExist($_POST['email'])) {
        $error .= "אימייל קיים<br>";
    }
    $phone = str_replace("-", "", $_POST['phone']);
    if (!is_numeric($phone)) {
        $error .= "מספר טלפון לא חוקי<br>";
    }
    if ($_POST['idcity'] == 0) {
        $error = "לא נבחרה עיר<br>";
    }
    if (empty($error)) {
        $result = $db->InsertUser($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['idcity'], $phone, $_POST['birthdate'], $_POST['iduserType']);
        if ($result < 1) {
            $error = "משתמש לא התווסף";
        } else {
            session_start();
            $_SESSION['iduser'] = $result;
            $_SESSION['fullname'] = $_POST['firstname'] . ' ' . $_POST['lastname'];
            $_SESSION['iduserType'] = $_POST['iduserType'];
            $db->Redirect("login.php");
            $error = "משתמש  התווסף";
        }
    }
}
?>





<form action="register.php" method="POST" autocomplete="off">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="sr-only" for="inputPassword4">סיסמא</label>
      <input type="password" class="form-control form-rounded text-right" id="password" placeholder="סיסמא"
      value="<?php
        if (isset($_POST['password'])) {
            echo $_POST['password'];
        }?>"
      >
    </div>
    <div class="form-group col-md-6">
      <label class="sr-only" for="email">כתובת מייל</label>
      <input type="email" class="form-control form-rounded text-right" name="email" id="email" placeholder="כתובת מייל" value="<?php
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
        <input type="text" class="form-control form-rounded text-right" id="phone" placeholder="מספר טלפון"  name="phone" value="<?php
            if (isset($_POST['phone'])) {
                echo $_POST['phone'];
            }
            ?>"
        >
    </div>
    <div class="form-group col-md-6" id="city-reg-wrap">
        <label class="sr-only" for="idcity" dir='rtl'>בחר עיר</label>
        <select class="form-control form-rounded text-right pull-left" name="idcity" id="idcity" >
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
      <label class="sr-only" for="inputCity">סוג משתמש</label>
                                          <select name="iduserType"  class="form-control form-rounded col-md-12" dir="rtl">
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
  <!-- <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div> -->
  <button type="submit" name="register" class="btn btn-primary col-md-12" id="submit-register">הרשם</button>

</form>

