<header id="header" class="mb-3">
    <!-- NAV -->
    <div id="nav">
        <!-- Top Nav -->
        <div id="nav-top">
            <div class="container">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <!-- logo -->
                    <div class="nav-logo">
                        <a href="/" class="logo"><img src="/public/front/logo.png" alt=""></a>
                    </div>
                    <!-- /logo -->

                    <div class="nav-btns">
                        <?php if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true) : ?>
                            <a href="/profile/<?= $_SESSION['user_info']['id'] ?>">Профиль</a> / <a href="/logout">Выйти</a>
                        <?php else: ?>
                            <a href="/login">Войти</a> / <a href="/register">Регистрация</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top Nav -->

        <!-- Main Nav -->
        <div id="nav-bottom">
            <div class="container">
                <!-- nav -->
                <?php $pages = App\Models\Page::all(); ?>
                <ul class="nav-menu">
                    <li><a href="/">Главная</a></li>
                    <?php foreach ($pages as $stpage): ?>
                        <li><a href="/page/<?= $stpage->id ?>"><?= $stpage->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <!-- /nav -->
            </div>
        </div>
        <!-- /Main Nav -->

        <!-- Aside Nav -->
        <div id="nav-aside">
            <ul class="nav-aside-menu">
                <li><a href="/">Главная</a></li>
                <?php foreach ($pages as $stpage): ?>
                    <li><a href="/page/<?= $stpage->id ?>"><?= $stpage->title ?></a></li>
                <?php endforeach; ?>
            </ul>
            <button class="nav-close nav-aside-close"><span></span></button>
        </div>
        <!-- /Aside Nav -->
    </div>
    <!-- /NAV -->
</header>
<!-- /HEADER -->