<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form action="/log">
        <div class="row mb-2 py-3 bg-white">
            <div class="col-lg-2 col-md-4">
                <select class="form-select" name="status" id="status">
                    <option value="">Status</option>
                    <option <?= $request['status'] == 'OPEN' ? 'selected' : '' ?> value="OPEN">Open</option>
                    <option <?= $request['status'] == 'CLOSE' ? 'selected' : '' ?> value="CLOSE">Close</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <select class="form-select" name="category" id="category">
                    <option value="">Category</option>
                    <option <?= $request['category'] == '1' ? 'selected' : '' ?> value="1">Internal</option>
                    <option <?= $request['category'] == '2' ? 'selected' : '' ?> value="2">External</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <select class="form-select" name="regional" id="regional">
                    <option selected value="">Regional</option>
                    <option <?= $request['regional'] == 'BDTBCC' ? 'selected' : '' ?> value="BDTBCC">BDTBCC</option>
                    <option <?= $request['regional'] == 'JAKARTA' ? 'selected' : '' ?> value="JAKARTA">JAKARTA</option>
                    <option <?= $request['regional'] == 'JABAR' ? 'selected' : '' ?> value="JABAR">JABAR</option>
                    <option <?= $request['regional'] == 'JATENG' ? 'selected' : '' ?> value="JATENG">JATENG</option>
                    <option <?= $request['regional'] == 'JTBNN' ? 'selected' : '' ?> value="JTBNN">JTBNN</option>
                    <option <?= $request['regional'] == 'SULPA' ? 'selected' : '' ?> value="SULPA">SULPA</option>
                    <option <?= $request['regional'] == 'KALIMANTAN' ? 'selected' : '' ?> value="KALIMANTAN">
                        KALIMANTAN
                    </option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <input class="form-control" type="date" name="startTime" id="startTime"
                       value="<?= $request['startTime'] ? $request['startTime'] : date('Y-m-d', strtotime('-7 days')) ?>">

            </div>
            <div class="col-lg-2 col-md-4">
                <input class="form-control" type="date" name="endTime" id="endTime"
                       value="<?= $request['endTime'] ? $request['endTime'] : date('Y-m-d') ?>">
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
        <div class="card-body">
            <h3 class="card-title">Logbook | Control Tower</h3>
            <div class="mb-4"><a href="/log/new" class="btn btn-secondary btn-sm mb">Create</a></div>
            <table class="table table-borderless align-middle table-responsive" id="report">
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
                        <td scope="col"><?= $log['customer'] ?></td>
                        <td scope="col"><?= $log['code_3lc'] ?></td>
                        <td scope="col"><?= $log['regional'] ?></td>
                        <td scope="col"><?= $log['priority'] ?></td>
                        <td scope="col"><?= $log['created_at'] ?></td>
                        <td scope="col"><?= $log['category'] ?></td>
                        <td scope="col"><?= $log['issue'] ?></td>
                        <td scope="col"><?= $log['sub_type'] ?></td>
                        <td scope="col"><?= $log['description'] ?></td>
                        <td scope="col"><?= $log['escalation'] ?></td>
                        <td scope="col"><?= $log['impact'] ?></td>
                        <td scope="col"><?= $log['action'] ?></td>
                        <td scope="col"><?= $log['task'] ?></td>
                        <td scope="col"><?= $log['0'] ? $log['0']['created_at'] : '-' ?></td>
                        <td scope="col"><?= $log['0'] ? $log['0']['resolution'] : '-' ?></td>
                        <td scope="col"><?= $log['0'] ? $log['0']['evidance'] : '-' ?></td>
                        <td scope="col"><?= $log['username'] ?></td>
                        <td scope="col"><?= $log['status'] ?></td>
                        <td scope="col">
                            <div class="d-flex gap-2">
                                <div><a href="/log/<?= $log['id'] ?>/edit" class="btn btn-primary">Edit</a></div>
                                <div><a href="/log/<?= $log['id'] ?>" class="btn btn-success">Update</a>
                                </div>
                            </div>
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
