<?php require_once VIEW_DIR . '/layout/header.php'; ?>
<?php require_once VIEW_DIR . '/layout/front_menu.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-8  pl-5 pr-5">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"  role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>
                <form method="post" class="form-validate" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="register-username" class="label-material">Ваше ФИО</label>
                        <input  class="form-control" id="register-username" type="text" name="fio" required value="<?= $profile->fio ?>">
                    </div>
                    <div class="form-group">
                        <label for="register-username" class="label-material">Ваше никнейм</label>
                        <input  class="form-control" id="register-username" type="text" name="login" required pattern="^[a-zA-Z0-9]{3,20}$" value="<?= $profile->login ?>">
                    </div>
                    <div class="form-group">
                        <label for="register-email" class="label-material">Адрес электронной почты</label>
                        <input class="form-control" id="register-email" type="email" name="email" required pattern="\S+@[a-z]+.[a-z]+" value="<?= $profile->email ?>">
                    </div>
                    <div class="form-group">
                        <label for="register-password" class="label-material">Ваш пароль</label>
                        <input class="form-control" id="register-password" type="password" name="password" required >
                    </div>
                    <div class="form-group">
                        <label for="new-password" class="label-material">Введите новый пароль</label>
                        <input class="form-control" id="new-password" type="password" name="newPassword">
                    </div>
                    <div class="form-group">
                        <label for="file-username" class="label-material">Ваш аватар</label>
                        <input class="form-control" id="file-username" type="file" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="about-user" class="label-material">Раскажите о себе</label>
                        <textarea rows="5" class="form-control" id="about-user" name="about" pattern="^[a-zA-Z0-9]{3,20}$"><?= $profile->about ?></textarea>
                    </div>
                    <div class="form-group">
                        <input id="regidter" type="submit" name="editProfile" class="btn btn-primary" value="Сохранить изменения">
                    </div>
                </form>
        </div>
        <?php require_once VIEW_DIR . '/sidebar.php'; ?>
    </div>
    <!-- /row -->
</div>
<!-- /container -->

<?php require_once VIEW_DIR . '/layout/footer.php'; ?>
