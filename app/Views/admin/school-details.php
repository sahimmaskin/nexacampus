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
                    <div class="sa-example__legend"><?= esc($title) ?></div>
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
                        <form method="post" enctype="multipart/form-data" class="row g-4" action="<?= base_url('admin/save-student') ?>">
                            <?= csrf_field() ?>

                            <input type="hidden" name="id" value="<?= $details['id'] ?? '' ?>">
                            <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">
                            <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">

                            <div class="col-md-6">
                                <label class="form-label">Student Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="<?= esc($details['name'] ?? '') ?>" placeholder="Name">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control"
                                    value="<?= esc($details['mobile'] ?? '') ?>" placeholder="Mobile Number">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control"
                                    value="<?= esc($details['dob'] ?? '') ?>">
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    Submit
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
    function get_district(stateId, districtSelectId) {
        if (!stateId) {
            $('#state_error').text('State is required').show();
            return;
        }
        $('#state_error').hide();
        $.ajax({
            url: "<?= base_url('get-district') ?>/" + stateId,
            type: "GET",
            dataType: "json",
            success: function(response) {
                let options = '<option value="">Select District</option>';
                $.each(response, function(index, value) {
                    options += `<option value="${value.id}">${value.district}</option>`;
                });
                $('#' + districtSelectId).html(options);
            },
            error: function() {
                alert('Unable to load districts');
            }
        });
    }
</script>


<?= $this->endSection() ?>