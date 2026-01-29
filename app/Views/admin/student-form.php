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
                        <form method="post" enctype="multipart/form-data" class="row g-4" action="<?= base_url('admin/save-student') ?>">
                            <?= csrf_field() ?>

                            <input type="hidden" name="id" value="<?= $details['id'] ?? '' ?>">
                            <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">
                            <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">

                            <h6 class="mt-2">Student Details</h6>
                            <hr>

                            <div class="col-md-4">
                                <label class="form-label">Application Number</label>
                                <input type="text" name="appl_no" class="form-control"
                                    value="<?= $formatNumber['format_prefix'] . $formatNumber['format_number'] . $formatNumber['format_suffix'] ?? '' ?>" readonly>
                                    <input type="hidden" name="format_type" value="<?= $formatNumber['format_type'] ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Session</label>
                                <select name="session" class="form-control">
                                    <option selected disabled>Select Session</option>
                                    <?php foreach ($sessionList as $row): ?>
                                        <option value="<?= $row['id'] ?>"
                                            <?= (!empty($details) && $details['session'] == $row['id']) ? 'selected' : '' ?>>
                                            <?= esc($row['name']) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Class</label>
                                <select name="class" class="form-control">
                                    <option selected disabled>Select Class</option>
                                    <?php foreach ($classList as $row): ?>
                                        <option value="<?= $row['id'] ?>"
                                            <?= (!empty($details) && $details['class'] == $row['id']) ? 'selected' : '' ?>>
                                            <?= esc($row['name']) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

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
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control">
                                    <option selected disabled>Select Gender</option>
                                    <?php foreach (['Male', 'Female', 'Others'] as $g): ?>
                                        <option value="<?= $g ?>"
                                            <?= (!empty($details) && $details['gender'] == $g) ? 'selected' : '' ?>>
                                            <?= $g ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control"
                                    value="<?= esc($details['dob'] ?? '') ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Blood Group</label>
                                <select name="blood_group" class="form-control">
                                    <option selected disabled>Select Blood Group</option>
                                    <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $g): ?>
                                        <option value="<?= $g ?>"
                                            <?= (!empty($details) && $details['blood_group'] == $g) ? 'selected' : '' ?>>
                                            <?= $g ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Religion</label>
                                <input type="text" name="religion" class="form-control"
                                    value="<?= esc($details['religion'] ?? '') ?>" placeholder="Religion">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Nationality</label>
                                <input type="text" name="nationality" class="form-control"
                                    value="<?= esc($details['nationality'] ?? '') ?>" placeholder="Nationality">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Aadhar No.</label>
                                <input type="text" name="aadhar" class="form-control"
                                    value="<?= esc($details['aadhar'] ?? '') ?>" placeholder="Aadhar Number">
                            </div>

                            <br>
                            <h6 class="mt-4">Parent Details</h6>
                            <hr>

                            <div class="col-md-6">
                                <label class="form-label">Father Name</label>
                                <input type="text" name="f_name" class="form-control"
                                    value="<?= esc($details['f_name'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Name</label>
                                <input type="text" name="m_name" class="form-control"
                                    value="<?= esc($details['m_name'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Father Mobile</label>
                                <input type="text" name="f_mobile" class="form-control"
                                    value="<?= esc($details['f_mobile'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Mobile</label>
                                <input type="text" name="m_mobile" class="form-control"
                                    value="<?= esc($details['m_mobile'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Father Occupation</label>
                                <input type="text" name="f_occupation" class="form-control"
                                    value="<?= esc($details['f_occupation'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Occupation</label>
                                <input type="text" name="m_occupation" class="form-control"
                                    value="<?= esc($details['m_occupation'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Father Income</label>
                                <input type="text" name="f_income" class="form-control"
                                    value="<?= esc($details['f_income'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Income</label>
                                <input type="text" name="m_income" class="form-control"
                                    value="<?= esc($details['m_income'] ?? '') ?>">
                            </div>


                            <h6 class="mt-4">Address Details</h6>
                            <hr>
                            <h6 class="text-muted">Present Address</h6>
                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <textarea name="present_address" class="form-control" rows="2"><?= esc($details['present_address'] ?? '') ?></textarea>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Present State</label>
                                <select name="present_state" id="present_state" class="form-control" onchange="get_district(this.value, 'present_district')">
                                    <option selected disabled>Select State</option>
                                    <?php foreach ($stateList as $row): ?>
                                        <option value="<?= $row['id'] ?>"
                                            <?= (!empty($details) && $details['present_state'] == $row['id']) ? 'selected' : '' ?>>
                                            <?= esc($row['state']) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <span class="text-danger" id="state_error"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">District</label>
                                <select name="present_district" id="present_district" class="form-control">
                                    <option selected disabled>Select District</option>
                                </select>
                                <span class="text-danger" id="district_error"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Village / Town / City</label>
                                <input type="text" name="present_village" class="form-control"
                                    value="<?= esc($details['present_village'] ?? '') ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Post Office (P.O.)</label>
                                <input type="text" name="present_po" class="form-control"
                                    value="<?= esc($details['present_po'] ?? '') ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">PIN Code</label>
                                <input type="text" name="present_pincode" class="form-control"
                                    value="<?= esc($details['present_pincode'] ?? '') ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Police Station</label>
                                <input type="text" name="present_ps" class="form-control"
                                    value="<?= esc($details['present_ps'] ?? '') ?>">
                            </div>

                            <hr class="my-3">

                            <h6 class="text-muted">Permanent Address</h6>
                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <textarea name="permanent_address" class="form-control" rows="2"><?= esc($details['permanent_address'] ?? '') ?></textarea>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Permanent State</label>
                                <select name="permanent_state"
                                    id="permanent_state"
                                    class="form-control"
                                    onchange="get_district(this.value, 'permanent_district')">
                                    <option value="">Select State</option>
                                    <?php foreach ($stateList as $row): ?>
                                        <option value="<?= $row['id'] ?>"
                                            <?= (!empty($details) && $details['permanent_state'] == $row['id']) ? 'selected' : '' ?>>
                                            <?= esc($row['state']) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">District</label>
                                <select name="permanent_district" id="permanent_district" class="form-control">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Village / Town / City</label>
                                <input type="text" name="permanent_village" class="form-control"
                                    value="<?= esc($details['permanent_village'] ?? '') ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Post Office (P.O.)</label>
                                <input type="text" name="permanent_po" class="form-control"
                                    value="<?= esc($details['permanent_po'] ?? '') ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">PIN Code</label>
                                <input type="text" name="permanent_pincode" class="form-control"
                                    value="<?= esc($details['permanent_pincode'] ?? '') ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Police Station</label>
                                <input type="text" name="permanent_ps" class="form-control"
                                    value="<?= esc($details['permanent_ps'] ?? '') ?>">
                            </div>

                            <h6 class="mt-4">Previous School Details</h6>
                            <hr>

                            <div class="col-md-6">
                                <label class="form-label">Previous School Name</label>
                                <input type="text" name="prev_school_name" class="form-control"
                                    value="<?= esc($details['prev_school_name'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Previous Class</label>
                                <input type="text" name="prev_class" class="form-control"
                                    value="<?= esc($details['prev_class'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Board / Medium</label>
                                <input type="text" name="prev_board" class="form-control"
                                    value="<?= esc($details['prev_board'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Year of Passing</label>
                                <input type="text" name="prev_passing_year" class="form-control"
                                    value="<?= esc($details['prev_passing_year'] ?? '') ?>">
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