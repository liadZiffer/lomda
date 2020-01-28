

<form action method="POST"  id="login-form">
    <div class="form-group col-sm-12">
      <label class="sr-only" for="email">כתובת מייל</label>
        <input type="email" id="email-login" class="form-control form-rounded text-right"  placeholder="כתובת מייל" name="email-login" value="<?php
        if (isset($_POST['email'])) {
        echo $_POST['email'];
        }
        ?>">
    </div>
    <div class="form-group col-sm-12">
    <label class="sr-only" for="password">סיסמא</label>
                                <input type="password-login" id="password" class="form-control form-rounded text-right" placeholder="סיסמא:" name="password-login" value="<?php
                                if (isset($_POST['password'])) {
                                    echo $_POST['password'];
                                }
?>">
</div>

                                <?php
                                if (!empty($error)) {
                                    ?>
                                    <label style="color: red"><?php echo $error; ?></label><br>

                                <?php } ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3 login-inner">
                                            <a>שכחתי סיסמא</a>
                                        </div>
                                        <p class="show_msg"></p>
                                    </div>
                                    <div class="row">
                                    <div class="col">
                                        <button type="submit" name="login" class="btn btn-primary col" id="submit-login">התחבר</button>
                                    </div>
                                    </div>
                                </div>
                            </form>



