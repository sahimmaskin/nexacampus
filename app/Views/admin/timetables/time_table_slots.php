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
                    <h1 class="h3 m-0">
                        <?= esc($title) ?>
                    </h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#periodModal"
                        data-session="{}">
                        Add Time Slot
                    </button>
                </div>
                <div class="modal fade" id="periodModal" tabindex="-1">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <form method="post" action="<?= route_to('saveTimeTable') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id">

                                <div class="modal-header">
                                    <h5 class="modal-title">Add Time Slot </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">

                                    <div class="row">
                                       
                                   
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                Period <span class="text-danger">*</span>
                                            </label>

                                            <select name="period_id" class="form-control" required>
                                                <option value="">Select Period</option>
                                                <?php foreach ($periods as $period): ?>
                                                <option value="<?= $period['id'] ?>">
                                                    <?= esc(date('h:i A', strtotime($period['start_time']))) ?>
                                                    -
                                                    <?= esc(date('h:i A', strtotime($period['end_time']))) ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Day <span class="text-danger">*</span></label>
                                            <select name="day" class="form-control" required>
                                                <option value="">Select Day</option>
                                                <option value="mon">Monday</option>
                                                <option value="tue">Tuesday</option>
                                                <option value="wed">Wednesday</option>
                                                <option value="thu">Thursday</option>
                                                <option value="fri">Friday</option>
                                                <option value="sat">Saturday</option>
                                            </select>
                                        </div>
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
                    <div class="sa-example__legend">
                        <?= $title ?>
                    </div>
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
                                <li>
                                    <?= esc($error) ?>
                                </li>
                                <?php endforeach ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                <table class="table table-bordered mb-0 text-center" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Class </th>
                                            <th>Section</th>
                                            <th>Day</th>
                                            <th>Period Time</th>

                                            <th style="width:10vw;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($lists)) : ?>
                                        <?php $c = 1; ?>
                                        <?php foreach ($lists as $row): ?>
                                        <tr>
                                            <td>
                                                <?= $c++ ?>
                                            </td>
                                            <td>
                                                <?= esc($classMap[$row['class_id']] ?? '-') ?>
                                            </td>
                                            <td>
                                                <?= esc($sectionMap[$row['section_id']] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?= esc($row['day']) ?>
                                            </td>
                                            <td>
                                                <?= esc(date('h:i A', strtotime($row['start_time']))) ?> -
                                                <?= esc(date('h:i A', strtotime($row['end_time']))) ?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-outline-primary text-dark"
                                                    data-bs-toggle="modal" data-bs-target="#periodModal"
                                                    data-session='<?= esc(json_encode($row)) ?>' title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a href="<?= route_to('deletePeriod', $row['id']) ?>"
                                                    class="btn btn-sm btn-outline-danger btn-delete" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>

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
    const modal = document.getElementById('periodModal');
    const form = modal.querySelector('form');

    modal.addEventListener('show.bs.modal', function (e) {
        const data = JSON.parse(e.relatedTarget.dataset.session || '{}');

        form.reset();

        modal.querySelector('.modal-title').textContent =
            data.id ? 'Edit Time Slot' : 'Add Time Slot';

        Object.keys(data).forEach(key => {
            if (form.elements[key]) {
                form.elements[key].value = data[key];
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const url = this.getAttribute('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This period will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });

    });
</script>


<?= $this->endSection() ?>