<?php require_once VIEW_DIR . '/layout/header.php'; ?>
<?php require_once VIEW_DIR . '/layout/front_menu.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="alert alert-info"><?= $subscriber ?> - ваша подписка удаленна </div>
            <a href="/" class="primary-button">На главную</a>
        </div>
        <?php require_once VIEW_DIR . '/sidebar.php'; ?>
    </div>
</div>
<?php require_once VIEW_DIR . '/layout/footer.php'; ?>
