<section class="wrapper">

	<div class="row">
        <div class="col-md-12">
            <ul class="breadcrumbs-alt">
                <li>
                    <a href="<?php echo site_url(); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="#" class="current"><?php echo ucwords(str_replace('-', ' ', $this->uri->segment(1))); ?></a>
                </li>
            </ul>
        </div>
    </div>

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
	                            <input type="text" class="form-control validate[required]" value="<?= $EDIT['p_slug'] ?>" id="slug" name="pslug">
	                        </div>
	                    </div>
	                    <div class="form-group">
                            <label class="control-label col-md-2">Summary</label>
                            <div class="col-md-8">
                                <textarea name="psummary" class="form-control" rows="2"><?php echo htmlspecialchars_decode($EDIT['p_summary']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" style="padding-top:50px !important;">Content</label>
                            <div class="col-md-8">
                                <textarea name="pcontent" id="editor1" class="form-control" rows="9"><?php echo htmlspecialchars_decode($EDIT['p_content']); ?></textarea>
                            </div>
                        </div>

                        <? /*
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
	                    */?>
	                    
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="pstatus">
	                            	<option value="1" <?= (empty($EDIT['p_status']) && $EDIT['p_status'] != 0 ) ? 'selected="selected"' : ''; ?>>Active</option>
	                            	<option value="0" <?= ($EDIT['p_status'] == '0' && $EDIT['p_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="pcreate_date" value="<?php echo (empty($EDIT['p_create_date']))? '' : $EDIT['p_create_date']; ?>">
	                        <input type="hidden" name="pid" value="<?php echo (empty($EDIT['p_id']))? '' : $EDIT['p_id']; ?>">
	                        <input type="hidden" name="channel_id" value="<?php echo $channel_id; ?>">

	                        <button type="submit" class="btn btn-info">Save</button>
	                        <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
	
</section>

<script>
  // Enable CKEditor in all environments include mobile device, except IE7 and below.
  if ( window.CKEDITOR && ( !CKEDITOR.env.ie || CKEDITOR.env.version > 7 ) ) CKEDITOR.env.isCompatible = true;
  // Replace the <textarea id="editor1"> with a CKEditor
  CKEDITOR.replace( 'editor1', {
  });
</script>