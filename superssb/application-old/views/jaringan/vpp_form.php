<section class="wrapper">

	<div class="row">
        <div class="col-md-12">
            <ul class="breadcrumbs-alt">
                <li>
                    <a href="<?php echo site_url(); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="javascript:;" class="current">Jaringan</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('kantor_cabang'); ?>">Kantor Cabang</a></li>
                <li><a href="<?php echo site_url('cash_office'); ?>">Kantor Kas</a></li>
                <li><a href="<?php echo site_url('atm_location'); ?>">Lokasi ATM</a></li>
                <li class="active">Payment Point</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
                    <a class="btn btn-success btn-sm" href="<?= site_url($this->uri->segment(1).'/add') ?>"><i class="fa fa-plus"></i> New</a>
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
		                    <th>ID</th>
		                    <th>Action</th>
		                    <th>Lokasi</th>
		                    <th>Alamat</th>
		                    <th>Telepon</th>
		                    <th>Fax</th>
		                    <th>Status</th>
		                </tr>
	                </thead>
	                <tbody>
		                <tr class="gradeX">
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                </tr>
	                </tbody>
	                <tfoot>
		                <tr>
		                    <th>ID</th>
		                    <th>Action</th>
		                    <th>Lokasi</th>
		                    <th>Alamat</th>
		                    <th>Telepon</th>
		                    <th>Fax</th>
		                    <th>Status</th>
		                </tr>
	                </tfoot>
	                </table>
                </div>
                </div>
	        </section>
	    </div>
	</div>

</section>