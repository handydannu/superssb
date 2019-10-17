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
		            	$fields = array('hi_id', 'hi_title', 'hi_content', 'hi_link', 'hi_modified');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Title</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control validate[required]" value="<?= htmlspecialchars_decode($EDIT['hi_title']); ?>" id="title" name="title">
	                        </div>
	                    </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" style="padding-top:50px !important;">Content</label>
                            <div class="col-md-8">
                                <textarea name="content" id="editor1" class="form-control" rows="9"><?php echo htmlspecialchars_decode($EDIT['hi_content']); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Link</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['hi_link']); ?>" name="link">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="modified" value="<?php echo (empty($EDIT['hi_modified']))? '' : $EDIT['hi_modified']; ?>">
	                        <input type="hidden" name="hid" value="<?php echo (empty($EDIT['hi_id']))? '' : $EDIT['hi_id']; ?>">

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