<?php

// session_start();
// session_destroy();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (isset($_GET['iduser']) && $_GET['iduser'] == 0) {
session_start();
$_SESSION['iduser'] = 0;
$_SESSION['idcity'] = 0;
$_SESSION['iduserType'] = 3;// 2 its RANDOM USER
$db->Redirect("subjects.php");
}

if (isset($_POST['login'])) {
if ($db->CheckLogin($_POST['email'], $_POST['password'])) {

    $result = $db->GetUserDetails($_POST['email']);
    session_start();
    $_SESSION['iduser'] = $result['iduser'];
    $_SESSION['fullname'] = $result['firstname'] . " " . $result['lastname'];
    $_SESSION['iduserType'] = $result['iduserType'];
    $_SESSION['idcity'] = $result['idcity'];
    $_SESSION['email'] = $result['email'];
    // var_dump($_SESSION['email']);
    // exit;
    //$_SESSION['idAdvertisement']= $result['idAdvertisement'];
    switch ($result['iduserType']) {
        case 1:
            $db->Redirect("./admin/index.php");
            break;
        case 2://casual user login
            $db->Redirect("subjects.php");
            break;
            case 4://advertiser login
            $db->Redirect("advertiserMainRoute.php");
            break;
        default:
            break;
    }
} else {
    $error = "שם משתמש או סיסמא לא נכונים";
}
}
?>


<form  action="login.php" method="POST" autocomplete="off">
    <div class="form-group col-sm-12">
      <label class="sr-only" for="email">כתובת מייל</label>
        <input type="email" class="form-control form-rounded text-right"  placeholder="כתובת מייל" name="email" value="<?php
        if (isset($_POST['email'])) {
        echo $_POST['email'];
        }
        ?>" required="required">
    </div>
    <div class="form-group col-sm-12">
    <label class="sr-only" for="password">סיסמא</label>
                                <input type="password" class="form-control form-rounded text-right" placeholder="סיסמא:" name="password" value="<?php
                                if (isset($_POST['password'])) {
                                    echo $_POST['password'];
                                }
?>" required="required">
</div>

                                <?php
                                if (!empty($error)) {
                                    ?>
                                    <label style="color: red"><?php echo $error; ?></label><br>

                                <?php } ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3 login-inner">
                                            <a>שכחתי סיסמא</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col">
                                        <button type="submit" name="login" class="btn btn-primary col" id="submit-login">התחבר</button>
                                    </div>
                                    </div>
                                </div>
                            </form>



