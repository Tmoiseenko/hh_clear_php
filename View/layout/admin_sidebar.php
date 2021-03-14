<!-- Side Navbar -->
<nav class="side-navbar">
<?php require_once VIEW_DIR . '/admin/user_info.php'; ?>
<?php
    if ($_SESSION['user_info']['role'] === 'administrator'){
        require_once VIEW_DIR . '/layout/admin_menu_sidebar.php';
    } elseif ($_SESSION['user_info']['role'] === 'moderator') {
        require_once VIEW_DIR . '/layout/moderator_menu_sidebar.php';
    }
?>
</nav>
