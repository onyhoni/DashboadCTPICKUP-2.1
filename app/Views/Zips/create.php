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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Created Zip Code</h6>
                </div>
                <div class="card-body">
                    <form action="/zip" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control <?= $validation->hasError('zip') ? 'is-invalid' : '' ?>" id="zip" name="zip">
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('zip')) ?  $validation->getError('zip') : ''  ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="3lc" class="form-label">3LC</label>
                            <input type="text" class="form-control <?= $validation->hasError('3lc') ? 'is-invalid' : '' ?>" id="3lc" name="3lc">
                            <div class="invalid-feedback">
                                <?= $validation->hasError('3lc') ? $validation->getError('3lc') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="regional" class="form-label">Regional</label>
                            <select class="form-select <?= $validation->hasError('regional') ? 'is-invalid' : '' ?>" id="regional" name="regional">
                                <option value="BDTBCC">BDTBCC</option>
                                <option value="JAKARTA">JAKARTA</option>
                                <option value="JTBNN">JTBNN</option>
                                <option value="KALIMANTAN">KALIMANTAN</option>
                                <option value="SULPA">SULPA</option>
                                <option value="SUMBAGSEL">SUMBAGSEL</option>
                                <option value="SUMBAGUT">SUMBAGUT</option>
                                <option value="JATENG">JATENG</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->hasError('regional') ? $validation->getError('regional') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sla" class="form-label">Sla</label>
                            <input type="text" class="form-control <?= $validation->hasError('sla') ? 'is-invalid' : '' ?>" id="sla" name="sla">

                            <div class="invalid-feedback">
                                <?= $validation->hasError('sla') ? $validation->getError('sla') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="zona" class="form-label">Zona</label>
                            <select class="form-control <?= $validation->hasError('zona') ? 'is-invalid' : '' ?>" id="zona" name="zona">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->hasError('zona') ? $validation->getError('zona') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3  text-end">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?= $this->endSection('content'); ?>
