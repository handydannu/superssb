<style type="text/css">
	.file-preview { border:none;}
	.file-preview-frame { border:none; box-shadow: none; text-align: left; height: auto;}
	.file-preview-image { max-width: 50%; }
	.file-preview-frame:hover {
	    background-color: transparent;
	    box-shadow: none;
	}
</style>

<section class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumbs-alt">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                </li>
                <li>
                    <a class="active-trail active" href="javascript:;"><strong><?php echo strtoupper(str_replace('-', ' ', $this->uri->segment(1))) ?></strong></a>
                </li>
            </ul>
        </div>
    </div>

	<div class="row">
	    <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <strong>Ruang Kita</strong>
                     <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                </header>
                <div class="panel-body">
                	<div class="col-sm-6">
                	<form method="POST" enctype="multipart/form-data" action="<?php echo site_url('header_image/submit_ruang_kita') ?>">
	                	<input id="input-1" name="img" type="file" class="file" data-show-upload="false" data-show-remove="false">
	                	<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
                    <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                      <span>* Maximum size: <strong>100 Kb</strong></span><br />
                      <span>* Image Dimension: <strong>1200 X 195 pixel</strong></span><br />
                      <span>* File extension: <strong>JPEG (.jpg)</strong></span>
                    </span>
                	</form>
            		</div>
                </div>
            </section>
        </div>
	</div>

  <div class="row">
      <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <strong>Berita - Tentang STR</strong>
                     <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                </header>
                <div class="panel-body">
                  <div class="col-sm-6">
                  <form method="POST" enctype="multipart/form-data" action="<?php echo site_url('header_image/submit_tentang_str') ?>">
                    <input id="input-2" name="img" type="file" class="file" data-show-upload="false" data-show-remove="false">
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
                    <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                      <span>* Maximum size: <strong>100 Kb</strong></span><br />
                      <span>* Image Dimension: <strong>1200 X 195 pixel</strong></span><br />
                      <span>* File extension: <strong>JPEG (.jpg)</strong></span>
                    </span>
                  </form>
                </div>
                </div>
            </section>
        </div>
  </div>

	<div class="row">
	    <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <strong>Foto Galeri</strong>
                     <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                </header>
                <div class="panel-body">
                	<div class="col-sm-6">
                	<form method="POST" enctype="multipart/form-data" action="<?php echo site_url('header_image/submit_galeri') ?>">
	                	<input id="input-3" name="img" type="file" class="file" data-show-upload="false" data-show-remove="false">
	                	<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
                    <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                      <span>* Maximum size: <strong>100 Kb</strong></span><br />
                      <span>* Image Dimension: <strong>1200 X 195 pixel</strong></span><br />
                      <span>* File extension: <strong>JPEG (.jpg)</strong></span>
                    </span>
                	</form>
            		</div>
                </div>
            </section>
        </div>
	</div>

  <div class="row">
      <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <strong>Buletin</strong>
                     <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                </header>
                <div class="panel-body">
                  <div class="col-sm-6">
                  <form method="POST" enctype="multipart/form-data" action="<?php echo site_url('header_image/submit_buletin') ?>">
                    <input id="input-4" name="img" type="file" class="file" data-show-upload="false" data-show-remove="false">
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
                    <span class="help-block"><p><span class="label label-danger">NOTE!</span></p>
                      <span>* Maximum size: <strong>100 Kb</strong></span><br />
                      <span>* Image Dimension: <strong>1200 X 195 pixel</strong></span><br />
                      <span>* File extension: <strong>JPEG (.jpg)</strong></span>
                    </span>
                  </form>
                </div>
                </div>
            </section>
        </div>
  </div>

</section>

<script type="text/javascript">
var img_ruangkita = "<?php echo $this->config->item('images_posts_uri'); ?>header/ruang-kita/ruangkita_default.jpg";
var img_str       = "<?php echo $this->config->item('images_posts_uri'); ?>header/tentang-str/str_default.jpg";
var img_galeri    = "<?php echo $this->config->item('images_posts_uri'); ?>header/galeri/galeri_default.jpg";
var img_buletin   = "<?php echo $this->config->item('images_posts_uri'); ?>header/buletin/buletin_default.jpg";

$("#input-1").fileinput({
  initialPreview: ["<img src='"+img_ruangkita+"' class='file-preview-image' />"],
  showCaption: false,
  fileType: "any",
  previewFileType: "image",
  browseLabel: "Change",
  maxFileSize: 100,
    
  // overwriteInitial: false,
  // maxFilesNum: 10
});

$("#input-2").fileinput({
  initialPreview: ["<img src='"+img_str+"' class='file-preview-image' />"],
  showCaption: false,
  fileType: "any",
  previewFileType: "image",
  browseLabel: "Change",
  maxFileSize: 100,
    
  // overwriteInitial: false,
  // maxFilesNum: 10
});

$("#input-3").fileinput({
  initialPreview: ["<img src='"+img_galeri+"' class='file-preview-image' />"],
  showCaption: false,
  fileType: "any",
  previewFileType: "image",
  browseLabel: "Change",
  maxFileSize: 100,
    
  // overwriteInitial: false,
  // maxFilesNum: 10
});

$("#input-4").fileinput({
  initialPreview: ["<img src='"+img_buletin+"' class='file-preview-image' />"],
  showCaption: false,
  fileType: "any",
  previewFileType: "image",
  browseLabel: "Change",
  maxFileSize: 100,
    
  // overwriteInitial: false,
  // maxFilesNum: 10
});

</script>