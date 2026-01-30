<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?? '' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="top" class="sa-app__body px-2 px-lg-4">
  <div class="container pb-6">
    <div class="py-5">
      <div class="row g-4 align-items-center">
        <div class="col">
          <h1 class="h3 m-0"><?= $title ?></h1>
          <?= print_r($_SESSION) ?>
          <br>
          <?= print_r($plans) ?>
        </div>
      </div>
    </div>

  </div>
</div>
<?= $this->endSection() ?>