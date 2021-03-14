<div class="col-md-4">

    <!-- category widget -->
    <div class="aside-widget">
        <div class="section-title">
            <h2 class="title">Categories</h2>
        </div>
        <div class="category-widget">
            <?php includeLayout('front_category', array('categories' => App\Models\Category::all())); ?>
        </div>
    </div>
    <!-- /category widget -->

    <!-- newsletter widget -->
    <div class="aside-widget">
        <div class="section-title">
            <h2 class="title">Newsletter</h2>
        </div>
        <div class="newsletter-widget">
            <?php
            if (!isset($_SESSION['subscribe'])): ?>
            <form action="/subscribe" method="post">
                <p>Подпишитесь на раасылку статей нашего блога</p>
                <?php if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] === true): ?>
                    <input class="input" hidden name="subscribe" value="<?= $_SESSION['user_info']['email'] ?>">
                <?php else: ?>
                    <input class="input" name="subscribe" placeholder="Введите ваш Email">
                <?php endif; ?>
                <input type="submit"  class="primary-button" value="Подписаться">
            </form>
            <?php else: ?>
                <div>
                    <p>Спасибо что подписались на нашу рассылку</p>
                </div>
            <? endif; ?>
        </div>
    </div>
    <!-- /newsletter widget -->

</div>