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
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h6>Create New LogBook</h6>
                </div>
                <div class="card-body">
                    <form action="/log" method="POST">
                        <div class="modal-body row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="task" class="form-label">Ref ID</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('task')) ? 'is-invalid' : '' ?>"
                                           id="task" name="task"
                                           value="<?= old('task') ? old('task') : $log->task ?>">
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('task')) ? $validation->getError('ref_id') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="code_3lc" class="form-label">Code 3lc</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('code_3lc')) ? 'is-invalid' : '' ?>"
                                           id="code_3lc" name="code_3lc"
                                           value="<?= old('code_3lc') ? old('code_3lc') : $log->code_3lc ?>">
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('code_3lc')) ? $validation->getError('code_3lc') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="regional" class="form-label">Regional</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('regional')) ? 'is-invalid' : '' ?>"
                                           id="regional" name="regional"
                                           value="<?= old('regional') ? old('regional') : $log->regional ?>">
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('regional')) ? $validation->getError('regional') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Priorty</label>
                                    <select class="form-control" name="priority">
                                        <option <?= $log->priority == 'medium' ? 'selected' : null ?> value="medium">
                                            Medium
                                        </option>
                                        <option <?= $log->priority == 'high' ? 'selected' : null ?> value="high">High
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="issue" class="form-label">Issue</label>
                                    <textarea type="text" rows="5"
                                              class="form-control <?= ($validation->hasError('issue')) ? 'is-invalid' : '' ?>"
                                              id="issue"
                                              name="issue"><?= old('issue') ? old('issue') : $log->issue ?></textarea>
                                    <div class=" invalid-feedback">
                                        <?= ($validation->hasError('issue')) ? $validation->getError('issue') : '' ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="escalation" class="form-label">Escalation</label>
                                    <select class="form-control" name="escalation" id="escalation">
                                        <option value="y">Yes</option>
                                        <option value="n">No</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('escalation')) ? $validation->getError('escalation') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="impact" class="form-label">Impact</label>
                                    <textarea type="text" rows="5"
                                              class="form-control <?= ($validation->hasError('impact')) ? 'is-invalid' : '' ?>"
                                              id="impact" name="impact"></textarea>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('impact')) ? $validation->getError('impact') : '' ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="action" class="form-label">Action</label>
                                    <textarea type="text" rows="5"
                                              class="form-control <?= ($validation->hasError('action')) ? 'is-invalid' : '' ?>"
                                              id="action" name="action" value="<?= old('action') ?>">

                                </textarea>
                                    <div class="invalid-feedback">
                                        <?= ($validation->hasError('action')) ? $validation->getError('impact') : '' ?>
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
