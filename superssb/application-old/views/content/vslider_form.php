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
		            	$fields = array('h_title', 'h_status', 'h_image', 'h_summary', 'h_url');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
	                	<div class="form-group">
	                        <label class="col-sm-2 control-label">Headline Title <span class="text-danger">*</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['h_title']); ?>" id="h_title" name="h_title">
	                        </div>
	                    </div>                           
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Headline URL <span class="text-danger">*</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['h_url']); ?>" id="h_url" name="h_url">
	                        </div>
	                    </div>
	                    <div class="form-group block-local-image">
	                        <label class="col-sm-2 control-label">Image Content <span class="text-danger">*</label>
	                        <div class="col-sm-8">
                                <div class="form-group" style="margin-left:1px;">
                    				<input id="file-3" type="file" data-show-upload="false" accept="image/*" name="userfile">
	                            	<span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
	                            		<span>* Maximum size: <strong>300 Kb</strong></span><br />
	                            		<span>* Recommendation dimensions: <strong>1280 X 560 pixel</strong></span><br />
	                            		<span>* File extension: <strong>JPEG (.jpg), PNG (.png)</strong></span><br />
	                            	</span>
                                </div>	                            
	                        </div>
	                    </div>	                    
	                    <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-2">Description</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="h_summary" id="editor1" data-validation-engine="validate[required]" data-errormessage-value-missing="Content is required"><?php echo (empty($EDIT['h_summary'])) ? '' : $EDIT['h_summary'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Status <span class="text-danger">*</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="h_status">
	                            	<option value="1" <?= (empty($EDIT['h_status']) && $EDIT['h_status'] != 1 || $EDIT['h_status'] == 'active' ) ? 'selected="1"' : ''; ?>>Active</option>
	                            	<option value="0" <?= ($EDIT['h_status'] == '0' && $EDIT['h_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="h_created" value="<?php echo (empty($EDIT['h_created']))? '' : $EDIT['h_created']; ?>">
	                        <input type="hidden" name="h_id" value="<?php echo (empty($EDIT['h_id']))? '' : $EDIT['h_id']; ?>">
	                        <input type="hidden" name="current_image" value="<?php echo (empty($EDIT['h_image']))? '' : $EDIT['h_image']; ?>">
	                        <input type="hidden" name="current_thumb" value="<?php echo (empty($EDIT['h_thumb']))? '' : $EDIT['h_thumb']; ?>"> 
	                        <button type="submit" class="btn btn-info">Save</button>
	                        <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
	
</section>
<script type="text/javascript">

var YEAR   = "<?php echo (empty($path['year']))? '' :  $path['year']; ?>";
var MONTH  = "<?php echo (empty($path['month']))? '' : $path['month']; ?>";
var DATE   = "<?php echo (empty($path['day']))? '' : $path['day']; ?>";
var ID     = "<?php echo (empty($EDIT['h_id']))? '' : $EDIT['h_id']; ?>";
var IMAGES = "<?php echo (empty($EDIT['h_image']))? '' : $EDIT['h_image']; ?>";
var BASE   = "<?php echo base_url() ?>";

$("#file-3").fileinput({
  <?php if (!empty($EDIT['h_image'])): ?>
  initialPreview: ["<img src='"+BASE+"images-data/headline/"+ID+"/"+IMAGES+"' class='file-preview-image' />"],
  <?php endif; ?>

  showCaption: false,
  fileType: "any",
  previewFileType: "image",
  browseClass: "btn btn-success",
  browseLabel: "Pick Image",
  browseIcon: '<i class="fa fa-fw fa-folder-open-o"></i>',
  removeClass: "btn btn-danger",
  removeLabel: "Delete",
  removeIcon: '<i class="fa fa-fw fa-trash-o"></i>',
  maxFileSize: 300,
    
  // overwriteInitial: false,
  // maxFilesNum: 10
});
</script>
<script>
  // Enable CKEditor in all environments include mobile device, except IE7 and below.
  if ( window.CKEDITOR && ( !CKEDITOR.env.ie || CKEDITOR.env.version > 7 ) ) CKEDITOR.env.isCompatible = true;
  // Replace the <textarea id="editor1"> with a CKEditor
  CKEDITOR.replace( 'editor1', {
  });
</script>