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
                    <div class="sa-example__legend"></div>
                    <div class="sa-example__body">
                        <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li>
                                    <?= esc($error) ?>
                                </li>
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
                        <form method="post" enctype="multipart/form-data" class="row g-4"
                            action="<?= base_url('admin/save-student') ?>">
                            <?= csrf_field() ?>
                            <div class="col-md-6">
                                <label class="form-label">Trust Name</label>
                                <input type="text" name="trust_name" class="form-control"
                                    value="<?= esc($details['trust_name'] ?? '') ?>" placeholder=" Trust Name">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">School Name</label>
                                <input type="text" name="school_name" class="form-control"
                                    value="<?= esc($details['school_name'] ?? '') ?>" placeholder="School Name ">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">UserName</label>
                                <input type="text" name="username" class="form-control"
                                    value="<?= esc($details['username'] ?? '') ?>" placeholder="Enter Username ">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control"
                                    value="<?= esc($details['email'] ?? '') ?>" placeholder="Enter Email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control"
                                    value="<?= esc($details['mobile'] ?? '') ?>" placeholder="Mobile Number">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address 1</label>
                                <input type="text" name="address_1" class="form-control"
                                    value="<?= esc($details['address_1'] ?? '') ?>" placeholder="Enter Address 1">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address 2</label>
                                <input type="text" name="address_2" class="form-control"
                                    value="<?= esc($details['address_2'] ?? '') ?>" placeholder="Enter Address 2">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="">... Choose ...</option>
                                    <option value="Active" <?=($details['status'] ?? '' )=='Active' ? 'selected' : '' ?>
                                        >Active</option>
                                    <option value="Inactive" <?=($details['status'] ?? '' )=='Inactive' ? 'selected'
                                        : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">School Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alternate Phone Number</label>
                                <input type="text" name="alternate_phone" class="form-control"
                                    value="<?= esc($details['alternate_phone'] ?? '') ?>"
                                    placeholder="Alternate Mobile Number">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Board</label>
                                <input type="text" name="board" class="form-control"
                                    value="<?= esc($details['board'] ?? '') ?>" placeholder="Enter Board">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Affiliation No</label>
                                <input type="text" name="affiliation_no" class="form-control"
                                    value="<?= esc($details['affiliation_no'] ?? '') ?>"
                                    placeholder=" Enter Affiliation No">
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
            success: function (response) {
                let options = '<option value="">Select District</option>';
                $.each(response, function (index, value) {
                    options += `<option value="${value.id}">${value.district}</option>`;
                });
                $('#' + districtSelectId).html(options);
            },
            error: function () {
                alert('Unable to load districts');
            }
        });
    }
</script>


<?= $this->endSection() ?>