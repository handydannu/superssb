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
		            	$fields = array('p_id', 'p_title', 'p_slug','p_summary','p_content', 'p_images_content', 'p_images_caption', 'p_status', 'p_create_date');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Title</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['p_title']); ?>" id="title" name="ptitle">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Slug (SEO Link)</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" value="<?= $EDIT['p_slug'] ?>" id="slug" name="pslug">
	                        </div>
	                    </div>
	                    <div class="form-group">
                            <label class="control-label col-md-2" style="padding-top:50px !important;">Summary</label>
                            <div class="col-md-8">
                                <textarea name="psummary" class="form-control" rows="5"><?php echo htmlspecialchars_decode($EDIT['p_summary']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" style="padding-top:50px !important;">Content</label>
                            <div class="col-md-8">
                                <textarea name="pcontent" id="editor1" class="form-control" rows="9"><?php echo htmlspecialchars_decode($EDIT['p_content']); ?></textarea>
                            </div>
                        </div>

	                    <div class="form-group">
		                    <label class="control-label col-md-2">Image</label>
		                    <div class="col-md-3">
		                      <div class="form-group" style="margin-left:1px;">
		                          <input id="file-3" type="file" data-show-upload="false" accept="image/*" name="userfile">
		                          <div>* Max. File Size 100 KB</div>
		                      </div>
		                    </div>
		                </div>
		                <div class="form-group">
	                        <label class="col-sm-2 control-label">Image Caption</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" value="<?= $EDIT['p_images_caption'] ?>" id="title" name="pimagecaption">
	                        </div>
	                    </div>
	                    
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="pstatus">
	                            	<option value="active" <?= (empty($EDIT['p_status']) && $EDIT['p_status'] != 0 || $EDIT['p_status'] == 'active' ) ? 'selected="selected"' : ''; ?>>Active</option>
	                            	<option value="not-active" <?= ($EDIT['p_status'] == 'not-active' && $EDIT['p_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="pcreate_date" value="<?php echo (empty($EDIT['p_create_date']))? '' : $EDIT['p_create_date']; ?>">
	                        <input type="hidden" name="pid" value="<?php echo (empty($EDIT['p_id']))? '' : $EDIT['p_id']; ?>">
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