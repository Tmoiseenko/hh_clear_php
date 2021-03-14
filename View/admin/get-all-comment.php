<?php require_once VIEW_DIR . '/layout/admin_header.php'; ?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО коментатора</th>
                            <th>ID поста</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($objects as $object) : ?>
                            <tr>
                                <th scope="row"><?= $object->id ?></th>
                                <td><?= $object->user->fio ?></td>
                                <td><?= $object->post->id ?></td>
                                <td>
                                    <?php if (!$object->moderate): ?>
                                        <a href="/admin/comment/moderate/<?= $object->id  ?>">Подтвердить</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php require_once VIEW_DIR . '/pagination.php'; ?>
<?php require_once VIEW_DIR . '/layout/admin_footer.php'; ?>