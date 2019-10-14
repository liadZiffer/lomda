<div class="col-lg-4">
    <div class="sidebar">

        <!-- Categories -->
        <div class="sidebar_section">
            <div class="sidebar_categories">
                <ul class="categories_list">
                    <li><a href="./approveType.php" class="clearfix">סוגי אישורי פרסומות<span>(<?php echo $db->GetAllapproveTypes()->num_rows ?>)</span></a></li>
                    <li><a href="./showAdvertisements.php" class="clearfix">צפיה בפרסומות<span>(<?php echo $db->GetAllAdvertisements()->num_rows ?>)</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>