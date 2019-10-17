<section class="wrapper">

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	            	<?php $uri1 = $this->uri->segment(1); ?>
                    <a class="btn btn-success btn-sm" href="<?= site_url($uri1.'/add') ?>"><i class="fa fa-plus"></i> New Photo</a>
	                <span class="tools pull-right">
	                    <a href="javascript:;" class="fa fa-chevron-down"></a>
	                    <a href="javascript:;" class="fa fa-times"></a>
	                 </span>
	            </header>
                <div class="panel-body">
                <div class="adv-table">
	                <table  class="display table table-bordered table-striped" id="dynamic-table">
	                <thead>
		                <tr>
		                    <th>Action</th>
		                	<th></th>
		                	<th></th>
		                	<th></th>
		                    <th>Date</th>
		                    <th>Photo Title</th>
		                    <th class="hidden-xs">Photo</th>
		                    <th class="hidden-xs">Credit</th>
		                    <th class="hidden-xs">Photographer</th>
		                    <th class="hidden-xs">status</th>
		                </tr>
	                </thead>
	                <tbody>
		                <tr class="gradeX">
		                </tr>
	                </tbody>
	                <tfoot>
		                <tr>
		                    <th>Action</th>
		                	<th></th>
		                	<th></th>
		                	<th></th>
		                    <th>Date</th>
		                    <th>Photo Title</th>
		                    <th class="hidden-xs">Photo</th>
		                    <th class="hidden-xs">Credit</th>
		                    <th class="hidden-xs">Photographer</th>
		                    <th class="hidden-xs">status</th>
		                </tr>
		                </tr>
	                </tfoot>
	                </table>
                </div>
                </div>
	        </section>
	    </div>
	</div>

</section>