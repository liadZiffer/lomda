<?php
session_start();
include_once '../DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 1) {
    $db->Redirect("../login.php");
}
$error = "";
if (isset($_POST['insert'])) {
    if (!$db->InsertUserType($_POST['userType'])) {
        $error = "סוג משתמש לא התווסף";
    }
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>סוגי משתמש</title>
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

            <!-- Header -->

             <?php include_once './navbar.php'; ?>
            <!-- Blog -->

            <div class="blog">
                <div class="container">
                    <div class="row">

                        <!-- Blog Content -->
                        <div class="col-lg-8" dir="rtl">
                            <div class="blog_title"><center>סוגי משתמש</center></div>
                            <center><form action="./userTypes.php" method="POST">
                                    <label>סוג משתמש:</label><input name="userType" type="text" required><br>
                                    <?php
                                    if (!empty($error)) {
                                        ?>
                                        <label style="color: red"><?php echo $error; ?></label><br>

                                    <?php }
                                    ?>
                                    <input type="submit" name="insert" value="הוסף">
                                </form>
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" >סוג</th>
                                            <th scope="col" >כמות</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = $db->GetAlluserTypes();
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['iduserType'] ?></th>
                                                <td><?php echo $row['userType_name'] ?></td>
                                                <td><?php echo $db->GetAllusersByIdUserType($row['iduserType'])->num_rows ?></td>
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