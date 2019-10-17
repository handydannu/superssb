<?php 
	$akses = $this->session->userdata('privilege');

	$fields = array('c_id', 'c_created_date', 'c_publish_date','c_subtitle','c_title','c_slug','c_summary','c_content','c_images_content', 'c_images_caption','c_keyword','c_channel_id','c_feature','c_type','c_source','c_author','c_author_name','c_editor','c_hits','c_status', 'c_content_type', 'c_youtube_url', 'c_youtube_id');
	foreach($fields as $field){
		$EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
	}

	if (!empty($EDIT['c_publish_date'])) 
	{
		$tgl = explode(" ", $EDIT['c_publish_date']);
		$pdate = $tgl[0];
		$ptime = $tgl[1];
	}else{
		$pdate = '';
		$ptime = '';
	}

	$BASEURL = $this->uri->segment(1);	// Berita atau CSR

	if ($mode == 'ADD') {
		$action_url = site_url($BASEURL.'/submit_add');
		$cancel_url = site_url($BASEURL);
	} else {
		$action_url = site_url($BASEURL.'/submit_update/'.$EDIT['c_id']);
		$cancel_url = site_url($BASEURL.'/release/'.$EDIT['c_id']);
	}
?>

<section class="wrapper">

	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	                <?= $PAGE_TITLE ?>
	                <a href="<?php echo $cancel_url ?>" type="button" style="margin-top: -4px;" class="btn btn-danger btn-sm pull-right">Cancel</a>
	            </header>
	            <div class="panel-body">
	                <form class="form-horizontal bucket-form" method="post" id="formID" name="formID" action="<?= $action_url ?>" enctype="multipart/form-data">
	                    
	                    <div class="form-group">
		                    <label class="control-label col-md-2">Date</label>
		                    <div class="col-md-2">
		                      <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
		                        <input class="form-control" type="text" name="pubdate" value="<?= (!empty($EDIT['c_publish_date'])) ? $pdate : date( 'Y-m-d'); ?>">
		                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
		                      </div>
		                    </div>

		                    <div class="col-md-2">
		                      <div class="input-group bootstrap-timepicker">
		                        <span><input class="form-control" id="timepicker-24h" type="text" name="pubtime" value="<?= (isset($EDIT['c_publish_date']))? $ptime : date('H:i:s'); ?>"></span>
		                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
		                      </div>
		                    </div>
		                </div>

		                <?php /*
	                    <div class="form-group">
                            <label class="col-sm-2 control-label">Channel/Category <span class="text-danger">*</span></label>
                            <div class="col-md-2">
                              <select name="channel" data-validation-engine="validate[required]" data-errormessage-value-missing="Channel is required" data-prompt-position="topRight:40,5" class="select2-container select2able select2-container-active" id="channel">
                              	<option value=""></option>
                              	<?php
                              	foreach ($channels as $key) {
                              		if ( $key['ch_id'] == $EDIT['c_channel_id'])
                              		{
										$select = 'selected="selected"';
                              		}else{
                              			$select = '';
                              		}
                              	?>
                              	<option value="<?php echo $key['ch_id'] ?>" <?php echo $select; ?>> <?php echo $key['ch_name'] ?> </option>
                              	<?	
                              	}
                              	?>                                
                              </select>
                            </div>
                        </div>
                        */?>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Sub Title</label>
	                        <div class="col-sm-4">
	                            <input type="text" class="form-control" name="subtitle" value="<?= (empty($EDIT['c_subtitle'])) ? '' : $EDIT['c_subtitle'] ?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Title Article <span class="text-danger">*</span></label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" value="<?= (empty($EDIT['c_title'])) ? '' : $EDIT['c_title'] ?>" id="title" name="title" data-validation-engine="validate[required]" data-errormessage-value-missing="Title is required">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Slug (SEO URL) <span class="text-danger">*</span></label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" value="<?= (empty($EDIT['c_slug'])) ? '' : $EDIT['c_slug'] ?>" id="slug" name="slug" data-validation-engine="validate[required]" data-errormessage-value-missing="Slug/SEO is required">
	                        </div>
	                    </div>
	                    <div class="form-group">
                            <label class="col-sm-2 control-label">Summary <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" name="summary" id="post_summary" data-validation-engine="validate[required]" data-errormessage-value-missing="Summary is required"><?= (empty($EDIT['c_summary'])) ? '' : $EDIT['c_summary'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Keywords </label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" name="keyword" id ="post_keyword" value="<?= (empty($EDIT['c_keyword'])) ? '' : $EDIT['c_keyword'] ?>">
	                            <span class="help-block"><span class="label label-danger">NOTE!</span>&nbsp;&nbsp;&nbsp;Seperate with comma ", "</span>
	                        </div>
	                    </div>

	                    <input type="hidden" value="video" name="content_type">
	                    <?php /* // -------- CONTENT TYPE: text atau video ---------
	                    if ($mode=='ADD'){
	                    	$text_checked  = 'checked="checked"';
	                    	$video_checked = '';
	                    }else{
	                    	$text_checked  = ($EDIT['c_content_type']=='text')? 'checked="checked"' : '';
	                    	$video_checked = ($EDIT['c_content_type']=='video')? 'checked="checked"': '';
	                    }
	                    ?>

	                    <div class="form-group">
                            <label class="col-sm-2 control-label">Type <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
	                            <label style="font-weight:400;">
	                                <input type="radio" <?=$text_checked?> value="text" class="optiontype" name="content_type">
	                                Text
	                            </label>
	                            &nbsp;&nbsp;
	                            <label style="font-weight:400;">
	                                <input type="radio" <?=$video_checked?> value="video" class="optiontype" name="content_type">
	                                Video
	                            </label>
	                        </div>
                        </div>

                        */?>
	
                        <div class="form-group" id="div_youtube">
	                        <label class="col-sm-2 control-label">Youtube Link</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="youtube_url" name="youtube_url" value="<?= (empty($EDIT['c_youtube_url'])) ? '' : $EDIT['c_youtube_url'] ?>">
	                        	<span class="help-block"><span class="label label-danger">NOTE!</span>&nbsp;&nbsp;&nbsp; Contoh: http://www.youtube.com/watch?v=rXy-dECCUHM</span>
	                        </div>
	                    </div>
	                    <div class="form-group" style="display:none;">
	                        <label class="col-sm-2 control-label">Youtube ID</label>
	                        <div class="col-sm-8">
	                            <input type="text" id="youtube_key" class="form-control" name="youtube_id" value="<?= (empty($EDIT['c_youtube_id'])) ? '' : $EDIT['c_youtube_id'] ?>">
	                        </div>
	                    </div>
	                    
                        
	                    <div class="form-group">
                            <label class="col-sm-2 control-label col-sm-2">Content <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="editor1" data-validation-engine="validate[required]" data-errormessage-value-missing="Content is required"><?php echo (empty($EDIT['c_content'])) ? '' : $EDIT['c_content'] ?></textarea>
                            </div>
                        </div>

	                    <div class="form-group block-local-image">
	                        <label class="col-sm-2 control-label">Image Content</label>
	                        <div class="col-sm-8">
                                <div class="form-group" style="margin-left:1px;">
                    				<input id="file-3" type="file" data-show-upload="false" accept="image/*" name="userfile">
	                            	<span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
	                            		<span>* Maximum size: <strong>150 Kb</strong></span><br />
	                            		<span>* Recommendation dimensions: <strong>800 X 600 pixel</strong></span><br />
	                            		<span>* File extension: <strong>JPEG (.jpg), PNG (.png)</strong></span><br />
	                            	</span>
                                </div>	                            
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Caption</label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" id="post_image_caption" name="img_caption" value="<?= (empty($EDIT['c_images_caption'])) ? '' : htmlspecialchars($EDIT['c_images_caption']) ?>">
	                            <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                            		<span>* Caption Foto: Gunakan separator <strong>"|"</strong> untuk memisahkan caption dan credit foto. </span><br />
                            		<span>* Credit Foto: Gunakan separator <strong>"-"</strong> pada credit foto untuk memisahkan nama kantor dan nama fotografer jika ada</span><br />
                            		<span>* Contoh:  <strong>Emirsyah Satar|Antara-Rian Firman</strong></span><br />
                            	</span>
	                        </div>
	                    </div>
	                    
	                    <div class="form-group">
                            <label class="col-sm-2 control-label">Features</label>
                            <div class="col-md-2">
                              <select name="feature" class="select2-container select2able select2-container-active" id="features">
                              	<option value=""></option>
                              	<?php
                              	foreach ($features as $key) {
                              		if ( $key['fe_id'] == $EDIT['c_feature'])
                              		{
										$select = 'selected="selected"';
                              		}else{
                              			$select = '';
                              		}
                              	?>
                              	<option value="<?php echo $key['fe_id'] ?>" <?php echo $select; ?>> <?php echo $key['fe_name'] ?> </option>
                              	<? } ?>
                              </select>
                            </div>
                        </div>
                        <?php if ($mode=='EDITING' && $EDIT['c_feature']==1)
	                     {
	                     	// EDIT Mode & Headline selected
	                     	$author_style=''; 
	                     }else{
	                     	// ADD Mode
	                     	$author_style='display:none;';
	                     }
	                     ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Author</label>
                            <div class="col-md-10">
                              <select name="author" class="select2-container select2able select2-container-active" id="author">
                              	<option value="0"> &nbsp; Other</option>
                              	<?php
                              	foreach ($author as $key) {
                              		if ( ($this->session->userdata('privilege') == 'reporter' && $key['uid'] == $CU->uid) || ($key['uid'] == $EDIT['c_author'] && $EDIT['c_author'] != '') || ($this->uri->segment(1)=='my_article' && $key['uid'] == $CU->uid) || ($mode=='ADD' && $key['uid'] == $CU->uid) ) {
                              			$select = 'selected="selected"';
                              		}else{
                              			$select = '';
                              		}
                              	?>
                              	<option value="<?php echo $key['uid'] ?>" <?php echo $select; ?>> &nbsp; <?php echo $key['nama'] ?> &nbsp; </option>
                              	<? } ?>
                              </select>
                              <span class="help-block"><span class="label label-danger">NOTE!</span>&nbsp;&nbsp;&nbsp;Jika Nama Author tidak ada dalam list, pilih "Others" dan ketik Other Author Name di input text di bawah.</span>
	                        </div>
                        </div>

	                    <?php if ($mode=='EDITING' && $EDIT['c_author_name']!='')
	                     {
	                     	// EDIT Mode & there is Other Author Name
	                     	$author_style=''; 
	                     }else{
	                     	// ADD Mode
	                     	$author_style='display:none;';
	                     }
	                     ?>
	                    <div class="form-group" style="<?=$author_style;?>" id="div_other">
	                        <label class="col-sm-2 control-label">Other Author Name</label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" id="other_author" name="other_author_name" value="<?= (empty($EDIT['c_author_name'])) ? '' : $EDIT['c_author_name'] ?>">
	                        </div>
	                    </div>

	                    <div class="form-group">
                            <label class="col-sm-2 control-label">Editor</label>
                            <div class="col-md-2">
                              <select name="editor" class="select2-container select2able select2-container-active" id="editor">
                              	<option value=""></option>
                              	<?php
                              	
                              	foreach ($editor as $key) {
                              		$editor_id = $key['uid'];
                              		$editor_name = $key['nama'];

                              		if ( ($editor_id == $CU->uid) || ($editor_id == $EDIT['c_editor']) ) {
                              			$select = 'selected="selected"';
                              		}else{
                              			$select = '';
                              		}
                              	?>
                              	<option value="<?php echo $editor_id; ?>" <?php echo $select; ?> > <?php echo $editor_name; ?> </option>
                              	<? } ?>
                              </select>
                            </div>
                        </div>

                        <?php if ($akses=='reporter'){ ?>
                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-2">
	                        	<input type="hidden" name="status" value="draft">
	                        	<span class="label label-default">Draft</span>
	                        </div>
	                    </div>
	                    <?php }else{ ?>

                        <div class="form-group">
	                        <label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-2">
	                            <select class="form-control" name="status">
	                            	<option value="draft" <?= (empty($EDIT['c_status']) && $EDIT['c_status'] == 'draft' ) ? 'selected="selected"' : ''; ?>>Draft</option>
	                            	<option value="publish" <?= ($EDIT['c_status'] == 'publish' && $EDIT['c_status'] !='') ? 'selected="selected"' : ''; ?>>Publish</option>
	                            </select>
	                        </div>
	                    </div>
	                    <?php } ?>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">Source</label>
	                        <div class="col-sm-3">
	                            <input type="text" class="form-control" name="source" value="<?php echo (empty($EDIT['c_source'])) ? '' : $EDIT['c_source'] ?>">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">&nbsp;</label>
	                        <input type="hidden" name="cid" value="<?php echo $EDIT['c_id']?>">
	                        <input type="hidden" name="dateCreated" value="<?php echo $EDIT['c_created_date']?>">
	                        <input type="hidden" name="hit" value="<?php echo $EDIT['c_hits']?>">
	                        <input type="hidden" name="channel_id" value="<?php echo $channel; ?>">
	                        
	                        <button type="submit" class="btn btn-info">Save</button>
	                        <a href="<?php echo $cancel_url; ?>"><button type="button" class="btn btn-danger">Cancel</button>
                        </div>
	                </form>
	            </div>
	        </section>
	    </div>
	</div>
</section>

<?php $path = (empty($EDIT['c_created_date']))? '' : parseDateTime($EDIT['c_created_date']); ?>

<script type="text/javascript">

var YEAR   = "<?php echo (empty($path['year']))? '' :  $path['year']; ?>";
var MONTH  = "<?php echo (empty($path['month']))? '' : $path['month']; ?>";
var DATE   = "<?php echo (empty($path['day']))? '' : $path['day']; ?>";
var ID     = "<?php echo (empty($EDIT['c_id']))? '' : $EDIT['c_id']; ?>";
var IMAGES = "<?php echo (empty($EDIT['c_images_content']))? '' : $EDIT['c_images_content']; ?>";
var BASE   = "<?php echo base_url() ?>";
var BASEIMG= "<?php echo $this->config->item('images_posts_uri') ?>";

$("#file-3").fileinput({
  <?php if (!empty($EDIT['c_images_content'])): ?>
  initialPreview: ["<img src='"+BASEIMG+"posts/"+YEAR+"/"+MONTH+"/"+DATE+"/"+ID+"/"+IMAGES+"' class='file-preview-image' />"],
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
  maxFileSize: 150,
    
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

<script type="text/javascript" language="javascript" class="init">
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
</script>

<script type="text/javascript">
$(document).ready(function() {
	// if headline selected
	$('#features').change(function(){
		var id = $('#features :selected').val();
		if (id == 1) {
			$('div#headline_img').show();	
		} else {	
			$('div#headline_img').hide();	
		}
	});

	// if OTHER selected
	$('#author').change(function(){
		var id = $('#author :selected').val();
		if (id == 0) {
			$('div#div_other').show();	
			$('input#other_author').focus();	
		} else {	
			$('div#div_other').hide();	
		}
	});

	// Youtube Window
	$('.optiontype').change(function(){
		var tipe = $(this).val();
		if (tipe == 'video') {
			$('div#div_youtube').show();
			$('input#div_youtube').focus();
		} else {
			$('div#div_youtube').hide();
		}
	});
	// Youtube ID
	$('#youtube_url').change(function() {
		var youtube_link = $(this).val();
		var code = youtube_link.substr(youtube_link.indexOf('v=') + 2,11);
		// alert(code);
		$("#youtube_key").val(code);
	});
	$('#youtube_url').keyup(function() {
		var youtube_link = $(this).val();
		var code = youtube_link.substr(youtube_link.indexOf('v=') + 2,11);
		// alert(code);
		$("#youtube_key").val(code);
	});
});
</script>

<script type="text/javascript">
$(function(){
  // use jQuery to add a listener for form submits
  $('#formID').submit(function(){
    var editorcontent = CKEDITOR.instances['editor1'].getData().replace(/<[^>]*>/gi, '');
    if (editorcontent.length){
      return true;
    }
    else{
      // alert (you'll want to use jQuery to make this nice!)
      alert('Content is required !');
      return false;
    }
  });
});
</script>