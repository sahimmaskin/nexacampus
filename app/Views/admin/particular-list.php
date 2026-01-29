<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?? '' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="top" class="sa-app__body">
    <?php
    $currentQuery = http_build_query([
        'page' => $pager->getCurrentPage()
    ]);
    ?>

    <div class="sa-article sa-article--has-toc">
        <div class="sa-article__container container container--max--xl">
            <div class="sa-article__content">

                <div class="col d-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 m-0"><?= esc($title) ?></h1>
                    <button
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#feeParticularModel"
                        data-session="{}">
                        Add Fee Particular
                    </button>
                </div>

                <div class="modal fade" id="feeParticularModel" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">

                            <form method="post" action="<?= base_url('admin/save-particulars') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id">

                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">
                                    <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">

                                    <div class="mb-3">
                                        <label>
                                            Particular Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>
                                            Collected <span class="text-danger">*</span>
                                        </label>
                                        <select name="collected" class="form-select" required>
                                            <option selected disabled>Select Collection Type</option>
                                            <option value="Once">Once</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="sa-example my-5">
                    <div class="sa-example__legend"><?= esc($title) ?></div>

                    <div class="sa-example__body">

                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered mb-0" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Partcular Name</th>
                                            <th>Collection Freq.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($lists)) : ?>
                                            <?php $c = 1; ?>
                                            <?php foreach ($lists as $row): ?>
                                                <tr>
                                                    <td><?= $c++ ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['collected'] ?></td>
                                                    <td>
                                                        <button
                                                            class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#feeParticularModel"
                                                            data-session='<?= json_encode($row) ?>'>
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">
                                                    No Data Found to be displayed
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <?= $pager->links('default', 'admin') ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?= $this->include('layouts/table') ?>
</div>

<script>
    const modal = document.getElementById('feeParticularModel');
    const form = modal.querySelector('form');

    modal.addEventListener('show.bs.modal', function(e) {
        const data = JSON.parse(e.relatedTarget.dataset.session || '{}');

        form.reset();

        modal.querySelector('.modal-title').textContent =
            data.id ? 'Edit Fee Particular' : 'Add Fee Particular';

        for (const key in data) {
            if (form.elements[key] && form.elements[key].tagName !== 'SELECT') {
                form.elements[key].value = data[key];
            }
        }

        if (data.collected) {
            form.querySelector('[name="collected"]').value = data.collected;
        }

        if (data.id) {
            form.querySelector('[name="id"]').value = data.id;
        }
    });
</script>

<?= $this->endSection() ?>