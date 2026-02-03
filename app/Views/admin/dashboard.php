<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?? '' ?>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<style>
  .stat-card {
    background: linear-gradient(135deg, #ffffff, #f8f9ff);
    border-radius: 16px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
  }

  .stat-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(180deg, #4f46e5, #06b6d4);
  }

  .stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(79, 70, 229, 0.25);
  }

  .btn-soft-primary {
    background: rgba(13, 110, 253, 0.08);
    color: #0d6efd;
    border: 1px solid rgba(13, 110, 253, 0.25);
    border-radius: 999px;
    padding: 6px 14px;
    font-weight: 500;
    transition: all 0.25s ease;
  }

  .btn-soft-primary:hover {
    background: #0d6efd;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.35);
  }
</style>

<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div id="top" class="sa-app__body px-2 px-lg-4">
  <div class="container pb-6">
    <div class="py-5">

      <h1 class="h3 m-0 mb-4">
        <?= $title ?>
      </h1>

      <!-- Cards Row -->
      <div class="row g-4">
        <div class="d-flex align-items-center flex-wrap gap-2">

          <span class="fw-semibold text-muted me-2">
            Quick Actions →
          </span>

          <a href="<?= base_url('admin/add-student') ?>" class="btn btn-sm btn-soft-primary">
            <i class="fa-solid fa-user-plus me-1"></i> Add Student
          </a>

          <a href="<?= base_url('admin/add-teacher') ?>" class="btn btn-sm btn-soft-primary">
            <i class="fa-solid fa-chalkboard-user me-1"></i> Add Teacher
          </a>

          <a href="<?= base_url('admin/create-fee') ?>" class="btn btn-sm btn-soft-primary">
            <i class="fa-solid fa-indian-rupee-sign me-1"></i> Create Fee
          </a>

          <a href="<?= base_url('admin/send-notice') ?>" class="btn btn-sm btn-soft-primary">
            <i class="fa-solid fa-bullhorn me-1"></i> Send Notice
          </a>

        </div>



        <!-- Card 1 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="stat-card h-100">
            <div class="card-body d-flex align-items-center">

              <div class="me-3 d-flex align-items-center justify-content-center
           rounded-circle bg-primary bg-opacity-10 text-primary" style="width:52px;height:52px;">
                <i class="fa-solid fa-user-graduate fs-4"></i>
              </div>

              <div>
                <h6 class="card-title mb-1 text-muted">Total Students</h6>
                <h3 class="fw-bold mb-0">1,250</h3>
              </div>

            </div>
          </div>
        </div>


        <!-- Card 2 -->

        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="stat-card h-100">
            <div class="card-body d-flex align-items-center">

              <div class="me-3 d-flex align-items-center justify-content-center
           rounded-circle bg-primary bg-opacity-10 text-primary" style="width:52px;height:52px;">
                <i class="fa-solid fa-user-check fs-4"></i>
              </div>

              <div>
                <h6 class="card-title mb-1 text-muted">Today Attendance</h6>
                <h3 class="fw-bold mb-0">1,250</h3>
              </div>

            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="stat-card h-100">
            <div class="card-body d-flex align-items-center">

              <div class="me-3 d-flex align-items-center justify-content-center
           rounded-circle bg-primary bg-opacity-10 text-primary" style="width:52px;height:52px;">
                <i class="fa-solid fa-calendar-check fs-4"></i>
              </div>

              <div>
                <h6 class="card-title mb-1 text-muted">Upcoming Exams</h6>
                <h3 class="fw-bold mb-0">1,250</h3>
              </div>

            </div>
          </div>
        </div>
        <!-- Card 5 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="stat-card h-100">
            <div class="card-body d-flex align-items-center">
              <div class="me-3 d-flex align-items-center justify-content-center
           rounded-circle bg-primary bg-opacity-10 text-primary" style="width:52px;height:52px;">
                <i class="fa-solid fa-bell fs-4"></i>

              </div>

              <div>
                <h6 class="card-title mb-1 text-muted">Notifications</h6>
                <h3 class="fw-bold mb-0">1,250</h3>
              </div>

            </div>
          </div>
        </div>
        <!-- card 6  -->
        <!-- Card 3 -->

        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="stat-card h-100">
            <div class="card-body d-flex align-items-center">

              <div class="me-3 d-flex align-items-center justify-content-center
           rounded-circle bg-primary bg-opacity-10 text-primary" style="width:52px;height:52px;">
                <i class="fa-solid fa-indian-rupee-sign fs-4"></i>
              </div>

              <div>
                <h6 class="card-title mb-1 text-muted">Fee Collected / Due</h6>
                <h3 class="fw-bold mb-0">1,250</h3>
              </div>

            </div>
          </div>
        </div>


      </div>
      <!-- End Cards Row -->

    </div>
  </div>
</div>

<?= $this->endSection() ?>