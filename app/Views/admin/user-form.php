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

                        <form method="post" class="row g-4" autocomplete="off" action="<?= base_url('admin/save-user') ?>">
                            <?= csrf_field() ?>

                            <input type="hidden" name="school_id" value="<?= session('schoolId'); ?>" />
                            <input type="hidden" name="trust_id" value="<?= session('trustId'); ?>" />

                            <input type="hidden" name="id" id="id" value="<?= $details['id'] ?? '' ?>">

                            <div class="col-md-6">
                                <label class="form-label">Designation</label>
                                <select name="user_type" id="user_type" class="form-control">
                                    <option value="" disabled <?= empty($this->data['details']['designation']) ? 'selected' : '' ?>>
                                        Choose Designation
                                    </option>
                                    <?php foreach ($departmentList as $value): ?>
                                        <option value="<?= $value['id']; ?>"
                                            <?= (!empty($details)
                                                && $this->data['details']['designation'] == $value['id'])
                                                ? 'selected' : ''; ?>>
                                            <?= $value['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php if (!empty($this->data['details']['name'])) {
                                                                                                                    echo $this->data['details']['name'];
                                                                                                                } ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number" onblur="chq_mobile();" value="<?php if (!empty($this->data['details']['mobile'])) {
                                                                                                                                                                        echo $this->data['details']['mobile'];
                                                                                                                                                                    } ?>">
                                <span class="text-danger" id="mobile_error"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email address" value="<?php if (!empty($this->data['details']['email'])) {
                                                                                                                                    echo $this->data['details']['email'];
                                                                                                                                } ?>">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address </label>
                                <input type="text" class="form-control" name="address" placeholder="House no, street, locality" value="<?php if (!empty($this->data['details']['address'])) {
                                                                                                                                            echo $this->data['details']['address'];
                                                                                                                                        } ?>">
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary" id="submit">
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
    function chq_mobile() {
        let mobile = $('#mobile').val();
        if (!mobile) {
            $('#mobile_error').text('Mobile is required').show();
            return;
        }
        $('#mobile_error').hide();
        $.ajax({
            url: "<?= base_url('check-user-mobile') ?>/" + mobile,
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.error === 'Yes') {
                    $("#mobile").focus();
                    $('#mobile_error').html(response.mess).fadeIn().fadeOut(6000);
                    return false;
                } else {
                    $('#mobile_error').hide();
                    return true;
                }
            },
            error: function() {
                alert('Unable to check mobile number. Please try again.');
            }
        });
    }
</script>

<?= $this->endSection() ?>