<?php
$notShowUserType = array(3);
session_start();
include_once '../DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 1) {
    $db->Redirect("../login.php");
}
$error = "";
if (isset($_POST['register'])) {
    if ($db->IsUserExist($_POST['email'])) {
        $error .= "אימייל קיים<br>";
    }
    $phone = str_replace("-", "", $_POST['phone']);
    if (!is_numeric($phone)) {
        $error .= "מספר טלפון לא חוקי<br>";
    }

    if (empty($error)) {
        $result = $db->InsertUser($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['idcity'], $phone, $_POST['birthdate'], $_POST['iduserType']);
        if ($result < 1) {
            $error = "משתמש לא התווסף";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>צפיה במשתמשים</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Unicat project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
        <link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../styles/blog_single.css">
        <link rel="stylesheet" type="text/css" href="../styles/blog_single_responsive.css">
    </head>
    <body>

        <div class="super_container">

           <?php include_once './navbar.php'; ?>



            <!-- Blog -->

            <div class="blog">
                <div class="container">
                    <div class="row">

                        <!-- Blog Content -->
                        <div class="col-lg-8" dir="rtl">
                            <div class="blog_title"><center>צפיה במשתמשים</center></div>
                            <center>
                                <form action="register.php" method="POST">
                                    <table>
                                        <tr>
                                            <td><label>E-mail:</label></td>
                                            <td> <input name="email" type="email" value="<?php
                                                if (isset($_POST['email'])) {
                                                    echo $_POST['email'];
                                                }
                                                ?>" required></td>
                                        </tr>
                                        <tr>
                                            <td><label>סיסמא:</label></td>
                                            <td><input name="password" type="password" value="<?php
                                                if (isset($_POST['password'])) {
                                                    echo $_POST['password'];
                                                }
                                                ?>" required></td>
                                        </tr>
                                        <tr>
                                            <td> <label>שם פרטי:</label></td>
                                            <td><input name="firstname" type="text" value="<?php
                                                if (isset($_POST['firstname'])) {
                                                    echo $_POST['firstname'];
                                                }
                                                ?>" required></td>
                                        </tr>
                                        <tr>
                                            <td> <label>שם משפחה:</label></td>
                                            <td> <input name="lastname" type="text"value="<?php
                                                if (isset($_POST['lastname'])) {
                                                    echo $_POST['lastname'];
                                                }
                                                ?>" required></td>
                                        </tr>
                                        <tr>
                                            <td>  <label>עיר מגורים</label></td>
                                            <td><select name="idcity" required>
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
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td><label>טלפון:</label></td>
                                            <td><input name="phone" type="text" value="<?php
                                                if (isset($_POST['phone'])) {
                                                    echo $_POST['phone'];
                                                }
                                                ?>" required></td>
                                        </tr>
                                        <tr>
                                            <td><label>תאריך לידה:</label></td>
                                            <td> <input name="birthdate" type="date" required></td>
                                        </tr>
                                        <tr>
                                            <td><label>סוג משתמש:</label></td>
                                            <td><select name="iduserType" required>
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
                                                </select></td>
                                        </tr>
                                    </table>
                                    <?php
                                    if (!empty($error)) {
                                        ?>
                                        <label style="color: red"><?php echo $error; ?></label><br>

                                    <?php }
                                    ?>
                                    <input type="submit" name="register" value="הרשם"> <br>
                                </form>

                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" >תאריך הרשמה</th>
                                            <th scope="col" >אימייל</th>
                                            <th scope="col" >שם מלא</th>
                                            <th scope="col" >עיר</th>
                                            <th scope="col" >סוג משתמש</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = $db->GetAllusers();
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['iduser'] ?></th>
                                                <td><?php echo date("d-m-Y", strtotime($row['registerdate'])); ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                                                <td><?php echo $row['city_name'] ?></td>
                                                <td><?php echo $row['userType_name'] ?></td>

                                            </tr>
                                        <?php }
                                        ?>


                                    </tbody>
                                </table> 
                            </center>


                        </div>

                        <!-- Blog Sidebar -->
                        <?php include_once './navuser.php'; ?>
                    </div>
                </div>
            </div>


        </div>

        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../styles/bootstrap4/popper.js"></script>
        <script src="../styles/bootstrap4/bootstrap.min.js"></script>
        <script src="../plugins/easing/easing.js"></script>
        <script src="../plugins/parallax-js-master/parallax.min.js"></script>
        <script src="../plugins/colorbox/jquery.colorbox-min.js"></script>
        <script src="../js/blog_single.js"></script>
    </body>
</html>