<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">
    <form action="/report">
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
            <div class="col-lg-2">
                <button class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless table-responsive nowrap text-uppercase" id="report">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Tiket</th>
                        <th scope="col">Awb</th>
                        <th scope="col">Account</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Regional</th>
                        <th scope="col">Pic Created</th>
                        <th scope="col">Case ID</th>
                        <th scope="col">Case</th>
                        <th scope="col">Desc Case</th>
                        <th scope="col">Status</th>
                        <th scope="col">Urgency</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Seller Name</th>
                        <th scope="col">Seller Address</th>
                        <th scope="col">Seller Phone</th>
                        <th scope="col">Seller City</th>
                        <th scope="col">Created Time</th>
                        <th scope="col">Close Time</th>
                        <th scope="col">SLA Flag</th>
                        <th scope="col">SLA</th>
                        <th scope="col">Pic Take</th>
                        <th scope="col">Reason Close</th>
                        <th scope="col">Pic Close</th>
                        <th scope="col">Zona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1  ?>
                    <?php foreach ($tikets as $tiket) : ?>
                        <tr class="nowrap">
                            <td scope="col"><?= $i++ ?></td>
                            <td scope="col"><?= $tiket['tiket_id'] ?></td>
                            <td scope="col"><?= $tiket['awb'] ?></td>
                            <td scope="col"><?= $tiket['account'] ?></td>
                            <td scope="col"><?= $tiket['origin'] ?></td>
                            <td scope="col"><?= $tiket['regional'] ?></td>
                            <td scope="col"><?= $tiket['username'] ?></td>
                            <td scope="col"><?= $tiket['case_id'] ?></td>
                            <td scope="col"><?= $tiket['case'] ?></td>
                            <td scope="col"><?= $tiket['desc'] ?></td>
                            <td scope="col"><?= $tiket['status'] ?></td>
                            <td scope="col"><?= $tiket['urgency'] ?></td>
                            <td scope="col"><?= $tiket['customer_name'] ?></td>
                            <td scope="col"><?= $tiket['seller_name'] ?></td>
                            <td scope="col"><?= $tiket['seller_address'] ?></td>
                            <td scope="col"><?= $tiket['seller_phone'] ?></td>
                            <td scope="col"><?= $tiket['city'] ?></td>
                            <td scope="col"><?= $tiket['created_at'] ?></td>
                            <td scope="col"><?= $tiket['closed_at'] ?></td>
                            <td scope="col"><?= $tiket[0] ?></td>
                            <td scope="col"><?= $tiket[4] ?></td>
                            <td scope="col"><?= $tiket[2] ?></td>
                            <td scope="col"><?= $tiket[1] ?></td>
                            <td scope="col"><?= $tiket[3] ?></td>
                            <td scope="col"><?= $tiket['zona'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</main><!-- End #main -->

<?= $this->endSection(); ?>
