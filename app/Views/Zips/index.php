<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-4">
            <a href="/zip/new" class="btn btn-primary mt-3"><i class="bi bi-people"></i>+</a>
        </div>
        <div class="col-8 d-flex justify-content-end">
            <form action="/zip" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search zip code ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword" id="keyword">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body table-responsive">
            <h3 class="card-title">Zip Code</h3>
            <table class="table table-borderless" id="list-Users">
                <thead>
                    <tr class="nowrap">
                        <th scope="col">No</th>
                        <th scope="col">Zip Code</th>
                        <th scope="col">Regional</th>
                        <th scope="col">Zona</th>
                        <th scope="col">SLA</th>
                        <th scope="col">3 LC</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)) ?>
                    <?php foreach ($zips as $zip) : ?>
                        <tr class="nowrap">
                            <td><?= $i++ ?></th>
                            <td><?= $zip->id; ?></th>
                            <td><?= $zip->regional; ?></th>
                            <td><?= $zip->zona ?></th>
                            <td><?= $zip->sla ?></th>
                            <td><?= $zip->code_3lc ?></th>
                            <td>
                                <div>
                                    <form class="d-inline" action="/zip/<?= $zip->id ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah sudah yakin ?')">Delete</button>
                                    </form>

                                    <a class="btn btn-warning" href="/zip/<?= $zip->id ?>/edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Tables without borders -->
            <?= $pager->Links('zipcode', 'bootstrap_pagination') ?>
        </div>
    </div>


</main><!-- End #main -->

<?= $this->endSection(); ?>
