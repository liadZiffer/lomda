<?php include 'header.php';?>

<!-- Back to top button -->
<a id="button-to-top"></a>
<div class="modal fade" id="system-register" tabindex="-1" role="dialog" aria-labelledby="system-register">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php include_once 'register.php'; ?>
            </div>
            <!-- <div class="modal-footer row">
                <div class="col facebook-wrap-login">
                    <button> </button>
                </div>
                <div class="col google-wrap-login">
                    <button></button>
                </div>
            </div> -->
         </div>
      </div>
   </div>
   <!--system login modal-->
   <div class="modal fade" id="system-login" tabindex="-1" role="dialog" aria-labelledby="system-login">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body dir-rtl">
                <?php include_once 'login.php'; ?>
            </div>
         </div>
      </div>
   </div>

        

           <!-- Header -->
        <header class="masthead relative">
        <?php include_once 'navbar.php'; ?>
            <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in section-one-title">
                <h1 class="assitant-extra-bold">מערכת לומדות</h1>
                </div>
                <div class="section-one-subtitle Assistant-Bold">
                    <h3>סימולאטור לבחינות לצורך תרגול ולמידה</h3>
                </div>
                <div class="col cta-register text-center dir-rtl">
                    
                    <a class="btn cta-register-btn" href="login.php?iduser=0">רוצים לנסות? לחצו כאן!</a>
                </div>
            </div>
            </div>
        </header>
        <!--end of section-one-->
        <section id="section-two">
            <div class="container">
            <div class="row">
                    <div class=" section-two-wrap ">
                        <div class="section-two-title">
                            <h2 class="black-color Assistant-Bold">
                            המערכת פותחה בכדי לאפשר לכל מי שרוצה לתרגל וללמוד בחינם תוך כדי תרגול ומשחק בכל מקום
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="icons-wrapper row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 text-center inner-icon wow fadeInLeft" data-wow-duration="2" data-wow-delay="2">
                        <img class="img-fluid" src="images/site-images/left1.png" alt="מבחנים בייעוץ משכנתאות" title="מבחנים בייעוץ משכנתאות">
                        <p>
                        מבחנים בתחום ייעוץ משכנתאות
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 text-center inner-icon wow fadeInLeft" data-wow-duration="2" data-wow-delay="2">
                        <img class="img-fluid" src="images/site-images/left2.png" alt="אייקון מבחני משרד התחבורה" title="אייקון מבחני משרד התחבורה">
                        <p>
                        מבחני התיאוריה הרשמיים של משרד התחבורה, לכל סוגי כלי הרכב, האופנועים ואופניים חשמליות
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 text-center inner-icon wow fadeInRight" data-wow-duration="2" data-wow-delay="2" >
                        <img class="img-fluid" src="images/site-images/left3.png" alt="אייקון מבחני דגלים" title="אייקון מבחני דגלים">
                        <p>
                        מבחנים בתחומי דגלי מדינות, ערי בירה, בעלי חיים, נושאים כלליים ועוד
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 text-center inner-icon wow fadeInRight" data-wow-duration="2" data-wow-delay="2">
                        <img class="img-fluid" src="images/site-images/left4.png" alt="אייקון מבחן מתווכים רשמי" title="אייקון מבחן מתווכים רשמי">
                        <p>
                        למבחן המתווכים הרשמי במקרקעין במערכת אלפי מבחנים לדוגמא לתרגול ולמידה בחינם
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--end of section-two-->
        <section id="section-three">
            <div class="section-two-title">
                <h2 class="black-color Assistant-Bold">
                    היתרונות של מערכת הסימולטרים
                </h2>
            </div>
            <div class="row info-text">
                <div class="laptop-img text-center col-lg-6 col-md-6 col-sm-12 wow slideInLeft" data-wow-duration="1.5s" data-wow-delay="1.5s">
                    <img class="img-fluid" src="images/site-images/computer.png" alt="אייקון מבחן מתווכים רשמי" title="אייקון מבחן מתווכים רשמי">
                </div>
                <div class="text-number-wrap col-lg-6 col-md-6 col-sm-12 row">
                    <div class="col-lg-10 dir-rtl col-md-10 col-10 col-sm-10 text-info-simulators text-right wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>תרגולי מבחנים, בכל נושא שתרצו , גם בנייד והכל בחינם</span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 number-info wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>1</span>
                    </div>
                    <div class="col-lg-10 dir-rtl col-md-10 col-10 col-sm-10 text-info-simulators text-right wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>הרשמה למערכת באופן ידידותי וקל, שתתחילו ישר לצבור נקודות במבחן</span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 number-info wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>2</span>
                    </div>
                    <div class="col-lg-10 dir-rtl col-md-10 col-10 col-sm-10 text-info-simulators text-right wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>בוחרים מבחן מבין עשרות מבחנים שזמינים לכם 24/7 מתי שרק תרצו</span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 number-info wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>3</span>
                    </div>
                    <div class="col-lg-10 dir-rtl col-md-10 col-10 col-sm-10 text-info-simulators text-right wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>בחרתם מבחן? מצוין! הגיע זמן לראות מה אתם שווים</span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 number-info wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>4</span>
                    </div>
                    <div class="col-lg-10 dir-rtl col-md-10 col-10 col-sm-10 text-info-simulators text-right wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>אפשרויות פרסום באתר, לבעלי עסקים גדולים וקטנים כאחד, עם חשיפה לאלפי לקוחות</span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 number-info wow fadeInRight" data-wow-duration="1" data-wow-delay="1"">
                        <span>5</span>
                    </div>
                </div>
            </div>
        </section>
        <!--end of section-four-->

  <!--end of container-main-page-->

<?php include 'footer.php';?>
