<?php require_once VIEW_DIR . '/layout/admin_header.php'; ?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-5">
                <form  method="post"  enctype="multipart/form-data" class="form-group">
                    <div class="form-group row">
                        <label class="form-control-label">Заголовок</label>
                        <input type="text" class="form-control" required name="title">
                    </div>
                    <div class="form-group row">
                        <label class="form-control-label">Текст</label>
                        <textarea class="form-control" rows="10" required name="content"></textarea>
                    </div>
                    <input type="submit" value="Сохранить" name="createPage" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
<?php require_once VIEW_DIR . '/layout/admin_footer.php'; ?>