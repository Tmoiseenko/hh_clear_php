<ul>
    <?php foreach ($categories as $cat) :?>
    <li><a href="/category/<?= $cat->id ?>"><?= $cat->name ?><span><?= countPosts($cat->id) ?></span></a></li>
    <?php endforeach; ?>
</ul>