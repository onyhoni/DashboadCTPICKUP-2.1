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
                    <h6>Edit Account</h6>
                </div>
                <div class="card-body">
                    <form action="/account/<?= $account['id'] ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT" />
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control <?= ($validation->hasError('customer_name')) ?  'is-invalid' : ''  ?>" id="customer_name" name="customer_name" value="<?= old('customer_name') ?? $account['cust_grouping'] ?>">
                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('customer_name')) ?  $validation->getError('customer_name') : ''  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="industry" class="form-label">Industry</label>
                                <input type="text" class="form-control <?= ($validation->hasError('industry')) ?  'is-invalid' : ''  ?>" id="industry" name="industry" value="<?= old('industry') ?? $account['cust_industry'] ?>">

                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('industry')) ?  $validation->getError('industry') : ''  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="branch" class="form-label">Branch</label>
                                <input type="text" class="form-control <?= ($validation->hasError('branch')) ?  'is-invalid' : ''  ?>" id="branch" name="branch" value="<?= old('branch') ?? $account['cust_branch'] ?>">

                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('branch')) ?  $validation->getError('branch') : ''  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="payment" class="form-label">Payment</label>
                                <select type="text" class="form-select <?= ($validation->hasError('payment')) ?  'is-invalid' : ''  ?>" id="payment" name="payment" value="<?= old('payment') ?>">
                                    <option <?= $account['payment_metode'] == 'COD' ? 'selected' : '' ?> value="COD">COD</option>
                                    <option <?= $account['payment_metode'] == 'NON COD' ? 'selected' : '' ?> value="NON COD">NON COD</option>
                                </select>

                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('payment')) ?  $validation->getError('payment') : ''  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pic_name" class="form-label">Pic Name</label>
                                <input type="text" class="form-control <?= ($validation->hasError('pic_name')) ?  'is-invalid' : ''  ?>" id="pic_name" name="pic_name" value="<?= old('pic_name') ?? $account['pic_name'] ?>">

                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('pic_name')) ?  $validation->getError('pic_name') : ''  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="sales_name" class="form-label">Sales Name</label>
                                <input type="text" class="form-control <?= ($validation->hasError('branch')) ?  'is-invalid' : ''  ?>" id="sales_name" name="sales_name" value="<?= old('sales_name') ?? $account['sales_name'] ?>">

                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('sales_name')) ?  $validation->getError('sales_name') : ''  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="sales_phone " class="form-label">Sales Phone </label>
                                <input type="number" class="form-control <?= ($validation->hasError('branch')) ?  'is-invalid' : ''  ?>" id="sales_phone" name="sales_phone" value="<?= old('sales_phone') ?? $account['sales_phone'] ?>">

                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('sales_phone')) ?  $validation->getError('sales_phone') : ''  ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class=" btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?= $this->endSection('content'); ?>
