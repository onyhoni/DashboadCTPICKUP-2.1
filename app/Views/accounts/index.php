<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<main id="main" class="main">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row my-4">
        <div class="col-4">
            <a href="account/create" class="btn btn-primary">Create New Account</a>
        </div>
        <div class="col-8 d-flex justify-content-end">
            <form action="/account" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search account number ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword" id="keyword">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-body table-responsive">
            <h3 class="card-title">List Account | Control Tower</h3>
            <table class="table table-borderless no-wrap" id="list-account">
                <thead>
                    <tr class="no wrap">
                        <th scope="col">No</th>
                        <th scope="col">No Account</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Industry</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Pic Name</th>
                        <th scope="col">Sales Name</th>
                        <th scope="col">Sales Phone</th>
                        <th scope="col">Created Time</th>
                        <th scope="col">Updated Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($accounts as $account) : ?>
                        <tr class="no wrap">
                            <td scope="col"><?= $i++ ?></td>
                            <td scope="col"><?= $account['id'] ?></td>
                            <td scope="col"><?= $account['cust_grouping'] ?></td>
                            <td scope="col"><?= $account['cust_industry'] ?></td>
                            <td scope="col"><?= $account['cust_branch'] ?></td>
                            <td scope="col"><?= $account['payment_metode'] ?></td>
                            <td scope="col"><?= $account['pic_name'] ?></td>
                            <td scope="col"><?= $account['sales_name'] ?></td>
                            <td scope="col"><?= $account['sales_phone'] ?></td>
                            <td scope="col"><?= $account['created_at'] ?></td>
                            <td scope="col"><?= $account['updated_at'] ?></td>
                            <td>
                                <div>
                                    <form class="d-inline" action="/account/<?= $account['id'] ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah sudah yakin ?')">Delete</button>
                                    </form>
                                    <a class="btn btn-warning" href="/account/<?= $account['id'] ?>/edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Tables without borders -->

            <?= $pager->Links('account', 'bootstrap_pagination') ?>
        </div>
    </div>


</main><!-- End #main -->

<?= $this->endSection('content'); ?>
