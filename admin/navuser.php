<div class="col-lg-4">
    <div class="sidebar">

        <!-- Categories -->
        <div class="sidebar_section">
            <div class="sidebar_categories">
                <ul class="categories_list">
                    <li><a href="./userTypes.php" class="clearfix">סוגי משתמשים<span>(<?php echo $db->GetAlluserTypes()->num_rows ?>)</span></a></li>
                    <li><a href="./register.php" class="clearfix">צפיה במשתמשים<span>(<?php echo $db->GetAllusers()->num_rows ?>)</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>