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

<div class="row align-items-center text-center text-md-start">
	<div class="col-12 col-md-5 mb-2 mb-md-0">
		<div class="dataTables_length" id="DataTables_Table_0_length">Showing <?= $start1 ?> to <?= $end1 ?> of <?= $total ?> entries</div>
		<!-- <div class="dataTables_length" id="DataTables_Table_0_length">
			<label>
				Row Per Page 
				<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select form-select-sm">
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select> 
				Entries
			</label>
		</div> -->
	</div>
	<div class="col-12 col-md-7">
		<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
			<ul class="pagination justify-content-md-end justify-content-center m-0">

				<!-- Previous -->
		      	<?php if ($pager->hasPreviousPage()): ?>
		        	<li class="paginate_button page-item previous" id="DataTables_Table_0_previous">
		          		<a href="<?= buildPageUrl($currentPage - 1) ?>" aria-controls="DataTables_Table_0" role="link" data-dt-idx="previous" tabindex="-1" class="page-link" > <i class="fa fa-angle-left"></i> </a>
		        	</li>
		      	<?php else: ?>
		        	<li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
		          		<a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">
							<i class="fa fa-angle-left"></i> 
						</a>
		        	</li>
		      	<?php endif; ?>

				<!-- Numeric page links -->
      			<?php for ($i = $start; $i <= $end; $i++): ?>
        			<li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
          				<a href="<?= buildPageUrl($i) ?>"aria-controls="DataTables_Table_0" role="link" <?php if($i == $currentPage) { ?> aria-current="page" <?php } ?> data-dt-idx="<?php echo $i-1; ?>" tabindex="0" class="page-link" ><?= $i ?></a>
        			</li>
      			<?php endfor; ?>

				<!-- Next -->
			    <?php if ($pager->hasNextPage()): ?>
			        <li class="paginate_button page-item next" id="example1_next">
			          	<a href="<?= buildPageUrl($currentPage + 1) ?>"  role="link" data-dt-idx="next" tabindex="0" class="page-link"> 
			          		<i class=" fa fa-angle-right"></i>
			          	</a>
			        </li>
			    <?php else: ?>
			        <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next">
			          	<a href="#" aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="next" tabindex="0" class="page-link"> <i class=" fa fa-angle-right"></i></a>
			        </li>
			    <?php endif; ?>
			</ul>
		</div>
	</div>
</div>