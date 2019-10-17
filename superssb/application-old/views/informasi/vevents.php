<section class="wrapper">

	<div class="row">
        <div class="col-md-12">
            <ul class="breadcrumbs-alt">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                </li>
                <li>
                    <a class="current" href="javascript:;">Agenda Kegiatan</a>
                </li>
            </ul>
        </div>
    </div>

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
                    <a class="btn btn-success btn-sm" href="<?= site_url('events/add') ?>"><i class="fa fa-plus"></i> New Event</a>
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
		                    <th>Title</th>
		                    <th>Start Date</th>
		                    <th>Start Time</th>
		                    <th class="hidden-xs">End Date</th>
		                    <th class="hidden-xs">End Time</th>
		                    <th class="hidden-xs">Status</th>
		                </tr>
	                </thead>
	                <tbody>
		                <tr class="gradeX">
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td class="hidden-xs"></td>
		                    <td></td>
		                    <td class="hidden-xs"></td>
		                </tr>
	                </tbody>
	                <tfoot>
		                <tr>
		                    <th>ID</th>
		                    <th>Action</th>
		                    <th>Title</th>
		                    <th>Start Date</th>
		                    <th>Start Time</th>
		                    <th class="hidden-xs">End Date</th>
		                    <th class="hidden-xs">End Time</th>
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