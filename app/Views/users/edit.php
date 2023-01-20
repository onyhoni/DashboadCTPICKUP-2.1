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
                    <h6>Edit User</h6>
                </div>
                <div class="card-body">
                    <form action="/user/<?= $user['id'] ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="modal-body">
                            <input type="hidden" name="usernameOld" value="<?= $user['username'] ?>">
                            <div class="mb-3">
                                <label for="account" class="form-label">Username</label>
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ?  'is-invalid' : ''  ?>" id="username" name="username" value="<?= old('username') ?? $user['username'] ?>">
                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('username')) ?  $validation->getError('username') : ''  ?>
                                </div>


                            </div>
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Email</label>
                                <input type="text" class="form-control <?= ($validation->hasError('email')) ?  'is-invalid' : ''  ?>" id="email" name="email" value="<?= old('email') ?? $user['email'] ?>">
                                <div class="invalid-feedback">
                                    <?= ($validation->hasError('email')) ?  $validation->getError('email') : ''  ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="sales_phone " class="form-label">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="<?= $user['role'] ?>"><?= $user['role'] ?></option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class=" btn btn-primary" type="submit">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?= $this->endSection('content'); ?>
