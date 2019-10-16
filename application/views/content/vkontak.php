<div class="breadcrumb-temp">
      <div class="container">
        <span class="canal-title">Kontak</span><span class="canal-subtitle"> </span>
      </div>
    </div>

    <div class="main-content"><!--Main Content goes here-->
        <div class="container kontak">
            <div id="message"></div>

            

            <div class="contact-forms">
                <div class="row">

                    <div class="col-lg-8"><!--Forms-->
                        <div class="forms">
                            <?php
                            if($this->session->flashdata('success')) {
                              echo '
                              <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('success').'</div>
                              ';
                            }
                            if($this->session->flashdata('error')) {
                              echo '
                              <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('error').'</div>
                              ';
                            }
                            ?>

                            <?php
                            $attributes = array('id' => 'formID');
                            echo form_open_multipart('kontak/add', $attributes)?>
                              <div class="form-group">
                                <label for="name">Nama Lengkap:</label>
                                <input type="text" class="form-control" id="name" name="contact_name" data-validation-engine="validate[required]" data-errormessage-value-missing="Contact Person is required!">
                              </div>
                              <div class="form-group">
                                <label for="email">Email Anda:</label>
                                <input type="email" class="form-control" id="email" name="contact_email" data-validation-engine="validate[required, custom[email]]" data-errormessage-value-missing="Email is required!">
                              </div>
                              <div class="form-group">
                                <label for="judul">Judul:</label>
                                <input type="text" class="form-control" id="judul" name="contact_title" data-validation-engine="validate[required]" data-errormessage-value-missing="Judul is required!">
                              </div>
                              <div class="form-group">
                                <label for="comment">Pesan anda</label>
                                <textarea class="form-control" rows="5" id="comment" name="contact_content" placeholder="Ketik disini..." data-validation-engine="validate[required]" data-errormessage-value-missing="Pesan is required!"></textarea>
                              </div>
                              <button type="submit" class="btn btn-default">KIRIM</button>
                            <?php echo form_close();?>
                        </div>
                    </div><!--//Forms-->

                    <div class="col-lg-4"><!--Address and Phone-->
                      <div class="row">

                        <div class="col-md-12 col-sm-6">
                          <img class="img-responsive call-img" src="<?php echo $this->config->item('template_uri');?>img/call-center.jpg" />
                        </div>
                        <div class="col-md-12 col-sm-6">
                          <div class="get-in-touch">
                              <span class="kontak-title">GET IN TOUCH</span>
                              <span class="kontak-text">
                                  Jl. Dr. Sam Ratulangi No. 16 Makassar 90125<br/>
                                  T. (+62411) 859 171<br/>
                                  F. (+62411) 854 611
                              </span>
                          </div>
                        </div>

                      </div>
                    </div><!--//Address and Phone-->

                </div>
            </div>

            <div class="map-wrapper"><!--Google Maps-->
                <iframe style ="pointer" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.785586450616!2d119.4074607148437!3d-5.138192853403248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbf02ae82311a2b%3A0xac0bb20e17aa3314!2sKantor+Cabang+Barru+Bank+Sulsel!5e0!3m2!1sen!2s!4v1469592708040" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div><!--//Google Maps-->
        </div>
    </div>
