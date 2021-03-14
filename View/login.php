<?php require_once VIEW_DIR . '/layout/base/admin_header.php'; ?>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>Dashboard</h1>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <?php if (isset($_SESSION["logon_error"]) && $_SESSION["logon_error"] === true) : ?>
                            <div class="alert alert-danger">Введеный логин или пароль не верны или отсутсвуют в базе</div>
                            <?php endif; ?>
                            <form method="post" class="form-validate">
                                <div class="form-group">
                                    <input id="login-username" type="text" name="login" required pattern="^[a-zA-Z0-9]{3,20}$" data-msg="Please enter your username" class="input-material">
                                    <label for="login-username" class="label-material">Ваше логин</label>
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                                    <label for="login-password" class="label-material">Ваш пароль</label>
                                </div><input type="submit" id="login" name="register" href="index.html" class="btn btn-primary" value="Войти">
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form><small>У вас нет аккаунта? </small><a href="/register" class="signup">Регистрация</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>Design by <a href="https://bootstrapious.com/p/admin-template" class="external">Bootstrapious</a>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </p>
    </div>
</div>
<?php require_once VIEW_DIR . '/layout/base/admin_footer.php'; ?>