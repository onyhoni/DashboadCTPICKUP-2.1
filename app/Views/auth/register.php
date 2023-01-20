<?= $this->extend('layouts/app') ?>


<?= $this->section('content') ?>

<main id="main" class="main">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <div class="card mb-3">

                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                        <p class="text-center small">Enter your personal details to create account</p>
                    </div>
                    <form class="row g-3" novalidate method="post" action="/register">
                        <div class="col-12">
                            <label for="yourEmail" class="form-label <?= $validation->hasError('email') ? 'is-invalid' : '' ?>">Your Email</label>
                            <input type="email" name="email" class="form-control" id="yourEmail" value="<?= old('email') ?>" required>
                            <div class="invalid-feedback"><?= $validation->getError('email') ?? '' ?></div>
                        </div>

                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" value="<?= old('username') ?>" required>
                                <div class="invalid-feedback"><?= $validation->getError('username') ?? '' ?></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" id="yourPassword" required value="<?= old('password') ?>">
                            <div class="invalid-feedback"><?= $validation->getError('password') ?? '' ?></div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    </div>

</main><!-- End #main -->
<?= $this->Endsection() ?>
