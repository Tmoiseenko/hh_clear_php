<?php require_once VIEW_DIR . '/layout/header.php'; ?>
<?php require_once VIEW_DIR . '/layout/front_menu.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-4">
                    <?php
                    $img_url = HOME_URL . '/public/uploaded/avatar.jpg';
                    if($profile->avatar){
                        $img_url = HOME_URL . $profile->avatar;
                    } ?>
                    <img src="<?= $img_url ?>" class="rounded img-thumbnail" alt="avatar">
                    <?php if ($subscribe) : ?>
                        <a href="/subscribe/delete/user/<?= $profile->email ?>" class="primary-button text-center mt-5">Отписаться</a>
                    <?php endif; ?>
                </div>
                <div class="col-8">
                    <p><strong>ФИО:</strong> <?= $profile->fio ?></p>
                    <p><strong>Логин:</strong> <?= $profile->login ?></p>
                    <p><strong>Email:</strong> <?= $profile->email ?></p>
                    <p><strong>Роли:</strong> <?= $profile->role->name ?></p>
                    <p><strong>О себе:</strong> <?= $profile->about ?></p>
                    <a href="/profile/<?= $profile->id ?>/edit" class="primary-button text-center mt-5">Редактировать профиль</a>
                </div>
            </div>
        </div>
<?php require_once VIEW_DIR . '/sidebar.php'; ?>
    </div>
    <!-- /row -->
</div>
<!-- /container -->

<?php require_once VIEW_DIR . '/layout/footer.php'; ?>
