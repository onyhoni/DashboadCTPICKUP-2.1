<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<main id="main" class="main">
    <div class="row py-3 bg-white mb-2">
        <div class="col-lg-3 col-md-3 d-flex align-items-center">
            <select class="form-select" name="status" id="status">
                <option selected value="">Status</option>
                <option value="OPEN">Open</option>
                <option value="PROGRESS">Progress</option>
                <option value="CLOSE">Close</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-3">
            <select class="form-select" name="case" id="case">
                <option selected value="">Case</option>
                <?php foreach ($cases as $case) : ?>
                    <option value="<?= $case ?>"><?= $case ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3 col-md-3">
            <select class="form-select" name="regional" id="regional">
                <option selected value="">Regional</option>
                <?php foreach ($regionals as $regioanal) : ?>
                    <option value="<?= $regioanal ?>"><?= $regioanal ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3 col-md-3 d-flex">
            <div class="col-6">
                <input class="form-control" type="date" name="startTime" id="startTime" value="<?= date('Y-m-d', strtotime('-1 weeks')) ?>">
            </div>
            <div class="col-6">
                <input class="form-control" type="date" name="endTime" id="endTime" value="<?= date('Y-m-d') ?>">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-5">
            <div class="row text-center">
                <div class="col-md bg-white m-2 p-2 d-flex align-items-center justify-content-center" style="height:189px;">
                    <div>
                        <p class="fw-bold fs-2">All Tiket</p>
                        <p class="fw-bold fs-2" id="total-tiket"></p>
                    </div>
                </div>
                <div class="col-md bg-white m-2 p-2 d-flex align-items-center justify-content-center" style="height:189px;">
                    <div>
                        <p class="fw-bold fs-2 text-danger">OPEN</p>
                        <p class="fw-bold fs-2 text-danger" id="total-open"></p>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md bg-white m-2 p-2 d-flex align-items-center justify-content-center" style="height:189px;">
                    <div>
                        <p class="fw-bold fs-2 text-warning">Progress</p>
                        <p class="fw-bold fs-2 text-warning" id="total-progress"></p>
                    </div>
                </div>
                <div class="col-md bg-white m-2 p-2 d-flex align-items-center justify-content-center" style="height:189px;">
                    <div>
                        <p class="fw-bold fs-2 text-primary">Solved</p>
                        <p class="fw-bold fs-2 text-primary" id="total-close"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <section class="bg-white p-3" style="height: 400px;">
                <canvas id="chart-month" style="max-height: 400px;"></canvas>
            </section>
        </div>
        <div class="col-md-3">
            <section class="bg-white p-3" style="height: 400px;">
                <canvas id="chart-branch" style="max-height: 600px;"></canvas>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <p class="bg-white p-3" style="height: 400px;">
                <!-- Bar Chart -->
                <canvas id="barChart" style="max-height: 400px;"></canvas>
                <!-- End Bar CHart -->
            </p>
        </div>
        <div class="col-md-4">
            <p class="bg-white p-3" style="height: 400px;">
                <canvas id="chart-Case" style="max-height: 400px;"></canvas>
            </p>
        </div>
        <div class="col-md-3">
            <section class="bg-white p-3" style="height: 400px;">
                <canvas id="chart-customer" style="max-height: 600px;"></canvas>
            </section>
        </div>
    </div>


</main><!-- End #main -->

<script src="/js/dash.js"></script>
<?= $this->endSection(); ?>
