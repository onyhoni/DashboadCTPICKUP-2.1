<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

?>
<main id="main" class="main">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <div class="row">
        <h4 class="mb-3">Created New Record</h4>
        <!--        Category-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Category</h6>
                </div>
                <div class="card-body">
                    <form action="/create/category" method="POST">
                        <div class="mb-3">
                            <label for="task" class="form-label">Category</label>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text"
                                   name="category"
                                   id="category"
                                   class="form-control <?= $validation->hasError('category') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('category')) ? $validation->getError('category') : '' ?>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--        Issue-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Issue</h6>
                </div>
                <div class="card-body">
                    <form action="/create/issue" method="POST">
                        <div class="mb-3">
                            <label for="task" class="form-label">Issue</label>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="issue" id="issue"
                                   class="form-control <?= $validation->hasError('issue') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('issue')) ? $validation->getError('issue') : '' ?>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--        Sub Type-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Sub Type</h6>
                </div>
                <div class="card-body">
                    <form action="/create/subType" method="POST">
                        <div class="mb-3">
                            <label for="sub_type" class="form-label">Issue</label>
                            <select class="form-control  <?= ($validation->hasError('issue')) ? 'is-invalid' : '' ?>"
                                    name="issue" id="">
                                <?php foreach ($issues as $issue) : ?>
                                    <option value="<?= $issue->id ?>"><?= $issue->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('issue')) ? $validation->getError('issue') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sub_type" class="form-label">Sub Type</label>
                            <input type="text"
                                   class="form-control <?= ($validation->hasError('sub_type')) ? 'is-invalid' : '' ?>"
                                   id="sub_type" name="sub_type" value="<?= old('sub_type') ?>">
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('sub_type')) ? $validation->getError('sub_type') : '' ?>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Save
                        </button>
                    </form>
                </div>
            </div>

            <!--            Impact-->
            <div class="card">
                <div class="card-header">
                    <h6>Impact</h6>
                </div>
                <div class="card-body">
                    <form action="/create/impact" method="POST">
                        <div class="mb-3">
                            <label for="impact" class="form-label">Impact</label>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="impact" id="impact"
                                   class="form-control <?= $validation->hasError('impact') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('impact')) ? $validation->getError('impact') : '' ?>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!--        Description-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Description</h6>
                </div>
                <div class="card-body">
                    <form action="/create/description" method="POST">
                        <div class="mb-3">
                            <label for="sub_type" class="form-label">Sub Type</label>
                            <select class="form-control  <?= ($validation->hasError('sub_type')) ? 'is-invalid' : '' ?>"
                                    name="sub_type" id="">
                                <?php foreach ($sub_types as $type)  : ?>
                                    <option value="<?= $type->id ?>"><?= $type->name ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('sub_type')) ? $validation->getError('sub_type') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text"
                                   class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>"
                                   id="description" name="description" value="<?= old('description') ?>">
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('description')) ? $validation->getError('description') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="impact" class="form-label">Impact</label>
                            <select class="form-control  <?= ($validation->hasError('impact')) ? 'is-invalid' : '' ?>"
                                    name="impact" id="">
                                <?php foreach ($impacts as $impact)  : ?>
                                    <option value="<?= $impact->id ?>"><?= $impact->name ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('impact')) ? $validation->getError('impact') : '' ?>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
<?= $this->endSection('content'); ?>
