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
                                            <th>Document Name</th>
                                            <th>Doc No.</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($details)) : ?>
                                            <?php $c = 1;
                                            foreach ($details as $row):

                                                $hasDoc = !empty($row['user_doc_id']);

                                                $allowUpload = !$hasDoc
                                                    || in_array($row['user_doc_status'], ['Rejected', 'Incomplete']);
                                            ?>
                                                <tr>
                                                    <td><?= $c++ ?></td>

                                                    <td><?= esc($row['doc_name']) ?></td>

                                                    <td>
                                                        <?= ($hasDoc && $row['no_reqd'] === 'Yes')
                                                            ? esc($row['doc_no'])
                                                            : '---' ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($hasDoc): ?>
                                                            <span class="badge bg-<?= $row['user_doc_status'] === 'Approved' ? 'success' : 'warning' ?>">
                                                                <?= esc($row['user_doc_status']) ?>
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger">Not Submitted</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td>
                                                        <a class="badge bg-warning text-white"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#uploadModal<?= $row['id'] ?>">
                                                            Upload
                                                        </a>
                                                        <?php if ($hasDoc): ?>
                                                            <a class="badge bg-info text-white"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewModal<?= $row['id'] ?>">
                                                                View
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No Data Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <?php if (!empty($details)) : ?>
                                    <div class="mt-3">
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

<?php foreach ($details as $doc): ?>
    <div class="modal fade" id="uploadModal<?= $doc['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" enctype="multipart/form-data"
                action="<?= base_url('admin/save-documents') ?>">
                <?= csrf_field() ?>

                <input type="hidden" name="doc_id" value="<?= $doc['id'] ?>">
                <input type="hidden" name="student_id" value="<?= base64_decode($encodedId) ?>">
                <input type="hidden" name="user_type" value="Student">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= esc($doc['doc_name']) ?></h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <?php if ($doc['no_reqd'] === 'Yes'): ?>
                            <div class="mb-3">
                                <label>Doc Number *</label>
                                <input type="text"
                                    name="doc_no"
                                    class="form-control"
                                    pattern="<?= esc($doc['doc_char']) ?>"
                                    required
                                    value="<?= esc($doc['doc_no'] ?? '') ?>">
                            </div>
                        <?php endif; ?>

                        <?php if ($doc['file_front_reqd'] === 'Yes'): ?>
                            <div class="mb-3">
                                <label>Doc File (Front) *</label>
                                <input type="file"
                                    name="doc_front"
                                    class="form-control"
                                    accept="<?= esc($doc['file_type']) ?>">
                            </div>
                        <?php endif; ?>

                        <?php if ($doc['file_back_reqd'] === 'Yes'): ?>
                            <div class="mb-3">
                                <label>Doc File (Back) *</label>
                                <input type="file"
                                    name="doc_back"
                                    class="form-control"
                                    accept="<?= esc($doc['file_type']) ?>">
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Submit</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($details as $doc):
    if (empty($doc['user_doc_id'])) continue;
?>
    <div class="modal fade" id="viewModal<?= $doc['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= esc($doc['doc_name']) ?></h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <?php if ($doc['no_reqd'] === 'Yes'): ?>
                        <p><strong>Doc Number:</strong> <?= esc($doc['doc_no']) ?></p>
                    <?php endif; ?>

                    <?php if (!empty($doc['doc_front'])): ?>
                        <a href="<?= base_url('uploads/user_docs/' . $doc['doc_front']) ?>"
                            target="_blank" class="badge bg-info">View Front</a>
                    <?php endif; ?>

                    <?php if (!empty($doc['doc_back'])): ?>
                        <a href="<?= base_url('uploads/user_docs/' . $doc['doc_back']) ?>"
                            target="_blank" class="badge bg-info">View Back</a>
                    <?php endif; ?>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?= $this->endSection() ?>