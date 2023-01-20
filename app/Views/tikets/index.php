<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="row d-flex justify-content-between align-items-center bg-white">
        <div class="mb-4 col-md-4">
            <form action="tiket" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="input-group mt-4">
                    <input type="file" class="form-control <?= ($validation->hasError('import')) ? 'is-invalid' : '' ?>" id="import" name="import" aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept=".xlsx">
                    <button class="btn btn-outline-primary" type="submit" id="tombol-import">Upload</button>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('import'); ?>
                    </div>
                </div>
            </form>
        </div>
        <div class="mb-4 col-md-2 d-flex justify-content-end">
            <a href="/_upload/Template_upload_ticket.xlsx">Download Templates</a>
        </div>
    </div>
    <form action="/tiket">
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
                    <?php foreach ($cases as $case) : ?>
                        <option value="<?= $case; ?>"><?= $case ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <select class="form-select" name="regional" id="regional">
                    <option selected value="">Regional</option>
                    <?php foreach ($regionals as $regional) : ?>
                        <option value="<?= $regional ?>"><?= $regional ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <input class="form-control" type="date" name="startTime" id="startTime" value="<?= date('Y-m-d', strtotime('-1 days')) ?>">

            </div>
            <div class="col-lg-2 col-md-4">
                <input class="form-control" type="date" name="endTime" id="endTime" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="col-lg-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-primary">Cari</button>
                </div>
                <div class="">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><button type="button" class="dropdown-item" id="take">Take</button></li>
                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">Close</button></li>
                        </ul>
                    </div>
                </div>
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
            <h3 class="card-title">Tiket | Dashboard</h3>
            <table class="table table-borderless" id="example">
                <thead>
                    <tr class="nowrap">
                        <th scope="col">
                            <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                        </th>
                        <th scope="col">No</th>
                        <th scope="col">No Tiket</th>
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
                <tbody>
                    <?php $i = 1  ?>
                    <?php foreach ($tikets as $tiket) : ?>
                        <tr class="nowrap">
                            <td>
                                <?php if ($tiket->status == 'CLOSE') :   ?>
                                    <input class="form-check-input check" type="checkbox" value="<?= $tiket->tiket_id ?>" id="box" name="box[]" disabled>
                                <?php else : ?>
                                    <input class="form-check-input check" type="checkbox" value="<?= $tiket->tiket_id ?>" id="box" name="box[]">
                                <?php endif; ?>
                            </td>
                            <td scope="col"><?= $i++ ?></td>
                            <td scope="col">
                                <a href="/tiket/<?= $tiket->tiket_id ?>" target="_blank" class="fw-bold"><?= $tiket->tiket_id ?></a>
                            </td>
                            <td scope="col"><?= $tiket->awb ?></td>
                            <td scope="col"><?= $tiket->seller_name ?></td>
                            <td scope="col"><?= $tiket->origin ?></td>
                            <td scope="col"><?= $tiket->regional ?></td>
                            <td scope="col">
                                <?= $tiket->case_id ?>
                            </td>
                            <td scope="col">
                                <div class="fw-bold">
                                    <?= $tiket->case ?>
                                </div>
                            </td>
                            <td scope="col">
                                <?php if ($tiket->status  == 'OPEN') : ?>
                                    <h6>
                                        <div class="badge bg-danger status"><?= $tiket->status ?></div>
                                    </h6>
                                <?php elseif ($tiket->status == 'PROGRESS') : ?>
                                    <h6>
                                        <div class="badge bg-warning status"><?= $tiket->status ?></div>
                                    </h6>
                                <?php else : ?>
                                    <h6>
                                        <div class="badge bg-success status"><?= $tiket->status ?></div>
                                    </h6>
                                <?php endif; ?>
                            </td>
                            <td scope="col"><?= $tiket->created_at ?></td>
                            <td scope="col"><?= $tiket->urgency ?></td>
                            <td scope="col"><?= $tiket->closed_at ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Tables without borders -->
        </div>
    </div>


</main><!-- End #main -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reason Close</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select class="form-select" id="pesan-close">
                    <option selected value="Sudah Online">Sudah Online</option>
                    <option value="Missing">Missing</option>
                    <option value="Return Shipper">Return Shipper</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="closeAction" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- end Modal -->

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
                                    <th>No Resi</th>
                                    <th>Urgency</th>
                                    <th>Type Case</th>
                                    <th>keterangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (session()->getFlashdata('report')) : ?>
                                    <?php foreach (session()->getFlashdata('report') as $report) : ?>
                                        <tr class="text-center">
                                            <td><?= $report['tiket_id'] ?></td>
                                            <td><?= $report['awb'] ?></td>
                                            <td><?= $report['urgency'] ?></td>
                                            <td><?= $report['type_case'] ?></td>
                                            <td><?= $report['keterangan'] ?></td>
                                            <td><?= $report['Status'] ?></td>
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
