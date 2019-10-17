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
		            	$fields = array('ev_id', 
		            		'ev_title', 
		            		'ev_startdate', 
		            		'ev_enddate', 
		            		'ev_starttime', 
		            		'ev_endtime', 
		            		'ev_address', 
		            		'ev_summary', 
		            		'ev_create_date', 
		            		'ev_images_content', 
		            		'ev_images_caption', 
		            		'ev_location', 
		            		'ev_status');
						foreach($fields as $field){
							$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
						}
	            	?>
	                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data" id="formID" name="formID">
	                	
	                	<div class="form-group">
	                    <label class="control-label col-md-2">Event Start</label>
	                    <div class="col-md-2">
	                      <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
	                        <input class="form-control" type="text" name="startdate" value="<?= (!empty($EDIT['ev_startdate'])) ? $EDIT['ev_startdate'] : date( 'Y-m-d'); ?>">
	                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
	                      </div>
	                    </div>

	                    <div class="col-md-2">
	                      <div class="input-group bootstrap-timepicker">
	                        <input class="form-control" id="timepicker-24h" type="text" name="starttime" value="<?= (isset($EDIT['ev_starttime']))? $EDIT['ev_starttime'] : date('H:i:s'); ?>">
	                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
	                      </div>
	                    </div>
	                  </div>

	                  <div class="form-group">
	                    <label class="control-label col-md-2">Event End</label>
	                    <div class="col-md-2">
	                      <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
	                        <input class="form-control" type="text" name="enddate" value="<?= (!empty($EDIT['ev_enddate'])) ? $EDIT['ev_enddate'] : date( 'Y-m-d'); ?>">
	                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
	                      </div>
	                    </div>
	                    <div class="col-md-2">
	                      <div class="input-group bootstrap-timepicker">
	                        <input class="form-control" id="timepicker2-24h" type="text" name="endtime" value="<?= (isset($EDIT['ev_endtime']))? $EDIT['ev_endtime'] : date( 'H:i:s'); ?>">
	                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
	                      </div>
	                    </div>
	                  </div>

	                  <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control validate[required]" value="<?= $EDIT['ev_title'] ?>" id="title" name="title">
                        </div>
                      </div>

	                    
		                <div class="form-group">
                            <label class="control-label col-md-2" style="padding-top:50px !important;">Address</label>
                            <div class="col-md-6">
                                <textarea name="address" class="form-control" rows="4"><?php echo $EDIT['ev_address']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" style="padding-top:50px !important;">Summary</label>
                            <div class="col-md-6">
                                <textarea name="summary" class="form-control" rows="4"><?php echo $EDIT['ev_summary']; ?></textarea>
                            </div>
                        </div>

	                    <div class="form-group">
		                    <label class="control-label col-md-2">Event Description</label>
		                    <div class="col-md-7">
		                      <div class="widget-container fluid-height">
		                        <div class="widget-content padded">
		                          <textarea class="input-block-level" id="editor1" name="description" >
		                            <?php echo (empty($EDIT['ev_description']))? '' : htmlspecialchars_decode($EDIT['ev_description']); ?>
		                          </textarea>                    
		                        </div>
		                      </div>                
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
	                            <input type="text" class="form-control" value="<?= $EDIT['ev_images_caption'] ?>" name="img_caption">
	                        </div>
	                    </div>

	                    <div class="form-group">
                        	<label class="col-sm-2 control-label">Location</label>
                        	<div class="col-sm-6">
                            	<input type="text" class="form-control validate[required]" value="<?= $EDIT['ev_location'] ?>" name="location">
                        	</div>
                      	</div>
	                    
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="status">
	                            	<option value="1" <?= (empty($EDIT['ev_status']) && $EDIT['ev_status'] != 1 || $EDIT['ev_status'] == 'active' ) ? 'selected="1"' : ''; ?>>Active</option>
	                            	<option value="0" <?= ($EDIT['ev_status'] == '0' && $EDIT['ev_status'] !='') ? 'selected="selected"' : ''; ?>>Not Active</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="event_id" value="<?php echo (empty($EDIT['ev_id']))? '' : $EDIT['ev_id']; ?>">
	                        <input type="hidden" name="ev_created" value="<?php echo (empty($EDIT['ev_create_date']))? '' : $EDIT['ev_create_date']; ?>">
	                        <button type="submit" class="btn btn-info">Save</button>
	                        <button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
</section>
<?php $date = parseDateTime($EDIT['ev_create_date']); ?>

<script>
  // Enable CKEditor in all environments include mobile device, except IE7 and below.
  if ( window.CKEDITOR && ( !CKEDITOR.env.ie || CKEDITOR.env.version > 7 ) ) CKEDITOR.env.isCompatible = true;
  // Replace the <textarea id="editor1"> with a CKEditor
  CKEDITOR.replace( 'editor1', {
  });
</script>

<script type="text/javascript">

var BASE   = "<?php echo base_url() ?>";
var YEAR   = "<?php echo $date['year'] ?>";
var MONTH  = "<?php echo $date['month'] ?>";
var DATE   = "<?php echo $date['day']?>";
var ID     = "<?php echo $EDIT['ev_id']?>";
var IMAGES = "<?php echo $EDIT['ev_images_content']?>";

$("#file-3").fileinput({
  <?php if (!empty($EDIT['ev_images_content'])): ?>
  initialPreview: ["<img src='"+BASE+"images-data/events/"+YEAR+"/"+MONTH+"/"+DATE+"/"+ID+"/"+IMAGES+"' class='file-preview-image' />"],
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
<script type="text/javascript" language="javascript" class="init">
  (function() {
   
/*
# =============================================================================
    #   Timepicker
    # =============================================================================
    */
    $("#timepicker-default").timepicker();
    $("#timepicker-default2").timepicker();
    $("#timepicker-24h").timepicker({
      minuteStep: 1,
      showSeconds: false,
      showMeridian: false
    });
    $("#timepicker2-24h").timepicker({
      minuteStep: 1,
      showSeconds: false,
      showMeridian: false
    });
    $("#timepicker-noTemplate").timepicker({
      template: false,
      showInputs: false,
      minuteStep: 1
    });
    $("#timepicker-modal").timepicker({
      minuteStep: 1,
      secondStep: 1,
      showInputs: false,
      modalBackdrop: true,
      showSeconds: true,
      showMeridian: false
    });
    /*
    # =============================================================================
    #   Datepicker
    # =============================================================================
    */

    $('.datepicker').datepicker();
    nowTemp = new Date();
    now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    checkin = $("#dpd1").datepicker({
      onRender: function(date) {
        if (date.valueOf() < now.valueOf()) {
          return "disabled";
        } else {
          return "";
        }
      }
    }).on("changeDate", function(ev) {
      var newDate;
      if (ev.date.valueOf() > checkout.date.valueOf()) {
        newDate = new Date(ev.date);
        newDate.setDate(newDate.getDate() + 1);
        checkout.setValue(newDate);
      }
      checkin.hide();
      return $("#dpd2")[0].focus();
    }).data("datepicker");
    checkout = $("#dpd2").datepicker({
      onRender: function(date) {
        if (date.valueOf() <= checkin.date.valueOf()) {
          return "disabled";
        } else {
          return "";
        }
      }
    }).on("changeDate", function(ev) {
      return checkout.hide();
    }).data("datepicker");

    }).call(this);    
  </script>