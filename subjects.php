<?php
session_start();
unset($_SESSION['subject']);
unset($_SESSION['gameQuashtion']);
unset($_SESSION['Answers']);
include_once 'DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser'])) {
    $db->Redirect("login.php");
}

?>
    <?php include_once './header.php'; ?>
    <div id="subjects">

        <div class="container-fluid relative navbar-black">
            <!-- <div class="hello-user white-color dir-rtl">
                <p>שלום <?php echo $_SESSION['fullname'] ?></p>
                <p class="logout-btn white-color"><a href="logout.php">ניתוק מהמערכת</a></p>
            </div> -->
                <?php include_once './navbar.php'; ?>


        </div>

        <div class="row">
            <div class="container">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center table-subject-wrap ">
                            <h1>בחירת נושא</h1>
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th scope="col">שם נושא</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                $result = $db->GetAllSubjectQuestions();
                while ($row = $result->fetch_assoc()) {
                    ?>
                                        <tr>
                                            <?php
                        $Questions = $db->GetQuestionsBySubjectQuestionsId($row['idSubjectQuestion']);
                        if ($Questions->num_rows > 0) {
                            ?>
                                                <td>
                                                    <a href="Quashtions.php?subject=<?php echo $row['idSubjectQuestion']; ?>">
                                                        <?php echo $row['Subject_name'] ?>
                                                    </a>
                                                </td>
                                                <?php } ?>

                                        </tr>
                                        <?php }
                ?>


                                </tbody>
                            </table>


                    </div>
            </div>
        </div>



        <?php include_once './footer.php'; ?>

    </div>