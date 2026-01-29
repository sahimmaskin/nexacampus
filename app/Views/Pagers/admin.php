<?php
// ✅ DataTables-style pager (works on ALL CI4 versions)

$total       = $pager->getTotal();
$perPage     = $pager->getPerPage();

// backward-compatible helpers
$currentPage = method_exists($pager, 'getCurrentPageNumber')
    ? $pager->getCurrentPageNumber()
    : (property_exists($pager, 'currentPage') ? $pager->currentPage : 1);

$totalPages = method_exists($pager, 'getPageCount')
    ? $pager->getPageCount()
    : (property_exists($pager, 'pageCount') ? $pager->pageCount : 1);

// how many numeric buttons to show
$window = 3;
$start  = max(1, $currentPage - floor($window / 2));
$end    = min($totalPages, $start + $window - 1);
if ($end - $start + 1 < $window && $start > 1) {
    $start = max(1, $end - $window + 1);
}

if ($total == 0) {
    $start1 = 0;
    $end1   = 0;
} else {
    $start1 = (($currentPage - 1) * $perPage) + 1;
    $end1   = min($currentPage * $perPage, $total);

    // ✅ ensure start never exceeds end
    if ($start1 > $end1) {
        $start1 = $end1;
    }
}

// helper to build URL with correct page query
function buildPageUrl($page)
{
    $query = $_GET;
    $query['page'] = $page;
    return current_url() . '?' . http_build_query($query);
}
?>

<div class="row">
    <div class="col-sm-12 col-md-5">
  <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
    Showing <?= $start1 ?> to <?= $end1 ?> of <?= $total ?> entries
  </div>
</div>
    <div class="col-sm-12 col-md-7">
  <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
    <ul class="pagination" style="float:right;">

      <!-- Previous -->
      <?php if ($pager->hasPreviousPage()): ?>
        <li class="paginate_button page-item previous" id="example1_previous">
          <a href="<?= buildPageUrl($currentPage - 1) ?>" class="page-link">Previous</a>
        </li>
      <?php else: ?>
        <li class="paginate_button page-item previous disabled" id="example1_previous">
          <a href="#" class="page-link">Previous</a>
        </li>
      <?php endif; ?>

      <!-- Numeric page links -->
      <?php for ($i = $start; $i <= $end; $i++): ?>
        <li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
          <a href="<?= buildPageUrl($i) ?>" class="page-link"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <!-- Next -->
      <?php if ($pager->hasNextPage()): ?>
        <li class="paginate_button page-item next" id="example1_next">
          <a href="<?= buildPageUrl($currentPage + 1) ?>" class="page-link">Next</a>
        </li>
      <?php else: ?>
        <li class="paginate_button page-item next disabled" id="example1_next">
          <a href="#" class="page-link">Next</a>
        </li>
      <?php endif; ?>

    </ul>
  </div>
</div>
</div>