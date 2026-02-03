<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?? '' ?>
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

        <!-- Card 1 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
              <div class="me-3 d-flex align-items-center justify-content-center 
                  rounded-circle bg-light text-dark" style="width:48px;height:48px;">
                <i class="fa-solid fa-user-graduate fs-4"></i>
              </div>
              <div>
                <h6 class="card-title mb-1 text-muted">Total Students</h6>
                <h3 class="fw-bold mb-1">1,250</h3>
                
              </div>
            </div>
          </div>
        </div>


        <!-- Card 2 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
              <div class="me-3 d-flex align-items-center justify-content-center 
                  rounded-circle bg-light text-dark" style="width:48px;height:48px;">
                <i class="fa-solid fa-user-graduate fs-4"></i>
              </div>
              <div>
                <h6 class="card-title mb-1 text-muted">Today Attendance %</h6>
                <h3 class="fw-bold mb-1">1,250</h3>
               
              </div>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
              <div class="me-3 d-flex align-items-center justify-content-center 
                  rounded-circle bg-light text-dark" style="width:48px;height:48px;">
                <i class="fa-solid fa-user-graduate fs-4"></i>
              </div>
              <div>
                <h6 class="card-title mb-1 text-muted">Fee Collected / Due</h6>
                <h3 class="fw-bold mb-1">1,250</h3>
               
              </div>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
              <div class="me-3 d-flex align-items-center justify-content-center 
                  rounded-circle bg-light text-dark" style="width:48px;height:48px;">
                <i class="fa-solid fa-user-graduate fs-4"></i>
              </div>
              <div>
                <h6 class="card-title mb-1 text-muted">Upcoming Exams</h6>
                <h3 class="fw-bold mb-1">1,250</h3>
                
              </div>
            </div>
          </div>
        </div>
           <!-- Card 5 -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
              <div class="me-3 d-flex align-items-center justify-content-center 
                  rounded-circle bg-light text-dark" style="width:48px;height:48px;">
                <i class="fa-solid fa-user-graduate fs-4"></i>
              </div>
              <div>
                <h6 class="card-title mb-1 text-muted">Notifications</h6>
                <h3 class="fw-bold mb-1">1,250</h3>
               
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