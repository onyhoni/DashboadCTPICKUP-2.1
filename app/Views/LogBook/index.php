<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form action="/MyTiket">
        <div class="row mb-2 py-3 bg-white">
            <div class="col-lg-2 col-md-4">
                <select class="form-select" name="status" id="status">
                    <option selected value="">Status</option>
                    <option value="OPEN">Open</option>
                    <option value="PROGRESS">Progress</option>
                    <option value="CLOSE">Close</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <select class="form-select" name="case" id="case">
                    <option selected value="">Case</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <select class="form-select" name="regional" id="regional">
                    <option selected value="">Regional</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <input class="form-control" type="date" name="startTime" id="startTime" value="<?= date('Y-m-d', strtotime('-1 days')) ?>">

            </div>
            <div class="col-lg-2 col-md-4">
                <input class="form-control" type="date" name="endTime" id="endTime" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="col-lg-2 d-flex">
                <button class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body table-responsive">
            <h3 class="card-title">Logbook | Control Tower</h3>
            <table class="table table-borderless" id="example">
                <thead>
                    <tr class="nowrap">
                        <th scope="col">
                            <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                        </th>
                        <th scope="col">No</th>
                        <th scope="col">code</th>
                        <th scope="col">Awb</th>
                        <th scope="col">Seller Name</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Regional</th>
                        <th scope="col">Case</th>
                        <th scope="col">Desc Case</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created Time</th>
                        <th scope="col">Urgency</th>
                        <th scope="col">Close Time</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <!-- End Tables without borders -->
        </div>
    </div>


</main><!-- End #main -->

<?php if (session()->getFlashdata('report')) : ?>
    <div class="modal" id="modal-report" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report Import</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No Tiket</th>
                                    <th>Pesan</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (session()->getFlashdata('report')) : ?>
                                    <?php foreach (session()->getFlashdata('report') as $report) : ?>
                                        <tr class="text-center">
                                            <td><?= $report['tiket_id'] ?></td>
                                            <td><?= $report['pesan'] ?></td>
                                            <td><?= $report['status'] ?></td>
                                            <td><?= $report['reason'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>
