<?php
session_start();
include_once '../DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 1) {
    $db->Redirect("../login.php");
}
$error = "";
if (isset($_POST['insert'])) {
    $phone = str_replace("-", "", $_POST['phone']);
    $startdate = date_create($_POST['startDate']);
    $endDate = date_create($_POST['endDate']);
    $diff = date_diff($startdate, $endDate);
    $diff = str_replace("+", "", $diff->format("%R%a"));
    if ($diff <= 0) {
        $error.="תאריך התחלה קטן או שווה לתאריך סיום<br>";
    }
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!file_exists($target_file)) {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error.="סליחה רק JPG JPEG PNG GIF מותרים לעליה<br>";
        }
        if (!empty($error)) {
            $error.="הקובץ לא עלה במערכת<br>";
        } else {
            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $error.="נימצאה בעיה לעלות את הקובץ למערכת<br>";
            }
        }
    } else {
        if (empty($error)) {
            $db->InsertAdvertisement($_POST['iduser'], $_POST['idcity'], $_POST['idSubjectQuestion'], $phone, $_POST['website'], $target_file, $_POST['slogen'], $_POST['businessName'], $_POST['shortSlogen'], $_POST['startDate'], $_POST['endDate'], $_POST['idapproveType']);
            $db->Redirect("showAdvertisements.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>סוגי אישורי פרסומות</title>
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
                            <div class="blog_title"><center>שליטה בפרסומות</center></div>
                            <div>
                                <center>
                                    <form action="showAdvertisements.php" method="POST" enctype="multipart/form-data">
                                        <table>
                                            <tr>
                                                <td><label>שם משתמש:</label></td>
                                                <td><select name="iduser" required>
                                                        <?php
                                                        $users = $db->GetAllusers();
                                                        if ($users->num_rows > 0) {
                                                            while ($row = $users->fetch_assoc()) {
                                                                ?>
                                                                <option <?php if (isset($_POST['iduser']) && $row['iduser'] == $_POST['iduser']) { ?> selected <?php } ?>  value="<?php echo $row['iduser'] ?>"><?php echo $row['email'] ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="0" disabled="">אין משתמשים</option>
                                                        <?php }
                                                        ?>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td> <label>עיר פרסום</label></td>
                                                <td><select name="idcity" required>
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
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td> <label>נושא שהפרסומת תופיעה:</label></td>
                                                <td><select name="idSubjectQuestion" required>
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
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><label>תמונה:</label></td>
                                                <td><input name="fileToUpload" type="file" required></td>
                                            </tr>
                                            <tr>
                                                <td> <label>סלוגן:</label></td>
                                                <td><input name="slogen" type="text" value="<?php
                                                        if (isset($_POST['slogen'])) {
                                                            echo $_POST['slogen'];
                                                        }
                                                        ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td> <label>שם עסק:</label></td>
                                                <td><input name="businessName" type="text" value="<?php
                                                    if (isset($_POST['businessName'])) {
                                                        echo $_POST['businessName'];
                                                    }
                                                        ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td> <label>סלוגן קצר:</label></td>
                                                <td><input name="shortSlogen" type="text" value="<?php
                                                    if (isset($_POST['shortSlogen'])) {
                                                        echo $_POST['shortSlogen'];
                                                    }
                                                        ?>" ></td>
                                            </tr>
                                            <tr>
                                                <td><label>אתר:</label></td>
                                                <td><input name="website" type="text" value="<?php
                                                    if (isset($_POST['website'])) {
                                                        echo $_POST['website'];
                                                    }
                                                        ?>" ></td>
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
                                                <td><label>תאריך התחלה:</label></td>
                                                <td><input name="startDate" type="date" required></td>
                                            </tr>
                                            <tr>
                                                <td><label>תאריך סיום:</label></td>
                                                <td> <input name="endDate" type="date" required></td>
                                            </tr>
                                            <tr>
                                                <td> <label>האם מאושר:</label></td>
                                                <td><select name="idapproveType" required>
                                                        <?php
                                                        $approveTypes = $db->GetAllapproveTypes();
                                                        if ($approveTypes->num_rows > 0) {
                                                            while ($row = $approveTypes->fetch_assoc()) {
                                                                ?>
                                                                <option <?php if (isset($_POST['idapproveType']) && $row['idapproveType'] == $_POST['idapproveType']) { ?> selected <?php } ?>  value="<?php echo $row['idapproveType'] ?>"><?php echo $row['approve_name'] ?></option>
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
                                                <td> <?php
                                                        if (!empty($error)) {
                                                            ?>
                                                        <label style="color: red"><?php echo $error; ?></label><br>

                                                    <?php }
                                                    ?></td>
                                                <td> <input type="submit" name="insert" value="הוסף פרסומת"></td>
                                            </tr>
                                        </table>


                                    </form>
                                </center>
                            </div>
                            <!-- Comments -->
                            <div class="comments_container">
                                <ul class="comments_list">
                                    <?php
                                    $result = $db->GetAllAdvertisements();
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <li>
                                            <div class="comment_item d-flex flex-row align-items-start jutify-content-start" >
                                                <div class="comment_content" dir="rtl">
                                                    <div class="comment_title_container d-flex flex-row align-items-center justify-content-start">

                                                        <div class="comment_author"><a href="#"><?php echo $row['idAdvertisement'] ?></a></div>
                                                        <div class="comment_rating"><div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div></div>
                                                        <div class="comment_time ml-auto"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></div>
                                                    </div>
                                                    <div class="comment_text" dir="rtl">
                                                        <table style="text-align: right;color: black">
                                                            <tr>
                                                                <td style="">עיר:</td>
                                                                <?php 
                                                                if($row['idcity']>0)
                                                                {
                                                                    $city=$db->GetCityByID($row['idcity']);
                                                                ?>
                                                                <td ><?php echo $city['city_name'] ?></td>
                                                                <?php }
                                                                else
                                                                { ?>
                                                                    <td >כל עיר</td>
                                                               <?php }
                                                                
                                                                ?>
                                                            </tr>
                                                            <tr>
                                                                <td >נושא:</td>
                                                                <td ><?php echo $row['Subject_name'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td >תמונה:</td>
                                                                <td ><img height="300" width="300" src="<?php echo $row['image'] ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td >סלוגן:</td>
                                                                <td ><?php echo $row['slogen'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td >שם העסק:</td>
                                                                <td ><?php echo $row['businessName'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td >סלוגן קצר:</td>
                                                                <td ><?php echo $row['shortSlogen'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td >אתר:</td>
                                                                <td ><a href="<?php echo $row['website'] ?>" target="_blank"><?php echo $row['website'] ?></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td >טלפון:</td>
                                                                <td ><?php echo $row['phone'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td >תארכים:</td>
                                                                <td ><?php echo date("d-m-Y", strtotime($row['startdate'])) ?></td>
                                                                <td ><?php echo date("d-m-Y", strtotime($row['enddate'])) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td >אישור:</td>
                                                                <td ><?php echo $row['approve_name'] ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <!--<div class="comment_extras d-flex flex-row align-items-center justify-content-start">
                                                        <div class="comment_extra comment_likes"><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>108</span></a></div>
                                                        <div class="comment_extra comment_reply"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Reply</span></a></div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>

                            </div>
                        </div>




                        <!-- Blog Sidebar -->
                        <?php include_once './navAdvertisements.php'; ?>


                    </div>
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