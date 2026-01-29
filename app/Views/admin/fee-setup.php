<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?? '' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="top" class="sa-app__body">
    <div class="sa-article sa-article--has-toc">
        <div class="sa-article__container container container--max--xl">
            <div class="sa-article__content">
                <div class="sa-example my-5">
                    <div class="sa-example__legend"><?= $title ?></div>
                    <br>
                    <div class="sa-example__body">
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show text-center">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?= base_url('admin/save-fee') ?>" id="feeSetUp_form">
                            <?= csrf_field() ?>
                            <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">
                            <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">
                            <div class="row g-4">
                                <h6 class="mt-2"></h6>

                                <div class="col-md-6">
                                    <label class="form-label">Session</label>
                                    <select name="session" id="session" class="form-control">
                                        <option value="">Select Session</option>
                                        <?php foreach ($sessionList as $row): ?>
                                            <option value="<?= $row['id'] ?>"><?= esc($row['name']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Class</label>
                                    <select name="class" id="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        <?php foreach ($classList as $row): ?>
                                            <option value="<?= $row['id'] ?>"><?= esc($row['name']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h6 class="mb-3">Fee Particulars</h6>

                            <?php if (!empty($feeParticularList)): ?>
                                <?php foreach ($feeParticularList as $particular): ?>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0 fw-semibold">
                                                <?= esc($particular['name']) ?>
                                                <small class="text-muted">
                                                    (<?= esc($particular['collected']) ?>)
                                                </small>
                                            </label>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="number" step="0.01" class="form-control" name="amount[<?= $particular['id'] ?>]" placeholder="Enter amount" required>
                                        </div>

                                        <input type="hidden" name="particular_id[]" value="<?= $particular['id'] ?>">
                                        <input type="hidden" name="collected[<?= $particular['id'] ?>]" value="<?= esc($particular['collected']) ?>">
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="text-end mt-4" id="submit_btn">
                                <button type="submit" class="btn btn-primary px-4">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>

<?= $this->endSection() ?>