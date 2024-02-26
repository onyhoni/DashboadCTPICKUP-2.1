<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-6">
                <div class="row">
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card p-4 gap-3">
                            <h5 class="card-title">Details <span>| Ticket</span></h5>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Tiket ID</dt>
                                <dd class="col-sm-9"><?= $tiket['tiket_id'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Tag</dt>
                                <dd class="col-sm-9"><?= $tiket['case_id'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9"><?= $tiket['status'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Keterangan</dt>
                                <dd class="col-sm-9"><?= $tiket['desc'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Urgency</dt>
                                <dd class="col-sm-9"><?= $tiket['urgency'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Created At</dt>
                                <dd class="col-sm-9"><?= $tiket['created_at'] ?></dd>
                            </dl>
                        </div>
                    </div><!-- End Recent Sales -->
                </div>
                <div class="row">
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card p-4 gap-3">
                            <h5 class="card-title">Information <span>| Shipping</span></h5>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Airwaybill</dt>
                                <dd class="col-sm-9"><?= $tiket['awb'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Account</dt>
                                <dd class="col-sm-9"><?= $tiket['account'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Customer</dt>
                                <dd class="col-sm-9"><?= $tiket['customer_name'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Seller Name</dt>
                                <dd class="col-sm-9"><?= $tiket['seller_name'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Address</dt>
                                <dd class="col-sm-9"><?= $tiket['seller_address'] ?></dd>
                            </dl>

                            <dl class="row mb-0">
                                <dt class="col-sm-3">Phone</dt>
                                <dd class="col-sm-9"><?= $tiket['seller_phone'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Origin</dt>
                                <dd class="col-sm-9"><?= $tiket['origin'] ?></dd>
                            </dl>

                            <dl class="row mb-0">
                                <dt class="col-sm-3">Regional</dt>
                                <dd class="col-sm-9"><?= $tiket['regional'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Service</dt>
                                <dd class="col-sm-9"><?= $tiket['service'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Weight</dt>
                                <dd class="col-sm-9"><?= $tiket['weight'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Qty</dt>
                                <dd class="col-sm-9"><?= $tiket['qty'] ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Destinasi</dt>
                                <dd class="col-sm-9"><?= $tiket['destinasi'] ?></dd>
                            </dl>
                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-6">
                <!-- Budget Report -->
                <div class="card rounded p-4" style="max-height: 600px; overflow-y:auto">
                    <h5 class="card-title">Chat </h5>
                    <?php foreach ($pesans as $pesan) : ?>
                        <?php if ($pesan['user_id'] == session('id')) : ?>
                            <div class="row justify-content-end p-2">
                                <div class="col-md-8 text-end rounded p-3" style="background-color: #d7eaf7">
                                    <p><?= $pesan['pesan'] ?></p>
                                    <small class="fw-lighter"><?= $pesan['created_at'] . ' | ' . $pesan['username'] ?></small>
                                </div>

                                <?php if (in_array($pesan['foto'], scandir('img'))) : ?>
                                    <div class="col-md-8 text-end">
                                        <a target="_blank" href="/img/<?= $pesan['foto'] ?>"><img
                                                    src="/img/<?= $pesan['foto'] ?>" alt="" class="img-fluid mt-3"></a>
                                    </div>
                                <?php else : ?>
                                    <div class="col-md-8 text-end">
                                        <a target="_blank" href="<?= $pesan['foto'] ?>"><img src="<?= $pesan['foto'] ?>"
                                                                                             alt=""
                                                                                             class="img-fluid mt-3"></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <div class="row p-2">
                                <div class="col-md-8 rounded p-3" style="background-color: #f2f1f0">
                                    <p><?= $pesan['pesan'] ?></p>
                                    <small class="fw-lighter"><?= $pesan['created_at'] . ' | ' . $pesan['username'] ?></small>
                                </div>

                                <?php if (in_array($pesan['foto'], scandir('img'))) : ?>
                                    <div class="col-md-8 text-end">
                                        <a target="_blank" href="/img/<?= $pesan['foto'] ?>"><img
                                                    src="/img/<?= $pesan['foto'] ?>" alt="" class="img-fluid mt-3"></a>
                                    </div>
                                <?php else : ?>
                                    <div class="col-md-8 text-end">
                                        <a target="_blank" href="<?= $pesan['foto'] ?>"><img src="<?= $pesan['foto'] ?>"
                                                                                             alt=""
                                                                                             class="img-fluid mt-3"></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div><!-- End Budget Report -->
                <?php if ($tiket['status'] == 'CLOSE') : ?>
                    <div class="d-flex justify-content-between alert alert-success" role="alert">
                        <p>Ticket has been closed...</p>
                        <?php if ($tiket['user_id'] == session('id')) : ?>
                            <form action="/tiket/open" method="post">
                                <input type="hidden" name="id" value="<?= $tiket['tiket_id'] ?>">
                                <button type="submit" class="btn btn-success">Open Tiket</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="">
                        <form action="/pesan" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="tiket_id" value="<?= $tiket['tiket_id'] ?>">

                            <textarea class="form-control <?= ($validation->hasError('pesan')) ? 'is-invalid' : '' ?> "
                                      placeholder="Comment here" style="height: 150px" name="pesan"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('pesan'); ?>
                            </div>
                            <img class="img-preview img-fluid col-sm-8 my-2">
                            <input type="file"
                                   class="form-control <?= ($validation->hasError('pesan-file')) ? 'is-invalid' : '' ?>"
                                   id="pesan-file" name="pesan-file" onchange="previewImage()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('pesan-file'); ?>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-md btn-primary">Sent Message</button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>

            </div><!-- End Right side columns -->
        </div>
    </section>
</main><!-- End #main -->

<?= $this->endSection() ?>
