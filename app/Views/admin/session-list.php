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
                        data-bs-target="#sessionModal"
                        data-session="{}">
                        Add Session
                    </button>
                </div>
                <div class="modal fade" id="sessionModal" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">

                            <form method="post" action="<?= base_url('admin/save-session') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id">

                                <div class="modal-header">
                                    <h5 class="modal-title">Add Session</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">
                                    <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">
                                    <div class="mb-3">
                                        <label>Session Name <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Start Date <span class="text-danger">*</span></label>
                                            <input
                                                type="date"
                                                name="start_date"
                                                class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>End Date <span class="text-danger">*</span></label>
                                            <input
                                                type="date"
                                                name="end_date"
                                                class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="sa-example my-5">
                    <div class="sa-example__legend"><?= $title ?></div>
                    <div class="sa-example__body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger text-center alert-dismissible fade show text-center">
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center alert-dismissible fade show text-center">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered mb-0" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($lists)) : ?>
                                            <?php $c = 1; ?>
                                            <?php foreach ($lists as $row): ?>
                                                <tr>
                                                    <td><?= $c++ ?></td>
                                                    <td><?= esc($row['name']) ?></td>
                                                    <td><?= esc(date('d-m-Y', strtotime($row['start_date']))) ?></td>
                                                    <td><?= esc(date('d-m-Y', strtotime($row['end_date']))) ?></td>
                                                    <td>
                                                        <button
                                                            class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#sessionModal"
                                                            data-session='<?= esc(json_encode($row)) ?>'>
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    No Data Found to be displayed
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <?= $pager->links('default', 'admin'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('layouts/table'); ?>
</div>

<script>
    const modal = document.getElementById('sessionModal');
    const form = modal.querySelector('form');

    modal.addEventListener('show.bs.modal', function(e) {
        const data = JSON.parse(e.relatedTarget.dataset.session || '{}');

        form.reset();

        modal.querySelector('.modal-title').textContent =
            data.id ? 'Edit Session' : 'Add Session';

        Object.keys(data).forEach(key => {
            if (form.elements[key]) {
                form.elements[key].value = data[key];
            }
        });
    });
</script>
<?= $this->endSection() ?>