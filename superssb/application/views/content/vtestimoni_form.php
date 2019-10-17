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
		            	$fields = array('testimoni_id', 'testimoni_name', 'testimoni_email', 'testimoni_about', 'testimoni_address', 'testimoni_website', 'testimoni_image', 'testimoni_content', 'testimoni_status', 'testimoni_created');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
	                	<div class="form-group">
	                        <label class="col-sm-2 control-label">Name <span class="text-danger">*</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['testimoni_name']); ?>" id="t_name" name="t_name">
	                        </div>
	                    </div>                           
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Email Address <span class="text-danger">*</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['testimoni_email']); ?>" id="t_email" name="t_email">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">About You</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['testimoni_about']); ?>" id="t_about" name="t_about">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Your Location</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['testimoni_address']); ?>" id="t_address" name="t_address">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Your Website</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['testimoni_website']); ?>" id="t_website" name="t_website">
	                        </div>
	                    </div>
	                    <div class="form-group block-local-image">
	                        <label class="col-sm-2 control-label">Your Picture</label>
	                        <div class="col-sm-8">
                                <div class="form-group" style="margin-left:1px;">
                    				<input id="file-3" type="file" data-show-upload="false" accept="image/*" name="userfile">
	                            	<span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
	                            		<span>* Maximum size: <strong>300 Kb</strong></span><br />
	                            		<span>* Recommendation dimensions: <strong>--- X --- pixel</strong></span><br />
	                            		<span>* File extension: <strong>JPEG (.jpg), PNG (.png)</strong></span><br />
	                            	</span>
                                </div>	                            
	                        </div>
	                    </div>	                    
	                    <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-2">Your Comment <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="t_comment" id="editor1" data-validation-engine="validate[required]" data-errormessage-value-missing="Content is required"><?php echo (empty($EDIT['testimoni_content'])) ? '' : $EDIT['testimoni_content'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Status <span class="text-danger">*</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="t_status">
	                            	<option value="1" <?= (empty($EDIT['testimoni_status']) && $EDIT['testimoni_status'] != 1 || $EDIT['testimoni_status'] == 'active' ) ? 'selected="1"' : ''; ?>>Active</option>
	                            	<option value="0" <?= ($EDIT['testimoni_status'] == '0' && $EDIT['testimoni_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="t_created" value="<?php echo (empty($EDIT['testimoni_created']))? '' : $EDIT['testimoni_created']; ?>">
	                        <input type="hidden" name="t_id" value="<?php echo (empty($EDIT['testimoni_id']))? '' : $EDIT['testimoni_id']; ?>">
	                        <input type="hidden" name="current_image" value="<?php echo (empty($EDIT['testimoni_image']))? '' : $EDIT['testimoni_image']; ?>">
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
var ID     = "<?php echo (empty($EDIT['testimoni_id']))? '' : $EDIT['testimoni_id']; ?>";
var IMAGES = "<?php echo (empty($EDIT['testimoni_image']))? '' : $EDIT['testimoni_image']; ?>";
var BASE   = "<?php echo base_url() ?>";
var BASEIMG= "<?php echo $this->config->item('images_posts_uri') ?>";

$("#file-3").fileinput({
  <?php if (!empty($EDIT['testimoni_image'])): ?>
  initialPreview: ["<img src='"+BASEIMG+"testimoni/"+ID+"/"+IMAGES+"' class='file-preview-image' />"],
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