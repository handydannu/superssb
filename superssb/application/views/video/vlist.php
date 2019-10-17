<section class="wrapper">

	<div class="row">
        <div class="col-md-12">
            <ul class="breadcrumbs-alt">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                </li>
                <li>
                    <a class="current" href="javascript:;"><?php echo strtoupper($PAGE_TITLE); ?></a>
                </li>
            </ul>
        </div>
    </div>

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	            	<?php $uri1 = $this->uri->segment(1); // article or my_article ?>
                    <a class="btn btn-success btn-sm" href="<?= site_url($uri1.'/add') ?>"><i class="fa fa-plus"></i> New Video</a>
	                <span class="tools pull-right">
	                    <a href="javascript:;" class="fa fa-chevron-down"></a>
	                    <a href="javascript:;" class="fa fa-times"></a>
	                 </span>
	            </header>
                <div class="panel-body">
                <div class="adv-table">
	                <table  class="display table table-bordered table-striped" id="dynamic_table" width="100%">
	                <thead>
		                <tr>
		                    <th></th>
		                    <th>Action</th>
		                    <th>Date</th>
		                    <th>Title</th>
		                    <th>Hits</th>
		                    <th>Status</th>
		                    <th>Image</th>
		                    <th>Channel</th>
		                    <th class="hidden-phone">Feature</th>
		                    <th class="hidden-phone">Author</th>
		                </tr>
	                </thead>
	                <tbody>
		                <tr class="gradeX">
		                </tr>
	                </tbody>
	                <tfoot>
		                <tr>
		                    <th></th>
		                    <th>Action</th>
		                    <th>Date</th>
		                    <th>Title</th>
		                    <th>Hits</th>
		                    <th>Status</th>
		                    <th>Image</th>
		                    <th>Channel</th>
		                    <th class="hidden-phone">Feature</th>
		                    <th class="hidden-phone">Author</th>
		                </tr>
	                </tfoot>
	                </table>
                </div>
                </div>
	        </section>
	    </div>
	</div>

</section>