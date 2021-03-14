<?php require_once VIEW_DIR . '/layout/admin_header.php'; ?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-5">
                <form  method="post"  enctype="multipart/form-data" class="form-group">
                    <p>У пользователя: <?= $user->fio ?> - права: <?= $user->role->name ?> </p>
                    <div class="form-group row">
                        <?php if ($roles) :?>
                            <label class="form-control-label">Права</label>
                            <select class="form-control mb-3" required name="role">
                                <?php
                                foreach ($roles as $role) :?>
                                    <option <?php echo $user->role->id === $role->id ? "selected" : ""; ?> value="<?= $role->id ?>"><?= $role->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>
                    <input type="submit" value="Сохранить" name="editRole" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
<?php require_once VIEW_DIR . '/layout/admin_footer.php'; ?>