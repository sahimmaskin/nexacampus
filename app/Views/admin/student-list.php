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
                                            <th>Appl. No.</th>
                                            <th>Details</th>
                                            <th>Date of Birth</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($lists)) : ?>
                                            <?php $c = 1; ?>
                                            <?php foreach ($lists as $row): ?>
                                                <tr>
                                                    <td><?= $c++ ?></td>
                                                    <td><?= $row['appl_no'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= esc(date('d-m-Y', strtotime($row['dob']))) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger dropdown-toggle px-1"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Action <i class="mdi mdi-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="<?= base_url('admin/update-documents/') . base64_encode($row['id']) ?>"
                                                                    class="dropdown-item">Update Documents</a>
                                                            </div>
                                                        </div>
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