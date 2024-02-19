<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<main class="main" id="main">
    <h1>Create new LogBook</h1>

    <form action="/create">
        <div class="mb-3 input-group">
            <label for="ref">Ref</label>
            <input type="text" id="ref" name="ref" class="form-control">
        </div>

    </form>
</main>
<?= $this->endSection(); ?>
