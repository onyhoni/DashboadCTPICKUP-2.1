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
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h6>Edit LogBook</h6>
                </div>
                <div class="card-body">
                    <form action="/log/<?= $log->id ?> " method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="modal-body row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="task" class="form-label">Task Ref / Awb</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('task')) ? 'is-invalid' : '' ?>"
                                           id="task" name="task" value="<?= old('task') ? old('task') : $log->task ?>">
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('task')) ? $validation->getError('task') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="code_3lc" class="form-label">Origin</label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('code_3lc')) ? 'is-invalid' : '' ?>"
                                               id="code_3lc" name="code_3lc"
                                               value="<?= old('code_3lc') ? old('code_3lc') : $log->code_3lc ?>">
                                        <div class="invalid-feedback">
                                            <?= ($validation->hasError('code_3lc')) ? $validation->getError('code_3lc') : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="account" class="form-label">Account</label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('account')) ? 'is-invalid' : '' ?>"
                                               id="account" name="account"
                                               value="<?= old('account') ? old('account') : $log->account_id ?>">
                                        <div class="invalid-feedback">
                                            <?= ($validation->hasError('account')) ? $validation->getError('account') : '' ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="regional" class="form-label">Regional</label>
                                    <select class="form-control" name="regional" id="regional">
                                        <option <?= $log->regional == 'BDTBCC' ? 'selected' : '' ?> value="BDTBCC">
                                            BDTBCC
                                        </option>
                                        <option <?= $log->regional == 'JAKARTA' ? 'selected' : '' ?> value="JAKARTA">
                                            JAKARTA
                                        </option>
                                        <option <?= $log->regional == 'JABAR' ? 'selected' : '' ?> value="JABAR">JABAR
                                        </option>
                                        <option <?= $log->regional == 'JATENG' ? 'selected' : '' ?> value="JATENG">
                                            JATENG
                                        </option>
                                        <option <?= $log->regional == 'JTBNN' ? 'selected' : '' ?> value="JTBNN">JTBNN
                                        </option>
                                        <option <?= $log->regional == 'SULPA' ? 'selected' : '' ?> value="SULPA">SULPA
                                        </option>
                                        <option <?= $log->regional == 'KALIMANTAN' ? 'selected' : '' ?>
                                                value="KALIMANTAN">
                                            KALIMANTAN
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Priorty</label>
                                    <select class="form-control" name="priority">
                                        <option <?= $log->priority == 'MEDIUM' ? 'selected' : '' ?> value="MEDIUM">
                                            MEDIUM
                                        </option>
                                        <option <?= $log->priority == 'HIGH' ? 'selected' : '' ?> value="HIGH">HIGH
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('priority')) ? $validation->getError('account') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="escalation" class="form-label">Escalation</label>
                                    <select class="form-control" name="escalation" id="escalation">
                                        <option <?= $log->escalation == 'NO' ? 'selected' : '' ?> value="NO">NO
                                        </option>
                                        <option <?= $log->escalation == 'YES' ? 'selected' : '' ?> value="YES">YES
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('escalation')) ? $validation->getError('escalation') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="escalation" class="form-label">Action</label>
                                    <textarea
                                            class="form-control <?= ($validation->hasError('action')) ? 'is-invalid' : '' ?>"
                                            rows="5" name="action" id="action"><?= $log->action ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('action')) ? $validation->getError('action') : '' ?>
                                    </div>
                                </div>
                            </div>

                            <!--rigth side-->

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="escalation" class="form-label">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <?php foreach ($categories as $category) : ?>
                                            <option <?= $log->category_id == $category->id ? 'selected' : '' ?>
                                                    value=<?= $category->id ?>><?= $category->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="issue" class="form-label">Issue</label>
                                    <select class="form-control" name="issue" id="issue">
                                        <?php foreach ($issues as $issue) : ?>
                                            <option <?= $log->issue_id == $issue->id ? 'selected' : '' ?>
                                                    value="<?= $issue->id ?>"><?= $issue->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="sub_type" class="form-label">Sub Type</label>
                                    <select class="form-control  <?= ($validation->hasError('sub_type')) ? 'is-invalid' : '' ?>"
                                            name="sub_type" id="sub_type">
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('sub_type')) ? $validation->getError('sub_type') : '' ?>
                                    </div>
                                    <input type="hidden" name="sub_type_old" id="sub_type_old"
                                           value="<?= $log->sub_type_id ?>">

                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <select class="form-control  <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>"
                                            name="description" id="description">
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('description')) ? $validation->getError('description') : '' ?>
                                    </div>

                                    <input type="hidden" name="description_old" id="description_old"
                                           value="<?= $log->description_id ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="impact" class="form-label">Impact</label>
                                    <select class="form-control  <?= ($validation->hasError('impact')) ? 'is-invalid' : '' ?>"
                                            name="impact" id="impact">
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('impact')) ? $validation->getError('impact') : '' ?>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success btn-lg" style="width:100px " type="submit">Save
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
<?= $this->endSection('content'); ?>
