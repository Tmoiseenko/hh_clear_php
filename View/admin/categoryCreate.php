<?php require_once VIEW_DIR . '/layout/admin_header.php'; ?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-5">
                <form  method="post"  enctype="multipart/form-data" class="form-group">
                    <div class="form-group row">
                        <label class="form-control-label">Название категории</label>
                        <input type="text" class="form-control" required name="category">
                    </div>
                    <input type="submit" value="Сохранить" name="createCategory" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
<?php require_once VIEW_DIR . '/layout/admin_footer.php'; ?>