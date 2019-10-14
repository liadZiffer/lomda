<?php
session_start();
include_once '../DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 1) {
    $db->Redirect("../login.php");
}
$error = "";
if (isset($_POST['Insert'])) {
    $QuestionImage = "";
    $answerImage1 = "";
    $answerImage2 = "";
    $answerImage3 = "";
    $answerImage4 = "";
    if (!(!empty($_POST['Question']) || !empty($_FILES["QuestionImage"]["name"]))) {
        $error.="שאלה ריקה או אין תמונה<br>";
    }

    for ($index1 = 1; $index1 <= 4; $index1++) {
        if (!(!empty($_POST['answer' . $index1] || !empty($_FILES['answerImage' . $index1]["name"])))) {
            $error.="תשובה$index1 או תמונה$index1 ריקה<br>";
        }
    }
    if (!isset($_POST['answer'])) {
        $error.="לא נבחרה תשובה נכונה<br>";
    }
    $target_dir = "../images/";
    if (!empty($_FILES["QuestionImage"]["name"])) {
        $QuestionImage = $target_dir . basename($_FILES["QuestionImage"]["name"]);
        $imageFileType = strtolower(pathinfo($QuestionImage, PATHINFO_EXTENSION));
        if (!file_exists($QuestionImage)) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $error.="סליחה רק JPG JPEG PNG GIF מותרים לעליה<br>";
            }
            if (!empty($error)) {
                $error.="הקובץ לא עלה במערכת<br>";
            } else {
                if (!move_uploaded_file($_FILES["QuestionImage"]["tmp_name"], $QuestionImage)) {
                    $error.="נימצאה בעיה לעלות את הקובץ למערכת<br>";
                }
            }
        }
    }
    if (!empty($_FILES["answerImage1"]["name"])) {
        $answerImage1 = $target_dir . basename($_FILES["answerImage1"]["name"]);
        $imageFileType = strtolower(pathinfo($QuestionImage1, PATHINFO_EXTENSION));
        if (!file_exists($answerImage1)) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $error.="סליחה רק JPG JPEG PNG GIF מותרים לעליה<br>";
            }
            if (!empty($error)) {
                $error.="הקובץ לא עלה במערכת<br>";
            } else {
                if (!move_uploaded_file($_FILES["answerImage1"]["tmp_name"], $answerImage1)) {
                    $error.="נימצאה בעיה לעלות את הקובץ למערכת<br>";
                }
            }
        }
    }
    if (!empty($_FILES["answerImage2"]["name"])) {
        $answerImage2 = $target_dir . basename($_FILES["answerImage2"]["name"]);
        $imageFileType = strtolower(pathinfo($answerImage2, PATHINFO_EXTENSION));
        if (!file_exists($answerImage2)) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $error.="סליחה רק JPG JPEG PNG GIF מותרים לעליה<br>";
            }
            if (!empty($error)) {
                $error.="הקובץ לא עלה במערכת<br>";
            } else {
                if (!move_uploaded_file($_FILES["answerImage2"]["tmp_name"], $answerImage2)) {
                    $error.="נימצאה בעיה לעלות את הקובץ למערכת<br>";
                }
            }
        }
    }

    if (!empty($_FILES["answerImage3"]["name"])) {
        $answerImage3 = $target_dir . basename($_FILES["answerImage3"]["name"]);
        $imageFileType = strtolower(pathinfo($answerImage3, PATHINFO_EXTENSION));
        if (!file_exists($answerImage3)) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $error.="סליחה רק JPG JPEG PNG GIF מותרים לעליה<br>";
            }
            if (!empty($error)) {
                $error.="הקובץ לא עלה במערכת<br>";
            } else {
                if (!move_uploaded_file($_FILES["answerImage3"]["tmp_name"], $answerImage3)) {
                    $error.="נימצאה בעיה לעלות את הקובץ למערכת<br>";
                }
            }
        }
    }

    if (!empty($_FILES["answerImage4"]["name"])) {
        $answerImage4 = $target_dir . basename($_FILES["answerImage3"]["name"]);
        $imageFileType = strtolower(pathinfo($answerImage4, PATHINFO_EXTENSION));
        if (!file_exists($answerImage4)) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $error.="סליחה רק JPG JPEG PNG GIF מותרים לעליה<br>";
            }
            if (!empty($error)) {
                $error.="הקובץ לא עלה במערכת<br>";
            } else {
                if (!move_uploaded_file($_FILES["answerImage4"]["tmp_name"], $answerImage4)) {
                    $error.="נימצאה בעיה לעלות את הקובץ למערכת<br>";
                }
            }
        }
    }
    if (empty($error)) {
        $db->InsertQuestion($_POST['idQuestionType'], $_GET['subject'], $_POST['Question'], $QuestionImage, $_POST['answer1'], $answerImage1, $_POST['answer2'], $answerImage2, $_POST['answer3'], $answerImage3, $_POST['answer4'], $answerImage4, $_POST['answer'], $_POST['explanation'], $_POST['startDate'], $_POST['endDate']);
        $db->Redirect("Questions.php?subject=" . $_GET['subject']);
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
                            <?php
                            $result = $db->GetSubjectQuestionsById($_GET['subject']);
                            ?>
                            <div class="blog_title"><center>שאלות בנושא <?php echo $result['Subject_name'] ?></center></div>
                            <div>
                                <center>
                                    <form action="Questions.php?subject=<?php echo $_GET['subject'] ?>" method="POST" enctype="multipart/form-data">
                                        <table>
                                            <tr>
                                                <td><label>סוג שאלה:</label></td>
                                                <td><select name="idQuestionType" required>
                                                        <?php
                                                        $QuestionType = $db->GetAllQuestionType();
                                                        if ($QuestionType->num_rows > 0) {
                                                            while ($row = $QuestionType->fetch_assoc()) {
                                                                ?>
                                                                <option <?php if (isset($_POST['idQuestionType']) && $row['idQuestionType'] == $_POST['idQuestionType']) { ?> selected <?php } ?>  value="<?php echo $row['idQuestionType'] ?>"><?php echo $row['questionType_name'] ?></option>
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
                                                <td><label>השאלה:</label></td>
                                                <td><input type="text" name="Question" value="<?php
                                                    if (isset($_POST['Question'])) {
                                                        echo $_POST['Question'];
                                                    }
                                                    ?>"></td>
                                                <td><label>תמונת שאלה:</label></td>
                                                <td><input type="file" name="QuestionImage"></td>

                                            </tr>
                                            <?php
                                            for ($index = 1; $index <= 4; $index++) {
                                                ?>
                                                <tr>
                                                    <td><input type="radio" name="answer" value="<?php echo $index ?>"  <?php if (isset($_POST['answer']) && $_POST['answer'] == $index) { ?>checked  <?php } ?>></td>
                                                    <td><input type="text" name="answer<?php echo $index ?>" value="<?php
                                                        if (isset($_POST['answer' . $index])) {
                                                            echo $_POST['answer' . $index];
                                                        }
                                                        ?>"></td>
                                                    <td><label>תמונת תשובה<?php echo $index ?>:</label></td>
                                                    <td><input type="file" name="answerImage<?php echo $index; ?>"></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><label>הסבר תשובה:</label></td>
                                                <td><input type="text" name="explanation" value="<?php
                                                    if (isset($_POST['explanation'])) {
                                                        echo $_POST['explanation'];
                                                    }
                                                    ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><label>תאריך התחלה:</label></td>
                                                <td><input name="startDate" type="date" ></td>
                                            </tr>
                                            <tr>
                                                <td><label>תאריך סיום:</label></td>
                                                <td><input name="endDate" type="date" ></td>
                                            </tr>
                                        </table>    
                                        <?php
                                        if (!empty($error)) {
                                            ?>
                                            <label style="color: red"><?php echo $error; ?></label><br>

                                        <?php }
                                        ?>
                                        <input type="submit" name="Insert" value="הוסף שאלה"> <br>
                                    </form>


                                </center>
                            </div>
                            <!-- Comments -->
                            <div class="comments_container">
                                <ul class="comments_list">
                                    <?php
                                    $result = $db->GetAllQuestionsBySubjectId($_GET['subject']);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <li>
                                            <div class="comment_item d-flex flex-row align-items-start jutify-content-start" >
                                                <div class="comment_content" dir="rtl">
                                                    <div class="comment_title_container d-flex flex-row align-items-center justify-content-start">

                                                        <div class="comment_author"><a href="#"><?php echo $row['idQuestion'] ?></a></div>
                                                        <div class="comment_rating"><div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div></div>
                                                        <div class="comment_time ml-auto"><?php echo $row['questionType_name'] ?></div>
                                                    </div>
                                                    <div class="comment_text" dir="rtl">
                                                        <table>
                                                            <tr>
                                                                <td style="color: black"><?php echo $row['Question'] ?></td>
                                                                <td ><?php if (!empty($row['QuestionImage'])) { ?><img height="100" width="250" src="<?php echo $row['QuestionImage'] ?>"><?php } ?></td>
                                                            </tr>
                                                            <?php for ($index2 = 1; $index2 <= 4; $index2++) { ?>
                                                                <tr style="color: black;text-align: right">
                                                                    <td><?php echo $index2 ?></td>
                                                                    <td><?php echo $row['Answer' . $index2] ?></td>
                                                                    <td><?php if (!empty($row['AnswerImage' . $index2])) { ?><img height="100" width="250"  src="<?php echo $row['AnswerImage' . $index2] ?>"><?php } ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr style="color: black;text-align: right">
                                                                <td>תשובה נכונה:</td>
                                                                <td><?php echo $row['CorrectAnswer'] ?></td>
                                                            </tr>
                                                            <tr style="color: black;text-align: right">
                                                                <td><?php
                                                                    if ($row['startdate'] != "0000-00-00" && $row['idQuestionType'] == 2) {
                                                                        echo date("d-m-Y", strtotime($row['startdate']));
                                                                    }
                                                                    ?></td>
                                                                <td><?php
                                                                    if ($row['enddate'] != "0000-00-00" && $row['idQuestionType'] == 2) {
                                                                        echo date("d-m-Y", strtotime($row['enddate']));
                                                                    }
                                                                    ?></td>
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
                        <div class="col-lg-4">
                            <?php include_once './navSubjectQuestions.php'; ?>
                          
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