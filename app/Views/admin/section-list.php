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
                    <h1 class="h3 m-0"><?= $title ?></h1>
                    <button
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#sectionModal"
                        data-session="{}">
                        Add Section
                    </button>
                </div>
                <div class="modal fade" id="sectionModal" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">

                            <form method="post" action="<?= base_url('admin/save-section') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id">

                                <div class="modal-header">
                                    <h5 class="modal-title">Add Section</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">
                                    <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Select Class <span class="text-danger">*</span>
                                        </label>
                                        <select name="class_id" id="class_id" class="form-select" required>
                                            <option value="" selected disabled>Select Class</option>
                                            <?php foreach ($classList as $row): ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= $row['name'] ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Section Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Capacity <span class="text-danger">*</span></label>
                                        <input type="text" name="student_capacity" class="form-control" required>
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
                                            <th>Class</th>
                                            <th>Name</th>
                                            <th>Student Capacity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($lists)) : ?>
                                            <?php $c = 1; ?>
                                            <?php foreach ($lists as $row): ?>
                                                <tr>
                                                    <td><?= $c++ ?></td>
                                                    <td><?= $row['class_id'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['student_capacity'] ?></td>
                                                    <td>
                                                        <button
                                                            class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#sectionModal"
                                                            data-session='<?= json_encode($row) ?>'>
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
    const modal = document.getElementById('sectionModal');
    const form = modal.querySelector('form');

    modal.addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        const data = JSON.parse(button.dataset.session || '{}');

        form.reset();

        modal.querySelector('.modal-title').textContent =
            data.id ? 'Edit Section' : 'Add Section';

        for (const key in data) {
            if (form.elements[key]) {
                form.elements[key].value = data[key];
            }
        }

        if (data.class) {
            form.querySelector('[name="class_id"]').value = data.class;
        }
    });
</script>
<?= $this->endSection() ?>