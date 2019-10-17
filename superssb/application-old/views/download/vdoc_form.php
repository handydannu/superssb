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
		            	$fields = array('doc_id', 'doc_title', 'doc_summary', 'doc_file', 'doc_year', 'doc_created_date', 'doc_channel_id');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Title <span class="text-danger">*</span></label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['doc_title']); ?>" id="title" name="title">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Year</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="doc_year">
	                            	<option value=""> --- Select --- </option>
	                            	<?php 
									   for($i = 2005 ; $i <= date('Y'); $i++){
									   	$selected = ($i==$EDIT['doc_year'])? 'selected="selected"' : '';
									?>
									<option value="<?php echo $i; ?>" <?php echo $selected; ?> > <?php echo $i; ?> </option>
									<?php 
									   }
									?>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
		                    <label class="control-label col-md-2">Upload File <span class="text-danger">*</span></label>
		                    <div class="col-md-6">
		                      <div class="form-group" style="margin-left:1px;">
		                          <input id="file-3" type="file" name="userfile">
		                          <div>* Max. File Size 100 MB</div>
		                      </div>
		                    </div>
		                </div>

		                <div class="form-group">
                            <label class="control-label col-md-2" style="padding-top:50px !important;">Description</label>
                            <div class="col-md-6">
                                <textarea name="summary" class="form-control" rows="5"><?php echo htmlspecialchars_decode($EDIT['doc_summary']); ?></textarea>
                            </div>
                        </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="url" value="<?php echo current_url(); ?>" />
	                        <input type="hidden" name="d_id" value="<?php echo $EDIT['doc_id']; ?>" />
	                        <input type="hidden" name="channel_id" value="<?php echo ($add_mode=='1')? $channel_id : $EDIT['doc_channel_id']; ?>" />

	                        <button type="submit" class="btn btn-info">Save</button>
	                        <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
	
</section>
<?php $date = parseDateTime($EDIT['doc_created_date']); ?>
<script type="text/javascript">

var static_img  = "<?php echo $this->config->item('images_uri'); ?>";
var YEAR  = "<?php echo $date['year']; ?>";
var MONTH = "<?php echo $date['month']; ?>";
var DATE  = "<?php echo $date['day']; ?>";
var ID    = "<?php echo $EDIT['doc_id']; ?>";
var docfile = "<?php echo (empty($EDIT['doc_file']))? '' : $EDIT['doc_file']; ?>";

// setting fileinput for text and other (not image)
$("#file-3").fileinput({
<?php if (!empty($EDIT['doc_file'])): ?>
  initialPreview: "<div class='file-preview-text'>" + 
  "<h2><i class='glyphicon glyphicon-file'></i></h2>" + docfile + "</div>",
  browseLabel: "Change",
<?php else: ?>
  browseLabel: "Browse",
<?php endif; ?>

  showCaption: false,
  showRemove: false,
  showUpload: false,
  maxFileSize: 100000
});
</script>