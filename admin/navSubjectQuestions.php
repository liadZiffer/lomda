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