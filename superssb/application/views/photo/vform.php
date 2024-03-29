    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo ($add_mode==1? 'ADD' : 'EDIT') ?> PHOTO
                        <button type="button" onclick="history.back(-1)" style="margin-top: -4px;" class="btn btn-info btn-sm pull-right">Cancel</button>
                    </header>
                    <?php
                    $fields = array('album_id', 'album_date', 'album_title', 'album_created_date', 'album_status', 'album_slug', 'album_description', 'ph_title','ph_images','ph_caption','ph_credit','ph_photographer','ph_album_id','ph_is_cover','ph_status');
                    foreach($fields as $field){
                        $EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : '';
                    }
                    // _d($EDIT); exit;

                    // Display Post Date
                    if($EDIT['album_date']=='' OR $EDIT['album_date']=='0000-00-00 00:00:00')
                    {
                        $photo_date = date('Y-m-d');
                    }else{
                        $postdate   = date_create($EDIT['album_date']);
                        $photo_date = date_format($postdate, 'Y-m-d');
                    }

                    // add = draft. edit = publish
                    $status = ($add_mode == 1)? 'draft' : 'publish';
                    ?>
                    <div class="panel-body">
                        <form class="form-horizontal bucket-form" method="POST" enctype="multipart/form-data" id="formID" action="<?php echo site_url('photo/submit_add'); ?>">

                            <div class="form-group">
                                <label class="control-label col-md-2">Date</label>
                                <div class="col-md-2">
                                  <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
                                    <input class="form-control" type="text" name="pubdate" value="<?= (!empty($photo_date)) ? $photo_date : date( 'Y-m-d'); ?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                                  </div>
                                </div>
                            </div>

                            <input type="hidden" name="channel" value="">
                            <?php /*
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Channel/Category <span class="text-danger">*</span></label>
                                <div class="col-md-2">
                                  <select name="channel" data-validation-engine="validate[required]" data-errormessage-value-missing="Channel is required" data-prompt-position="topRight:40,5" class="select2-container select2able select2-container-active" id="channel">
                                    <option value=""></option>
                                    <?php
                                    foreach ($channels as $key) {
                                    ?>
                                    <option value="<?php echo $key['ch_id'] ?>"> <?php echo $key['ch_name'] ?> </option>
                                    <?php
                                    }
                                    ?>                                
                                  </select>
                                </div>
                            </div>
                            */ ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Title <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $EDIT['ph_title'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="TITLE tidak boleh kosong!">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Slug (SEO URL)</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="slug" id="slug" value="<?php echo $EDIT['album_slug'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="Slug/SEO tidak boleh kosong!">
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Main Image <span class="text-danger">*</span></label>
                              <div class="col-md-6">
                                <div class="form-group" style="margin-left:1px;">
                                    <input id="file-3" type="file" data-show-upload="false" accept="image/*" name="userfile">
                                    <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                                      <span>* Maximum size: <strong>3 MB</strong></span><br />
                                      <span>* Minimum Width: <strong>825 pixel</strong></span><br />
                                      <span>* File extension: <strong>JPEG (.jpg), PNG (.png)</strong></span><br />
                                    </span>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-sm-2">Description <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description" id="editor1"><?php echo (empty($EDIT['album_description'])) ? '' : htmlspecialchars_decode($EDIT['album_description']) ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-sm-2">Caption <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="caption" rows="5"><?php echo (empty($EDIT['ph_caption'])) ? '' : htmlspecialchars_decode($EDIT['ph_caption']) ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Credit </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="photo_credit" value="<?php echo $EDIT['ph_credit'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Photographer </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="photographer" value="<?php echo $EDIT['ph_photographer'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <?php 
                                    /*if($EDIT->post_status=='publish') $act_status = 'revision';
                                    else $act_status = $EDIT->post_status;*/
                                 ?>
                                <div class="col-sm-3">
                                    <span class="label label-default"> DRAFT </span>
                                    <input type="hidden" class="form-control" name="status" value="<?php echo $status ?>">
                                </div>
                            </div>

                            <?php if ($add_mode==1){ ?>
                            <div class="input_fields_wrap"></div>

                            <div class="form-group">
                                <label class="control-label col-md-2">&nbsp;</label>
                                <div class="col-md-4">
                                  <div class="form-group" style="margin-left:1px;">
                                      <button class="btn btn-round btn-danger" type="button" id="add_field_button"><i class="fa fa-camera"></i> Add More Photo</button> 
                                      <button class="btn btn-round btn-default" type="button" id="remove_field"><i class="fa fa-trash-o"></i> Remove</button>
                                  </div>
                                </div>
                            </div>
                            <?php } ?>

                             <div class="position-center">
                                <button type="submit" class="btn btn-primary">Submit</button> 
                                <button type="submit" class="btn btn-white" id="btn-cancel">Cancel</button>
                            </div>
                            
                        </form>
                    </div>
                </section>

            </div>
            
        </div>
    </section>

<?php $path = (empty($EDIT['album_created_date']))? '' : parseDateTime($EDIT['album_created_date']); ?>
<script>
// CKEDITOR -> Enable CKEditor in all environments include mobile device, except IE7 and below.
if ( window.CKEDITOR && ( !CKEDITOR.env.ie || CKEDITOR.env.version > 7 ) ) CKEDITOR.env.isCompatible = true;
CKEDITOR.replace( 'editor1', {
});

// set variabel for display image (fileinput)
var YEAR   = "<?php echo (empty($path['year']))? '' :  $path['year']; ?>";
var MONTH  = "<?php echo (empty($path['month']))? '' : $path['month']; ?>";
var DATE   = "<?php echo (empty($path['day']))? '' : $path['day']; ?>";
var ID     = "<?php echo (empty($EDIT['album_id']))? '' : $EDIT['album_id']; ?>";
var IMAGES = "<?php echo (empty($EDIT['ph_images']))? '' : $EDIT['ph_images']; ?>";
var BASE   = "<?php echo base_url() ?>";

$("#file-3").fileinput({
  <?php if (!empty($EDIT['ph_images'])): ?>
  initialPreview: ["<img src='"+BASE+"images-data/photos/"+YEAR+"/"+MONTH+"/"+DATE+"/"+ID+"/"+IMAGES+"' class='file-preview-image' />"],
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
  maxFileSize: 3000,
    
  // overwriteInitial: false,
  // maxFilesNum: 10
});

(function() {   
/*
# ===================================
#   Timepicker
# ===================================
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
# ====================================
#   Datepicker
# ====================================
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

$("#btn-cancel").click(function(e)
{
    e.preventDefault();        
    var url = "<?php echo site_url('photo') ?>";
    $(location).attr('href',url);
});
</script>

<script type="text/javascript">
/*===== ADD MORE PHOTO ====*/
$(document).ready(function() {
    /*var max_fields      = 10; //maximum input boxes allowed*/
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    var del_button      = $("#remove_field"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault(); // cancel default behavior
        var xval = $(del_button).attr('alt');
        if (x<xval) x++;

        $.ajax({
                type: "GET",
                url: "<?php echo site_url('photo/loadmore'); ?>?next=" + x,
                cache: false,
                success: function(html){
                    $(wrapper).append(html);
                    $(del_button).attr('alt',x);
                    x++; //text box increment
                }
        }); 
        
        /*if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }*/
    });
   
    $(del_button).click(function(e){ //user click on remove text
        e.preventDefault(); // cancel default behavior
        var id     = $(del_button).attr('alt');
        if (x>id) x=id-1;

        var previd = x--;
        if (x<1) x=1;
        $(".photo"+id).remove();
        $(del_button).attr('alt',previd);

        // e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>