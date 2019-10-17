<section class="wrapper">
	<div class="row">
        <div class="col-md-12">
            <ul class="breadcrumbs-alt">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                </li>
                <li>
                    <a class="active-trail active" href="javascript:;"><strong><?php echo strtoupper($this->uri->segment(1)) ?></strong></a>
                </li>
            </ul>
        </div>
    </div>

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
                    <a class="btn btn-success btn-sm" href="<?= site_url($this->uri->segment(1).'/add') ?>"><i class="fa fa-plus"></i> New <?php echo ucwords($this->uri->segment(1)); ?></a>
	                <span class="tools pull-right">
	                    <a href="javascript:;" class="fa fa-chevron-down"></a>
	                    <a href="javascript:;" class="fa fa-times"></a>
	                 </span>
	            </header>
                <div class="panel-body">
                <div class="adv-table">
	                <table  class="display table table-bordered table-striped" id="dynamic_table">
	                <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>Action</th>
		                    <th>Name</th>
		                    <th>Address</th>
		                    <th class="hidden-xs">City</th>
		                    <th class="hidden-xs">Province</th>
		                    <th class="hidden-xs">Telp</th>
		                    <th class="hidden-xs">Fax</th>
		                    <th class="hidden-xs">Email</th>
		                    <th class="hidden-xs">Market Area</th>
		                    <th class="hidden-xs">Status</th>
		                </tr>
	                </thead>
	                <tbody>
		                <tr class="gradeX">
		                </tr>
	                </tbody>
	                <tfoot>
		                <tr>
		                    <th>ID</th>
		                    <th>Action</th>
		                    <th>Name</th>
		                    <th>Address</th>
		                    <th class="hidden-xs">City</th>
		                    <th class="hidden-xs">Province</th>
		                    <th class="hidden-xs">Telp</th>
		                    <th class="hidden-xs">Fax</th>
		                    <th class="hidden-xs">Email</th>
		                    <th class="hidden-xs">Market</th>
		                    <th class="hidden-xs">Status</th>
		                </tr>
	                </tfoot>
	                </table>
                </div>
                </div>
	        </section>
	    </div>
	</div>

</section>