<?php require_once VIEW_DIR . '/layout/header.php'; ?>
<?php require_once VIEW_DIR . '/layout/front_menu.php'; ?>

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <!-- row -->
                <div class="row">
                    <?php foreach ($objects as $post) :?>
                    <!-- post -->
                    <div class="col-md-6">
                        <div class="post">
                            <a class="post-img" href="/post/<?= $post->id ?>"><img src="<?= $post->image ?>" alt=""></a>
                            <div class="post-body">
                                <div class="post-category">
                                    <a href="/category/<?= $post->category->name ?>"><?= $post->category->name ?></a>
                                </div>
                                <h3 class="post-title"><a href="/post/<?= $post->id ?>"><?= $post->title ?></a></h3>
                                <ul class="post-meta">
                                    <li><?= $post->created_at ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /post -->
                    <?php endforeach; ?>
                </div>
                <!-- /row -->
                <?php require_once VIEW_DIR . '/pagination.php'; ?>
            </div>
            <?php require_once VIEW_DIR . '/sidebar.php'; ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<?php require_once VIEW_DIR . '/layout/footer.php'; ?>
