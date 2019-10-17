<section class="wrapper">

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
                    <a class="btn btn-success btn-sm" href="<?= site_url('pages/add') ?>"><i class="fa fa-plus"></i> New Page</a>
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
		                    <th class="hidden-xs">Summary</th>
		                    <th class="hidden-xs">Status</th>
		                </tr>
	                </thead>
	                <tbody>
		                <tr class="gradeX">
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td class="hidden-xs"></td>
		                    <td class="hidden-xs"></td>
		                </tr>
	                </tbody>
	                <tfoot>
		                <tr>
		                    <th>ID</th>
		                    <th>Action</th>
		                    <th>Title</th>
		                    <th class="hidden-xs">Summary</th>
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