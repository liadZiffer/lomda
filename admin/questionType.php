<?php
session_start();
include_once '../DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 1) {
    $db->Redirect("../login.php");
}
$error = "";
if (isset($_POST['insert'])) {
    if (!$db->InsertQuestionType($_POST['questionType'])) {
        $error = "סוג שאלה לא התווספה";
    }
}
?>
<!DOCTYPE html>
<html lang="he">
    <head>
        <title>סוגי שאלות</title>
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
                            <div class="blog_title"><center>סוגי שאלות</center></div>
                            <center>
                                <form action="./questionType.php" method="POST">
                                    <label>סוג שאלה:</label><input name="questionType" type="text" required><br>
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
                                        $result = $db->GetAllQuestionType();
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['idQuestionType'] ?></th>
                                                <td><?php echo $row['questionType_name'] ?></td>
                                                <td><?php echo $db->GetAllQuestionsByQuestionTypeId($row['idQuestionType'])->num_rows ?></td>

                                            </tr>
                                        <?php }
                                        ?>


                                    </tbody>
                                </table> 

                            </center>
                        </div>

                        <!-- Blog Sidebar -->
                        <div class="col-lg-4">
                            <?php include_once './navSubjectQuestions.php'; ?>

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