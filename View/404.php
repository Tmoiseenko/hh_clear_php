<?php require_once VIEW_DIR . '/layout/header.php'; ?>
<?php require_once VIEW_DIR . '/layout/front_menu.php'; ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
        <h1 class="m-5">404 error</h1>
        <div class="alert alert-danger"><?= $e->getMessage() ?></div>
        </div>
    </div>
</div>
<?php require_once VIEW_DIR . '/layout/footer.php'; ?>
