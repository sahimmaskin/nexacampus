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
                                            <th>Name</th>
                                            <th>Format</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($formats)) : ?>
                                            <?php $c = 1; ?>
                                            <?php foreach ($formats as $row): ?>
                                                <tr>
                                                    <td><?= $c++ ?></td>
                                                    <td><?= esc($row['name']) ?></td>
                                                    <td>
                                                        <?php
                                                        echo !empty($row['format_prefix']) ? esc($row['format_prefix']) : '';
                                                        echo !empty($row['format_number']) ? esc($row['format_number']) : '';
                                                        echo !empty($row['format_suffix']) ? esc($row['format_suffix']) : '';
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formatModal<?= $row['format_type_id'] ?>"> <i class="fa fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade"
                                                    id="formatModal<?= $row['format_type_id'] ?>"
                                                    tabindex="-1"
                                                    aria-hidden="true">

                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <form method="post" action="<?= base_url('admin/format-update') ?>">
                                                                <?= csrf_field() ?>
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        Edit Format - <?= esc($row['name']) ?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">
                                                                    <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">
                                                                    <input type="hidden" name="format_type_id" value="<?= $row['format_type_id'] ?>">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Format Prefix</label>
                                                                        <input type="text"
                                                                            name="format_prefix"
                                                                            class="form-control"
                                                                            value="<?= esc($row['format_prefix'] ?? '') ?>"
                                                                            placeholder="Prefix">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Format Number</label>
                                                                        <input type="text"
                                                                            name="format_number"
                                                                            class="form-control"
                                                                            value="<?= esc($row['format_number'] ?? '') ?>"
                                                                            placeholder="Number">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Format Suffix</label>
                                                                        <input type="text"
                                                                            name="format_suffix"
                                                                            class="form-control"
                                                                            value="<?= esc($row['format_suffix'] ?? '') ?>"
                                                                            placeholder="Suffix">
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light"
                                                                        data-bs-dismiss="modal">
                                                                        Cancel
                                                                    </button>

                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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

                                <?php if (!empty($lists)) : ?>
                                    <div class="mt-4">
                                        <?= $pager->links('default', 'admin'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('layouts/table'); ?>
</div>

<?= $this->endSection() ?>