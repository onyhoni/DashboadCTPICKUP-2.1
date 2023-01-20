<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body table-responsive">
            <a href="/register" class="btn btn-primary mt-3"><i class="bi bi-people"></i>+</a>
            <h3 class="card-title">Users | Dashboard</h3>
            <table class="table table-borderless" id="list-Users">
                <thead>
                    <tr class="nowrap">
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($users as $user) : ?>
                        <tr class="nowrap">
                            <td><?= $i++ ?></th>
                            <td><?= $user['username']; ?></th>
                            <td><?= $user['email']; ?></th>
                            <td><?= $user['password'] ?></th>
                            <td><?= $user['role'] ?></th>
                            <td><?= $user['created_at'] ?></th>
                            <td>
                                <div>
                                    <form class="d-inline" action="/user/<?= $user['id'] ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ?')">Delete</button>
                                    </form>

                                    <a class="btn btn-warning" href="/edit/<?= $user['id'] ?>">Edit</a>
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
