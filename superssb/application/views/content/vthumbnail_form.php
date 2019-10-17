<style type="text/css">
	.file-preview-image {max-height:none;}
</style>

<?php 
	$akses = $this->session->userdata('privilege');

	$fields = array('c_id', 'c_created_date', 'c_publish_date','c_subtitle','c_title','c_slug','c_summary','c_content','c_images_content','c_images_thumbnail', 'c_images_caption','c_keyword','c_channel_id','c_feature','c_type','c_source','c_author','c_author_name','c_editor','c_hits','c_status');
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

	$BASEURL = $this->uri->segment(1);	// ruang_kita atau Tentang STR
	$action_url = site_url($BASEURL.'/create_thumbnail');
	$cancel_url = site_url($BASEURL);
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
	            	<div class="row">
		            	<div class="col-md-8">
			            	<div class="form-group">
			            		<i>Click and drag on the image to select an area. </i>
			            	</div>
			            	<div class="form-group">
				            	<?php $path = (empty($EDIT['c_created_date']))? '' : parseDateTime($EDIT['c_created_date']); ?>
				            	<img id="img_content" src="<?php echo base_url().'images-data/posts/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$EDIT['c_id'].'/'.$EDIT['c_images_content']; ?>" width="600" class='file-preview-image'>

				            </div>
		            	</div>
		            
		            	<div class="col-md-4">
			            	<div class="form-group">
			            		<i>Thumbnail Preview:</i>
			            	</div>
			            	<div class="form-group">
								<div id="preview_img"></div>
							</div>
		            	</div>
		            </div>

		            <div class="row">
		            	<div class="col-md-8">
		            		<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data">
			            	<div class="form-group">
								<input type="hidden" id="y1" class="y1" name="y" />
								<input type="hidden" id="x1" class="x1" name="x" />
								<input type="hidden" id="y2" class="y2" name="y1" />
								<input type="hidden" id="x2" class="x2" name="x1" />
								<input type="hidden" name="height" value="0" id="height" class="height" />
								<input type="hidden" name="width" value="0" id="width" class="width" />

								<input type="hidden" name="img_content" value="<?php echo $EDIT['c_images_content']?>" />
								<input type="hidden" name="img_thumbnail" value="<?php echo $EDIT['c_images_thumbnail']?>" />
								<input type="hidden" name="thumb_width" value="<?= $thumb_w ?>" />
		                        <input type="hidden" name="c_id" value="<?php echo $EDIT['c_id']?>">
		                        <input type="hidden" name="create_date" value="<?php echo $EDIT['c_created_date']?>">
		                        <input type="submit" id="save_thumb" class="btn btn-info" value="Crop Thumbnail"/>
		                        <a href="<?php echo $cancel_url; ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
		                    </div>
		                    </form>
	                    </div>
		            </div>
	            </div>
	        </section>
	    </div>
	</div>
</section>

<?php $path = (empty($EDIT['c_created_date']))? '' : parseDateTime($EDIT['c_created_date']); ?>


<script type="text/javascript">
function preview(img, selection) {
    var scaleX = <?= $thumb_w ?> / (selection.width || 1);
    var scaleY = <?= $thumb_h ?> / (selection.height || 1);

    $('.x1').val(selection.x1);
    $('.y1').val(selection.y1);
    $('.x2').val(selection.x2);
    $('.y2').val(selection.y2);
    $('.width').val(selection.width);
    $('.height').val(selection.height); 
    $('.width').val(selection.width);
    $('.height').val(selection.height);

    $('#preview_img img').css({
        width: Math.round(scaleX * $('#img_content').attr('width')),
        height: Math.round(scaleY * $('#img_content').attr('height')),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });
}

$(document).ready(function () {
	$('#preview_img').append('<img src="<?php echo base_url().'images-data/posts/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$EDIT['c_id'].'/'.$EDIT['c_images_content'] ?>" />')
		.css({
            position: 'relative',
            overflow: 'hidden',
            width: '<?= $thumb_w ?>px',
            height: '<?= $thumb_h ?>px'
		});
  	
  	$('#img_content').imgAreaSelect({ aspectRatio: '<?= $thumb_w ?>:<?= $thumb_h ?>', minWidth:<?= $thumb_w ?>, minHeight:<?= $thumb_h ?>, handles: true, onSelectChange: preview });


	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#width').val();
		var h = $('#height').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection image first");
			return false;
		}else{
			return true;
		}
	});
});
</script>