<h6 class="mt-4">Documents Upload</h6>
<hr>

<div class="col-md-4">
    <label class="form-label">Passport Size Photo</label>
    <input type="file" name="student_photo" class="form-control">
    <?php if (!empty($details['student_photo'])): ?>
        <small class="text-success">Uploaded</small>
    <?php endif; ?>
</div>

<div class="col-md-4">
    <label class="form-label">Birth Certificate</label>
    <input type="file" name="birth_certificate" class="form-control">
    <?php if (!empty($details['birth_certificate'])): ?>
        <small class="text-success">Uploaded</small>
    <?php endif; ?>
</div>

<div class="col-md-4">
    <label class="form-label">Aadhar Card</label>
    <input type="file" name="aadhar_card" class="form-control">
    <?php if (!empty($details['aadhar_card'])): ?>
        <small class="text-success">Uploaded</small>
    <?php endif; ?>
</div>

<div class="col-md-4">
    <label class="form-label">Caste Certificate (if any)</label>
    <input type="file" name="caste_certificate" class="form-control">
    <?php if (!empty($details['caste_certificate'])): ?>
        <small class="text-success">Uploaded</small>
    <?php endif; ?>
</div>

<div class="col-md-4">
    <label class="form-label">Previous School TC</label>
    <input type="file" name="transfer_certificate" class="form-control">
    <?php if (!empty($details['transfer_certificate'])): ?>
        <small class="text-success">Uploaded</small>
    <?php endif; ?>
</div>

<div class="col-md-4">
    <label class="form-label">Marksheet (Last Exam)</label>
    <input type="file" name="marksheet" class="form-control">
    <?php if (!empty($details['marksheet'])): ?>
        <small class="text-success">Uploaded</small>
    <?php endif; ?>
</div>

<div class="col-md-4">
    <label class="form-label">Other Document</label>
    <input type="file" name="other_document" class="form-control">
    <?php if (!empty($details['other_document'])): ?>
        <small class="text-success">Uploaded</small>
    <?php endif; ?>
</div>