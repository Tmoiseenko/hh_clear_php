
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="<?= $_SESSION['user_info']['avatar'] ?>" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h4"><?= $_SESSION['user_info']['login'] ?></h1>
            <p><?= $_SESSION['user_info']['role'] ?></p>
        </div>
    </div>