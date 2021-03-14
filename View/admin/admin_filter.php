<div class="col-12">
    <div class="card">
        <div class="card-body d-flex">
            <form class="w-75">
                <div class="d-flex flex-row">
                    <?php
                    $filePath = VIEW_DIR . '/admin/admin_' . $model . '_filter.php';
                    if (file_exists($filePath)) {
                        include_once $filePath;
                    }
                    ?>
                    <div class="form-group pr-2 mb-0">
                        <select class="form-control" id="statusform" name="per_page">
                            <option value="10" <?= isset($_GET['per_page']) ? $_GET['per_page'] === '10' ? 'selected' : "" : '' ?>>Выводит по 10</option>
                            <option value="20" <?= isset($_GET['per_page']) ? $_GET['per_page'] === '20' ? 'selected' : "" : '' ?>>Выводит по 20</option>
                            <option value="50" <?= isset($_GET['per_page']) ? $_GET['per_page'] === '50' ? 'selected' : "" : '' ?>>Выводит по 50</option>
                            <option value="200" <?= isset($_GET['per_page']) ? $_GET['per_page'] === '200' ? 'selected' : "" : '' ?>>Выводит по 200</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="filter" value="Сортировать">
                </div>
            </form>
            <?php $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>
            <a href="<?= $url_path ?>/create" class="btn btn-primary w-25">Создать</a>
        </div>
    </div>
</div>
