<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<main class="main" id="main">
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-title">Category</div>
                <div class="card-body">
                    <table class="table table-borderless align-middle table-responsive">
                        <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($categories as $category) : ?>
                            <tr class="text-nowrap">
                                <td scope="col"><?= $i++ ?></td>
                                <td scope="col"><?= $category->name ?></td>
                                <td scope="col">
                                    <div class="d-flex gap-2">
                                        <button type="button" data-id="<?= $category->id ?>"
                                                data-table="categories"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                class="btn btn-primary category-edit">Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-title">Issue</div>
                <div class="card-body">
                    <table class="table table-borderless align-middle table-responsive">
                        <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($issues as $issue) : ?>
                            <tr class="text-nowrap">
                                <td scope="col"><?= $i++ ?></td>
                                <td scope="col"><?= $issue->name ?></td>
                                <td scope="col">
                                    <div class="d-flex gap-2">
                                        <button type="button" data-id="<?= $issue->id ?>"
                                                data-table="issues"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                class="btn btn-primary category-edit">Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--        -->
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-title">Sub Type</div>
                <div class="card-body">
                    <table class="table table-borderless align-middle table-responsive">
                        <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Issue</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($sub_types as $type) : ?>
                            <tr class="text-nowrap">
                                <td scope="col"><?= $i++ ?></td>
                                <td scope="col"><?= $type->issue ?></td>
                                <td scope="col"><?= $type->name ?></td>
                                <td scope="col">
                                    <div class="d-flex gap-2">
                                        <button type="button" data-id="<?= $type->id ?>"
                                                data-bs-toggle="modal" data-bs-target="#modalType"
                                                class="btn btn-primary sub-type-edit">Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-title">Impacts</div>
                <div class="card-body overflow-scroll">
                    <table class="table table-borderless align-middle table-responsive">
                        <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Issue</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($impacts as $impact) : ?>
                            <tr class="text-nowrap">
                                <td scope="col"><?= $i++ ?></td>
                                <td scope="col"><?= $impact->name ?></td>
                                <td scope="col">
                                    <button type="button" data-id="<?= $impact->id ?>"
                                            data-table="impacts"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                            class="btn btn-primary category-edit">Edit
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="">
            <div class="card p-4">
                <div class="card-title">Descriptions</div>
                <div class="card-body overflow-scroll">
                    <table class="table table-borderless align-middle table-responsive">
                        <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Sub Type</th>
                            <th scope="col">Impact</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($descriptions as $description) : ?>
                            <tr class="text-nowrap">
                                <td scope="col"><?= $i++ ?></td>
                                <td scope="col"><?= $description->sub_type ?></td>
                                <td scope="col"><?= $description->impact ?></td>
                                <td scope="col"><?= $description->name ?></td>
                                <td scope="col">
                                    <div class="d-flex gap-2">
                                        <button type="button" data-id="<?= $description->id ?>"
                                                data-bs-toggle="modal" data-bs-target="#modalDescription"
                                                class="btn btn-primary description-edit">Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!--    Modal Caategory-->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/showlog/updateCategory" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id-category" id="id-category">
                    <input type="hidden" name="table-name" id="table-name">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="task" class="form-label" id="modal-title"></label>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text"
                                   name="category"
                                   id="category"
                                   class="form-control <?= $validation->hasError('category') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= ($validation->hasError('category')) ? $validation->getError('category') : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/showlog/updateSubType" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" id="id_sub_type">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sub_type" class="form-label">Issue</label>x
                            <select class="form-control" name="issue" id="issue-edit">
                                <?php foreach ($issues as $issue) : ?>
                                    <option value="<?= $issue->id ?>"><?= $issue->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sub_type" class="form-label">Sub Type</label>
                            <input type="text" class="form-control" id="sub_type_name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDescription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/showlog/updateDescription" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" id="id_description">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sub_type" class="form-label">Sub Type</label>
                            <select class="form-control"
                                    name="sub_type" id="sub_type_id">
                                <?php foreach ($sub_types as $type)  : ?>
                                    <option value="<?= $type->id ?>"><?= $type->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text"
                                   class="form-control"
                                   id="description_name" name="description" value="<?= old('description') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="impact" class="form-label">Impact</label>
                            <select class="form-control"
                                    name="impact" id="impact_id">
                                <?php foreach ($impacts as $impact)  : ?>
                                    <option value="<?= $impact->id ?>"><?= $impact->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Save
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>


<?= $this->endSection('content'); ?>
