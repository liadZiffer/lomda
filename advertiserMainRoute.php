<?php
session_start();
include_once './DB/dbconnect.php';
$db = new dbconnect();
if (!isset($_SESSION['iduser']) || $_SESSION['iduserType'] != 4) {
    $db->Redirect("../login.php");
}

?>
<?php include 'header.php'; ?>

<div id="advertiser-main-route">
            <div class="navbar-wrap navbar-black">
                <?php include 'navbar.php';?>
            </div>
        <div class="container main-route-wrap">

            <div class="text-center main-menu-adv">
                <h1 class="main-menu-adv-title">תפריט ראשי - דף מפרסם</h1>
                <div class="section_title" dir="rtl">
                        <h2 class="section_title main-menu-adv-name">שלום <?php echo $_SESSION['fullname'] ?></h2>                            
                </div>
            <?php 
            if(isset($_SESSION['message'])){ ?>
                <h2><?php echo $_SESSION['message']; ?></h2> 
        <?php
                unset($_SESSION['message']);
        }
            
            ?>    
            </div>
            <div class="adv-main-wrap-btns">
                <div class="link-for-adv-info text-center">
                    <a class="btn cta-register-btn" href="advertiser.php">עריכת דף מפרסם</a>
                </div>
                <div class="link-for-adv-info text-center">
                    <a class="btn cta-register-btn" href="advertising.php">הוספה ועריכת פרסומות</a>
                </div>
            </div>

        </div>
        <!--end container-->
</div>
<?php include 'footer.php'; ?>
