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
        <title>שליטה בנושאים</title>
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


                <!-- Header Content -->
                <div class="header_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                    <div class="logo_container">
                                        <a href="./index.php">
                                            <div class="logo_text"><img src="../templateImages/logo.png"></div>
                                        </a>
                                    </div>
                                    <nav class="main_nav_contaner ml-auto">
                                        <ul class="main_nav">
                                            <li ><a href="index.php">בית</a></li>
                                            <li ><a href="users.php">משתמשים</a></li>
                                            <li class="active"><a href="subjects.php">נושאים</a></li>
                                            <li><a href="Advertisements.php">פרסומות</a></li>
                                            <li><a href="../login.php"> התנתק</a></li>
                                        </ul>


                                        <!-- Hamburger -->


                                        <div class="hamburger menu_mm">
                                            <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                                        </div>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </header>

            <!-- Menu -->

            <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
                <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
                <nav class="menu_nav">
                    <ul class="menu_mm">
                        <li class="menu_mm"><a href="index.html">בית</a></li>
                        <li class="menu_mm"><a href="#">משתמשים</a></li>
                        <li class="menu_mm"><a href="#">נושאים</a></li>
                        <li class="menu_mm"><a href="#">פרסומות</a></li>
                        <li><a href="../login.php"> התנתק</a></li>
                    </ul>

                </nav>
            </div>



            <!-- Blog -->

            <div class="blog">
                <div class="container">
                    <div class="row">

                        <!-- Blog Content -->
                        <div class="col-lg-8" dir="rtl">
                            <div class="blog_title"><center>שליטה בנושאים</center></div>
                            <center>
                                <form action="./subjects.php" method="POST">
                                    <label>שם נושא:</label><input name="subjectname" type="text" required><br>
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
                                            <th scope="col" >שם נושא</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = $db->GetAllSubjectQuestions();
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['idSubjectQuestion'] ?></th>
                                                <td><?php echo $row['Subject_name'] ?></td>

                                            </tr>
                                        <?php }
                                        ?>


                                    </tbody>
                                </table> 

                            </center>
                        </div>

                        <!-- Blog Sidebar -->
                        <div class="col-lg-4">
                            <div class="sidebar">

                                <!-- Categories -->
                                <div class="sidebar_section">
                                    <div class="sidebar_categories">
                                        <ul class="categories_list">
                                            <li><a href="./questionType.php" class="clearfix">סוגי שאלות<span>(<?php echo $db->GetAllQuestionType()->num_rows ?>)</span></a></li>
                                            <?php
                                            $result = $db->GetAllSubjectQuestions();
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <li><a href="Questions.php?subject=<?php echo $row['idSubjectQuestion'] ?>" class="clearfix"><?php echo $row['Subject_name'] ?><span>(<?php echo $db->GetAllQuestionsBySubjectId($row['idSubjectQuestion'])->num_rows ?>)</span></a></li>
                                                <?php } ?>
                                        </ul>
                                    </div>
                                </div>




                            </div>
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