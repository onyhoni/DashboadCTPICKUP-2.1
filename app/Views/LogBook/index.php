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
                <input class="form-control" type="date" name="startTime" id="startTime"
                       value="<?= date('Y-m-d', strtotime('-1 days')) ?>">

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
            <div class="mb-4"><a href="/log/new" class="btn btn-secondary btn-sm mb">Create</a></div>
            <table class="table table-borderless align-middle" id="example">
                <thead>
                <tr class="text-nowrap">
                    <th scope="col">No</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Regional</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Created</th>
                    <th scope="col">Category</th>
                    <th scope="col">Issue</th>
                    <th scope="col">Sub Type</th>
                    <th scope="col">Description</th>
                    <th scope="col">Escalation</th>
                    <th scope="col">Impact</th>
                    <th scope="col">Action</th>
                    <th scope="col">Task</th>
                    <th scope="col">Date Resolution</th>
                    <th scope="col">Final Resolution</th>
                    <th scope="col">Evidence</th>
                    <th scope="col">Pic Created</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($logs as $log) : ?>
                    <tr class="text-nowrap">
                        <td scope="col"><?= $i++ ?></td>
                        <td scope="col"><?= $log->account_id ?></td>
                        <td scope="col"><?= $log->code_3lc ?></td>
                        <td scope="col"><?= $log->regional ?></td>
                        <td scope="col"><?= $log->priority ?></td>
                        <td scope="col"><?= $log->created_at ?></td>
                        <td scope="col"><?= $log->category ?></td>
                        <td scope="col"><?= $log->issue ?></td>
                        <td scope="col"><?= $log->sub_type ?></td>
                        <td scope="col"><?= $log->description ?></td>
                        <td scope="col"><?= $log->escalation ?></td>
                        <td scope="col"><?= $log->impact ?></td>
                        <td scope="col"><?= $log->action ?></td>
                        <td scope="col"><?= $log->task ?></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"></td>
                        <td scope="col"><?= $log->username ?></td>
                        <td scope="col"><?= $log->status ?></td>
                        <td scope="col">
                            <div><a href="/log/1/edit" class="btn btn-primary">Edit</a></div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Tables without borders -->
        </div>
    </div>


</main><!-- End #main -->


<?= $this->endSection(); ?>
