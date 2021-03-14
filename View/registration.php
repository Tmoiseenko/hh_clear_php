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
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger m-0">
                                <?php foreach ($error as $e) {
                                    echo $e . '</br>';
                                } ?> </div>
                        <?php endif; ?>
                        <div class="form d-flex align-items-center">
                            <div class="content">
                                <form method="post" class="form-validate">
                                    <div class="form-group">
                                        <input id="register-username" type="text" name="login" required pattern="^[a-zA-Z0-9]{3,20}$" data-msg="Please enter your username" class="input-material" value="<?= $_POST ["login"] ?? '' ?>">
                                        <label for="register-username" class="label-material">Ваше никнейм</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="register-email" type="email" name="email" required pattern="\S+@[a-z]+.[a-z]+" data-msg="Please enter a valid email address" class="input-material" value="<?= $_POST ["email"] ?? '' ?>">
                                        <label for="register-email" class="label-material">Аддрес электронной почты</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="register-password" type="password" name="password" required data-msg="Please enter your password" class="input-material" value="<?= $_POST ["password"] ?? '' ?>">
                                        <label for="register-password" class="label-material">Ваш пароль</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="confirm-password" type="password" name="confirm" required data-msg="Please enter your password" class="input-material" value="<?= $_POST ["confirm"] ?? '' ?>">
                                        <label for="confirm-password" class="label-material">Повторите ваш пароль</label>
                                    </div>
                                    <div class="form-group">
                                                <input class="form-check-input" type="checkbox" id="agreement" name="agreement">
                                                <label class="form-check-label" for="agreement">
                                                    Согласие на обработку персональных данных и <a href="">правилами сайта</a>
                                                </label>
                                    </div>
                                    <div class="form-group">
                                        <input id="regidter" type="submit" name="register" class="btn btn-primary" value="Регистрация">
                                    </div>
                                </form><small>У вас уже есть аккаунт? </small><a href="/login" class="signup">Войти</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a>
                <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            </p>
        </div>
    </div>
<?php require_once VIEW_DIR . '/layout/base/admin_footer.php'; ?>