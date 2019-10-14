<?php
session_start();
include_once '../DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 1) {
    $db->Redirect("../login.php");
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>שליטה במשתמשים</title>
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

            <header class="header">


                 <?php include_once './navbar.php'; ?>



            <!-- Blog -->

            <div class="blog">
                <div class="container">
                    <div class="row">

                        <!-- Blog Content -->
                        <div class="col-lg-8">
                            <div class="blog_title"><center>שליטה במשתמשים</center></div>



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