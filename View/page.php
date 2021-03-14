<?php require_once VIEW_DIR . '/layout/header.php'; ?>
<?php require_once VIEW_DIR . '/layout/front_menu.php'; ?>

<!-- /PAGE HEADER -->
</header>
<!-- /HEADER -->
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <h1><?= $title ?></h1>
        <!-- row -->
        <div class="row">
            <div class="col-md-8">

                <!-- post content -->
                <?= htmlspecialchars_decode($content) ?>

            </div>

            <?php require_once VIEW_DIR . '/sidebar.php'; ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<?php require_once VIEW_DIR . '/layout/footer.php'; ?>
