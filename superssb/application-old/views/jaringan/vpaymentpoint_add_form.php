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
		            	$fields = array('pp_id', 'pp_location', 'pp_address','pp_phone','pp_fax', 'pp_status', 'pp_created');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Nama Lokasi</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['pp_location']); ?>" id="pp_location" name="pp_location">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Alamat</label>
	                        <div class="col-sm-8">
	                        	<textarea name="pp_address" class="form-control validate[required]" rows="5"><?php echo htmlspecialchars_decode($EDIT['pp_address']); ?></textarea>                           
	                        </div>
	                    </div>
	                    <div class="form-group">
                            <label class="col-sm-2 control-label">Telepon</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control validate[required]" value="<?= $EDIT['pp_phone'] ?>" id="pp_phone" name="pp_phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fax</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control validate[required]" value="<?= $EDIT['pp_fax'] ?>" id="pp_fax" name="pp_fax">
                            </div>
                        </div>                    
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="pp_status">
	                            	<option value="0" <?= (empty($EDIT['pp_status']) && $EDIT['pp_status'] != 0 || $EDIT['pp_status'] == 'active' ) ? 'selected="0"' : ''; ?>>Active</option>
	                            	<option value="1" <?= ($EDIT['pp_status'] == '1' && $EDIT['pp_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="pp_created" value="<?php echo (empty($EDIT['pp_created']))? '' : $EDIT['pp_created']; ?>">
	                        <input type="hidden" name="pp_id" value="<?php echo (empty($EDIT['pp_id']))? '' : $EDIT['pp_id']; ?>">
	                        <button type="submit" class="btn btn-info">Save</button>
	                        <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
	
</section>
<?php $date = parseDateTime($EDIT['p_create_date']); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('.wysihtml5').wysihtml5();
});

var BASE  = "<?php echo base_url() ?>";
var YEAR  = "<?php echo $date['year'] ?>";
var MONTH = "<?php echo $date['month'] ?>";
var DATE  = "<?php echo $date['day']?>";
var ID = "<?php echo $EDIT['p_id']?>";
var IMAGES = "<?php echo $EDIT['p_images_content']?>";

$("#file-3").fileinput({
  <?php if (!empty($EDIT['p_images_content'])): ?>
  initialPreview: ["<img src='"+BASE+"images-data/pages/"+YEAR+"/"+MONTH+"/"+DATE+"/"+ID+"/"+IMAGES+"' class='file-preview-image' />"],
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
  maxFileSize: 100,
    
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