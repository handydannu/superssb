    <div class="breadcrumb-temp">
      <div class="container">
        <span class="canal-title">Testimoni</span>
      </div>
    </div>

    <div class="main-content">
        <div class="container testimoni">

          <div class="testimoni-wrapper">
          <?php
                if($this->session->flashdata('success')) {
                  echo '
                  <div class="alert alert-success alert-dismissible" style="text-align:center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('success').'</div> 
                  ';
                }
                if($this->session->flashdata('error')) {
                  echo '
                  <div class="alert alert-danger alert-dismissible" style="text-align:center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('error').'</div> 
                  ';
                }
              ?>
          <?php 
          foreach ($testimoni as $key) {
            $date = parseDateTime($key['testimoni_created']);
            $showdate = $date['day_ind_name']. ' | '.$date['day'].' '.$date['month_ind_name'].' '.$date['year'];
            $img = $this->config->item('images_testi_uri') . $key['testimoni_id'] .'/'.$key['testimoni_image'];
          ?>
            <div class="testimoni-single"><!--Testimoni Single-->

              <div class="col-sm-2 testi-photo">
                <img src="<?php echo $img; ?>" width="117" height="114" onError="this.src='<?php echo images_uri(); ?>default-profile.jpg'">
              </div>

              <div class="col-sm-10 testi-box">
                <div class="petik-kanan"><img src="<?php echo $this->config->item('template_uri');?>images/petik.png"></div>
                <div class="petik-kiri"><img src="<?php echo $this->config->item('template_uri');?>images/petik-rev.png"></div>
                <div class="testi-arrow"></div>
                <div class="testi-isi">
                  <div class="testi-single-name"> <?php echo stripslashes($key['testimoni_name']); ?> &nbsp;<span class="testi-tag">|&nbsp; <?php echo $key['testimoni_about']; ?></span></div>
                  <div class="testi-content">
                    <blockquote>
                      <?php echo html_entity_decode($key['testimoni_content']); ?>
                    </blockquote>
                  </div>
                  <div class="testi-single-date"><?php echo $showdate; ?></div>
                </div>
              </div>

            </div><!--//Testimoni Single-->

            <?php } ?>

            <div id="content"></div>

          </div>

          <center>
            <!-- <div><img src="<?php echo $this->config->item('template_uri');?>images/loading-blue.gif"></div> -->
            <div class="load-more" id="loadmore" data-totalpage="<?php echo $total_pages; ?>">
              <a href="javascript:;">LOAD MORE</a>
            </div>
          </center>

          <!--Tambah testimoni-->

          <div class="col-lg-12 tambah-testimoni"><!--Forms-->
            <center>
              <h3>Submit a Testimonial</h3>
            </center>
            <?php 
              $attributes = array('id' => 'formID');
              echo form_open_multipart('testimoni/add', $attributes)?>
              <div class="forms testimoni-forms">
              <div class="form-group">
                <label for="name">Nama Lengkap:</label>
                <input type="text" class="form-control" id="name" name="testimoni_name" data-validation-engine="validate[required]" data-errormessage-value-missing="Full Name is required!">
              </div>
              <div class="form-group">
                <label for="email">Email Anda:</label>
                <input type="email" class="form-control" id="email" name="testimoni_email" data-validation-engine="validate[required, custom[email]]" data-errormessage-value-missing="Email is required!">
              </div>
              <div class="form-group">
                <label for="name">Tentang Anda:</label>
                <input type="text" class="form-control" id="name" name="testimoni_about" data-validation-engine="validate[required]" data-errormessage-value-missing="About You is required!">
              </div>
              <div class="form-group">
                <label for="name">Alamat:</label>
                <input type="text" class="form-control" id="name" name="testimoni_alamat" data-validation-engine="validate[required]" data-errormessage-value-missing="Address is required!">
              </div>
              <div class="form-group">
                <label for="name">Website:</label>
                <input type="text" class="form-control" id="name" name="testimoni_website" data-validation-engine="validate[required]" data-errormessage-value-missing="Contact Person is required!">
              </div>
              <div class="form-group block-local-image">
                  <label for="file-ib">Foto Anda:</label>
                  <input id="file-1b" type="file" multiple=true class="file" data-show-upload="false" name="userfile">                          
              </div>
              <div class="form-group">
                  <?php echo $data['captcha'] // tampilkan recaptcha ?>
              </div><br/>
              <div class="form-group">
                <label for="comment">Testimoni anda</label>
                <textarea class="form-control" rows="5" id="comment" name="testimoni_content" placeholder="Ketik disini..." data-validation-engine="validate[required]" data-errormessage-value-missing="Content is required!"></textarea>
              </div>
              <button type="submit" class="btn btn-default btn-fullwidth" name="save">KIRIM</button>
            </div>
            <?php echo form_close();?>
            
          </div><!--//Forms-->

          <!--//Tambah-->

        </div>
    </div>
<script type="text/javascript">

$("#file-1b").fileinput({
  
  browseClass: "btn btn-success",
  browseLabel: "Pick Image",
  browseIcon: '<i class="fa fa-fw fa-folder-open-o"></i>',
  removeClass: "btn btn-danger",
  removeLabel: "Delete",
  removeIcon: '<i class="fa fa-fw fa-trash-o"></i>',
  maxFileSize: 50,
    
  // overwriteInitial: false,
  // maxFilesNum: 10
});
</script>