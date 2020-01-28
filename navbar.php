  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container-fluid">
        <?php 
        //if user didnt connect show reg/signup btn
            if(!isset($_SESSION['iduser'])){?>
                  <ul class="row ul-register-login">
                    <li class="list-inline-item white-color">
                        <a data-toggle="modal" data-target="#system-login">התחבר</a>
                    </li>
                    <li class="list-inline-item white-color">
                        <a data-toggle="modal" data-target="#system-register"> הרשמה</a>
                    </li>
                </ul>
                <?php
        }
        //if connect hide it
        else {
            echo ('');
        }

      
      ?>

      <?php
        if(isset($_SESSION['iduser'])){?>
                  <div class="hello-user white-color dir-rtl">
                    <?php if ($_SESSION['iduser']==0) {?>
                <p>שלום <?php echo 'אורח' ?></p>
                    <?php }
                    else{?>
                <p>שלום <?php echo $_SESSION['fullname'] ?></p>
                <p class="logout-btn white-color"><a href="logout.php">ניתוק מהמערכת</a></p>
                    <?php } ?>

        </div>
       <?php
        }
        else {
            echo ('');
        }

      
      ?>

      <button id="nav-icon1" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#portfolio">צרו קשר</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#about">קצת עלינו</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#team">השאלונים שלנו</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">דף הבית</a>
          </li>
        </ul>
      </div>
      <a class="logo-wrapper"  href="#"><img src="images/site-images/logo.png" alt="לוגו אתר סימולטורס" title="לוגו אתר סימולטורס"></a>
    </div>
  </nav>