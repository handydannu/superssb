<section class="wrapper">

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	                <?= $PAGE_TITLE ?>
	                <button type="button" onclick="history.back(-1)" style="margin-top: -4px;" class="btn btn-danger btn-sm pull-right">Back</button>
	            </header>
	            <div class="panel-body">
	            	<?php 
		            	$fields = array('sub_id', 'sub_name', 'sub_email', 'sub_phone','sub_date', 'sub_status');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">

	                    <div class="form-group">
	                        <label class="col-sm-1 control-label">Name</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control validate[required]" value="<?= $EDIT['sub_name'] ?>" id="title" name="sname">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-1 control-label">EMail</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" value="<?= $EDIT['sub_email'] ?>" id="title" name="semail">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-1 control-label">Phone</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" value="<?= $EDIT['sub_phone'] ?>" id="title" name="sphone">
	                        </div>
	                    </div>
	                    
	                    <div class="form-group">
	                        <label class="col-sm-1 control-label">Status</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="status">
	                            	<option value="1" <?= (empty($EDIT['sub_status']) && $EDIT['sub_status'] != 0) ? 'selected="selected"' : ''; ?>>Active</option>
	                            	<option value="0" <?= ($EDIT['sub_status'] == 0 && $EDIT['sub_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-1 control-label">&nbsp;</label>
	                        <input type="hidden" name="sid" value="<?php echo (empty($EDIT['sub_id']))? '' : $EDIT['sub_id']; ?>">
	                        <input type="hidden" name="sdate" value="<?php echo (empty($EDIT['sub_date']))? '' : $EDIT['sub_date']; ?>">
	                        <button type="submit" class="btn btn-info">Save</button>
	                        <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
	
</section>