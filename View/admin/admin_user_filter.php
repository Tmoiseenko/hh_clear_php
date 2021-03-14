                    <div class="form-group pr-2 mb-0">
                        <input hidden type="number" name="page" value="<?= $current_page ?>">
                        <select class="form-control" id="statusform" name="order_by">
                            <option value="login" <?= isset($_GET['order_by']) ? $_GET['order_by'] === 'login' ? 'selected' : "" : '' ?>>Имени пользователя</option>
                            <option value="email" <?= isset($_GET['order_by']) ? $_GET['order_by'] === 'email' ? 'selected' : "" : '' ?>>Email пользователя</option>
                        </select>
                    </div>
                    <div class="form-group pr-2 mb-0">
                        <select class="form-control" id="statusform" name="order">
                            <option value="DESC" <?= isset($_GET['order']) ? $_GET['order'] === 'DESC' ? 'selected' : "" : '' ?>>По убыванию</option>
                            <option value="ASC" <?= isset($_GET['order']) ? $_GET['order'] === 'ASC' ? 'selected' : "" : '' ?>>По возрастанию</option>
                        </select>
                    </div>