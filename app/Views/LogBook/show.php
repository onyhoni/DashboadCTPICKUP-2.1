<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

?>
<main id="main" class="main">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-6 bg-white p-4 rounded shadow">
            <div>
                <div class="card-body">
                    <h5 class="card-title"><?= $log->category . " | " . $log->issue ?></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 fw-bold">
                                    Task
                                </div>
                                <div class="col-md-8">
                                    <?= $log->task ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 fw-bold">
                                    Sub Type
                                </div>
                                <div class="col-md-8">
                                    <?= $log->sub_type ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 fw-bold">
                                    Description
                                </div>
                                <div class="col-md-8">
                                    <?= $log->description ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 fw-bold">
                                    Impact
                                </div>
                                <div class="col-md-8">
                                    <?= $log->impact ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 fw-bold">
                                    Action
                                </div>
                                <div class="col-md-8">
                                    <?= $log->action ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <hr/>

                    <?php if ($log->status == 'CLOSE') : ?>
                        <div class="text-center alert alert-success" role="alert">
                            <p>Log Book solved | <?= $log->updated_at ?></>
                        </div>
                    <?php else  : ?>
                        <div>
                            <form action="/log/updatelog" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="resolution"
                                           class="form-label">Resolution</label>
                                    <textarea
                                            class="form-control <?= $validation->hasError('resolution') ? 'is-invalid' : '' ?>"
                                            id="resolution" name="resolution" rows="3"></textarea>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('resolution')) ? $validation->getError('resolution') : '' ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="evidence" class="form-label">Evidance</label>
                                    <input type="file"
                                           class="form-control <?= ($validation->hasError('evidence')) ? 'is-invalid' : '' ?>"
                                           id="evidence" name="evidence">
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('evidence')) ? $validation->getError('evidence') : '' ?>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $log->id ?>">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>

                            <form action="/log/close" method="POST">
                                <?= csrf_field() ?>
                                <input type="hidden" value="<?= $log->id ?>" name="id">
                                <button class="btn btn-success btn-sm rounded">CLOSE LOG</button>
                            </form>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
        <div class="col-lg-6 bg-white p-4 rounded shadow">
            <div class="list-group">
                <?php foreach ($updates as $update)  : ?>
                    <div class="list-group-item list-group-item-action mb-4 rounded overflow-hidden"
                         aria-current="true">
                        <div class="d-flex  justify-content-between">
                            <h6 class="mb-1 fw-bold"><?= $update->username ?></h6>
                            <small><?= $update->created_at ?></small>
                        </div>
                        <p class="mb-1"><?= $update->resolution ?></p>
                        <hr/>
                        <a href="/img/<?= $update->evidance ?>" class="italic"
                           target="_blank"><?= $update->evidance ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</main><!-- End #main -->
<?= $this->endSection('content'); ?>
