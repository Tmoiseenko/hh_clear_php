<?php require_once VIEW_DIR . '/layout/honey/header.php'; ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Выводим комментарии</h3>
                </div>
            </div>
            <div class="js-card-box row justify-content-between">
                <?php
                if ( count($users) ) {
                    $i = 1;
                    // Load posts loop.
                    foreach ( $users as $user ) {
                        $odd = $i % 2 == 0 ? 'odd' : ''; ?>
                        <div class="card text-center mb-5 <?= $odd ?>">
                            <h5 class="card-title"><?= $user->fio ?></h5>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-5 mt-5">
                                    <?= $user->email ?>
                                </h6>
                                <p><?= $user->about ?></p>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    <p class="js-no-content w-100 text-center alert alert-danger"><strong>К сожалению коментариев нет</strong></p>
                    <?php
                }
                ?>

            </div>
    </main>
<?php require_once VIEW_DIR . '/layout/honey/footer.php'; ?>
