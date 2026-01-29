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
                    <div class="sa-example__legend"><?= $title ?></div>
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
                        <form method="post" action="<?= base_url('admin/save-attendance') ?>" id="attendance_form">
                            <?= csrf_field() ?>
                            <input type="hidden" name="trust_id" value="<?= session('trustId') ?>">
                            <input type="hidden" name="school_id" value="<?= session('schoolId') ?>">
                            <div class="row g-4">
                                <h6 class="mt-2">Student Attendance</h6>

                                <div class="col-md-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Session</label>
                                    <select name="session" id="session" class="form-control" onchange="get_student()">
                                        <option value="">Select Session</option>
                                        <?php foreach ($sessionList as $row): ?>
                                            <option value="<?= $row['id'] ?>"><?= esc($row['name']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Class</label>
                                    <select name="class" id="class_id" class="form-control" onchange="get_section()">
                                        <option value="">Select Class</option>
                                        <?php foreach ($classList as $row): ?>
                                            <option value="<?= $row['id'] ?>"><?= esc($row['name']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Section</label>
                                    <select name="section" id="section" class="form-control" onchange="get_student()">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div id="student_list"></div>

                            <div class="text-end mt-4" id="submit_btn" style="display:none;">
                                <button type="submit" class="btn btn-primary px-4">
                                    Save Attendance
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
    function get_section() {
        let class_id = $('#class_id').val();
        $('#section').html('<option value="">Select Section</option>');
        $('#student_list').html('');
        $('#submit_btn').hide();

        if (class_id == '') return;

        $.ajax({
            url: "<?= base_url('get-section') ?>/" + class_id,
            type: "GET",
            dataType: "json",
            success: function(response) {

                let options = '<option value="">Select Section</option>';
                $.each(response, function(index, value) {
                    options += '<option value="' + value.id + '">' + value.name + '</option>';
                });

                $('#section').html(options);
            }
        });
    }

    function get_student() {

        let class_id = $('#class_id').val();
        let session_id = $('#session').val();
        let section_id = $('#section').val();

        if (class_id == '' || session_id == '' || section_id == '') {
            $('#student_list').html(
                '<div class="alert alert-info">Please select Class, Session and Section.</div>'
            );
            $('#submit_btn').hide();
            return;
        }

        $('#att_session').val(session_id);
        $('#att_class').val(class_id);
        $('#att_section').val(section_id);

        let url = "<?= base_url('get-student') ?>/" + class_id + "/" + session_id + "/" + section_id;

        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(response) {

                let html = '';

                if (response.length === 0) {

                    html = '<div class="alert alert-warning">No students found.</div>';
                    $('#submit_btn').hide();

                } else {

                    $.each(response, function(index, student) {

                        html += '<div class="card mb-3">';
                        html += '<div class="card-body">';
                        html += '<div class="row align-items-center">';

                        html += '<div class="col-12 col-md-4 mb-2 mb-md-0">';
                        html += '<strong>' + student.name + '</strong><br>';
                        html += '</div>';

                        html += '<div class="col-12 col-md-8 text-md-end">';
                        html += '<label class="me-3 d-inline-block">';
                        html += '<input type="radio" name="attendance[' + student.id + ']" value="Present" required> Present';
                        html += '</label>';
                        html += '<label class="me-3 d-inline-block">';
                        html += '<input type="radio" name="attendance[' + student.id + ']" value="Late"> Late';
                        html += '</label>';
                        html += '<label class="d-inline-block">';
                        html += '<input type="radio" name="attendance[' + student.id + ']" value="Absent"> Absent';
                        html += '</label>';
                        html += '</div>';

                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });

                    $('#submit_btn').show();
                }

                $('#student_list').html(html);
            }
        });
    }
</script>

<?= $this->endSection() ?>