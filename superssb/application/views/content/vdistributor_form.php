<section class="wrapper">

	<div class="row">
	    <div class="col-sm-12">
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
          <section class="panel">
              <header class="panel-heading">
                  <strong><?= $PAGE_TITLE ?></strong>
                  <button type="button" onclick="history.back(-1)" style="margin-top: -4px;" class="btn btn-danger btn-sm pull-right">Back</button>
              </header>
              <div class="panel-body">
                      <?php 
                        $fields = array('dist_id', 'dist_name', 'dist_city', 'dist_address_1', 'dist_address_2', 'dist_address_3', 'dist_telp', 'dist_fax', 'dist_email', 'dist_market_area', 'dist_market_area_city', 'dist_images', 'dist_created_date', 'dist_status');
                        foreach($fields as $field){
                          $EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
                        }
                      ?>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Name <span class="text-danger">*</span></label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_name']); ?>" name="name" data-validation-engine="validate[required]" data-errormessage-value-missing="Name is required">
	                        </div>
	                    </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Address 1 <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_address_1']); ?>" name="address1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Address 2</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_address_2']); ?>" name="address2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Address 3</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_address_3']); ?>" name="address3">
                            </div>
                        </div>

                        <div class="form-group">
	                        <label class="col-sm-2 control-label">City (Office)</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_city']); ?>" name="city">
	                        </div>
	                    </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Province <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                              <select name="provinsi" data-validation-engine="validate[required]" data-errormessage-value-missing="Province is required" data-prompt-position="topRight:40,5" class="select2-container select2able select2-container-active" id="province">
                              	<option value=""></option>
                              	<?php
                              	foreach ($provinsi as $key) {
                              		if ( $key['prov_id'] == $EDIT['dist_province_id'])
                              		{
										              $select = 'selected="selected"';
                              		}else{
                              			$select = '';
                              		}
                              	?>
                              	<option value="<?php echo $key['prov_id'] ?>" <?php echo $select; ?>> <?php echo $key['prov_name'] ?> </option>
                              	<?	
                              	}
                              	?>                                
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Telp</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_telp']); ?>" name="telp">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Fax</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_fax']); ?>" name="fax">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">E-Mail</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_email']); ?>" name="email">
	                        </div>
	                    </div>

	                    <div class="form-group block-local-image">
	                        <label class="col-sm-2 control-label">Image</label>
	                        <div class="col-sm-8">
                                <div class="form-group" style="margin-left:1px;">
                    				<input id="file-3" type="file" data-show-upload="false" accept="image/*" name="userfile">
	                            	<span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
	                            		<span>* Maximum size: <strong>100 Kb</strong></span><br />
	                            		<span>* File extension: <strong>JPEG (.jpg), PNG (.png)</strong></span><br />
	                            	</span>
                                </div>	                            
	                        </div>
	                    </div>
	            </div>
	        </section>

          <section class="panel">
              <header class="panel-heading">
                  <strong>WILAYAH PEMASARAN</strong>
              </header>
              <div class="panel-body">
                <div class="form-group">
                    <label class="col-lg-2 col-sm-3 control-label">Provinsi <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <select multiple="multiple" name="market[]" id="category" style="width:100%;" class="populate" data-validation-engine="validate[required]" data-errormessage-value-missing="Market Area is required" data-prompt-position="topRight:40,5">
                            <?php 
                            $market       = explode(',', $EDIT['dist_market_area']);
                            $total_market = count($market);
                            //$active       = $EDIT['dist_province_id'];
                            $total_prop   = count($provinsi);
                            $selected = '';

                            // looping provinsi
                            for ($i=0; $i < $total_prop ; $i++):
                              $p = $provinsi[$i];

                              // Looping wilayah pemasaran yg dimiliki distributor
                              for ($m=0; $m < $total_market; $m++) { 
                                  $active = $market[$m];
                                  if($active == $p['prov_id']){
                                      $selected = 'selected="selected"';
                                      break;
                                  }else{
                                      $selected = '';
                                  }
                              }
                            ?>
                            <option value="<?php echo $p['prov_id'] ?>" <?php echo $selected ?> ><?php echo $p['prov_name'] ?></option>
                         
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Kota </label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" value="<?= htmlspecialchars_decode($EDIT['dist_market_area_city']); ?>" name="market_city">
                    </div>
                </div>                
            </div>
            </section>

            <section class="panel">
              <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="status">
                          <option value="1" <?= ($mode=='ADD' || $EDIT['dist_status'] == '1' ) ? 'selected="selected"' : ''; ?>>Active</option>
                          <option value="0" <?= ($EDIT['dist_status'] == '0' && $EDIT['dist_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <input type="hidden" name="d_id" value="<?php echo (empty($EDIT['dist_id']))? '' : $EDIT['dist_id']; ?>">
                    <button type="submit" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                </div>
              </div>
            </section>

            </form>
	    </div>
	</div>
	
</section>
<script>
  // Enable CKEditor in all environments include mobile device, except IE7 and below.
  if ( window.CKEDITOR && ( !CKEDITOR.env.ie || CKEDITOR.env.version > 7 ) ) CKEDITOR.env.isCompatible = true;
  // Replace the <textarea id="editor1"> with a CKEditor
  CKEDITOR.replace( 'editor1', {
  });
  CKEDITOR.replace( 'editor2', {
  });
  CKEDITOR.replace( 'editor3', {
  });
</script>
<?php $path = (empty($EDIT['dist_created_date']))? '' : parseDateTime($EDIT['dist_created_date']); ?>

<script type="text/javascript">

var YEAR   = "<?php echo (empty($path['year']))? '' :  $path['year']; ?>";
var MONTH  = "<?php echo (empty($path['month']))? '' : $path['month']; ?>";
var DATE   = "<?php echo (empty($path['day']))? '' : $path['day']; ?>";
var ID     = "<?php echo (empty($EDIT['dist_id']))? '' : $EDIT['dist_id']; ?>";
var IMAGES = "<?php echo (empty($EDIT['dist_images']))? '' : $EDIT['dist_images']; ?>";
var BASE   = "<?php echo base_url() ?>";
var URI_1  = "<?php echo $this->uri->segment(1) ?>";

$("#file-3").fileinput({
  <?php if (!empty($EDIT['dist_images'])): ?>
  initialPreview: ["<img src='"+BASE+"images-data/"+URI_1+"/"+YEAR+"/"+MONTH+"/"+DATE+"/"+ID+"/"+IMAGES+"' class='file-preview-image' />"],
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