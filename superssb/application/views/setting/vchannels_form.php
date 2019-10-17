<section class="wrapper">

	<div class="row">
	    <div class="col-sm-8">
	        <section class="panel">
	            <header class="panel-heading">
	                <?= $PAGE_TITLE ?>
	                <a href="<?= site_url('channels') ?>" type="button" style="margin-top: -4px;" class="btn btn-danger btn-sm pull-right">Back</a>
	            </header>
	            <div class="panel-body">
	            	<?php 
		            	$fields = array('ch_name','ch_slug','ch_status', 'ch_type');
						foreach($fields as $field){
							$EDIT->{$field} = isset($EDIT->{$field}) ? $EDIT->{$field} : $this->session->flashdata($field);
						}

	            		if ($mode == 'ADD') {
	            			$action_url = site_url('channels/submit_add');
	            		} else {
	            			$action_url = site_url('channels/submit_update/'.$category_id);
	            		}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" id="formID" name="formID" action="<?= $action_url; ?>">
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Channel Name</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= $EDIT->ch_name ?>" id="title" name="ch_name">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Slug (SEO Link)</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= $EDIT->ch_slug ?>" id="slug" name="ch_slug">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Type</label>
	                        <div class="col-sm-5">
	                            <select class="form-control" name="ch_type">
	                            	<?php
	                              	foreach ($channel_types as $key) {
	                              		if ( $key->tp_id == $EDIT->ch_type)
	                              		{
											$select = 'selected="selected"';
	                              		}else{
	                              			$select = '';
	                              		}
	                              	?>
	                            	<option value="<?php echo $key->tp_id; ?>" <?php echo $select; ?>> <?php echo ucfirst($key->tp_name); ?> </option>
	                            	<?php } ?>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Parent Channel</label>
	                        <div class="col-sm-5">
	                            <select class="form-control" name="ch_parent_id">
	                            	<option value="0"> -- None --</option>
	                            	<?php
	                              	foreach ($category_parent as $key) {
	                              		if ( $key->ch_id == $EDIT->ch_parent_id)
	                              		{
											$select = 'selected="selected"';
	                              		}else{
	                              			$select = '';
	                              		}
	                              	?>
	                            	<option value="<?php echo $key->ch_id; ?>" <?php echo $select; ?>> <?php echo ucfirst($key->ch_name); ?> </option>
	                            	<?php } ?>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-3">
	                            <select class="form-control" name="ch_status">
	                            	<option value="1" <?= (empty($EDIT->ch_status) && $EDIT->ch_status != 0) ? 'selected="selected"' : ''; ?>>Active</option>
	                            	<option value="0" <?= ($EDIT->ch_status == 0 && $EDIT->ch_status !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <button type="submit" class="btn btn-info">Save</button>
	                        <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
	
</section>
