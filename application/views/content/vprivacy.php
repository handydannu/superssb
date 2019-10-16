<!-- BREADCRUMB -->
<div class="breadcrumb-temp">
    <div class="container">
        <span class="canal-title">Home</span><span class="canal-subtitle">&nbsp;/&nbsp;PRIVACY AND POLICY</span>
    </div>
</div>
<!-- BREADCRUMB END -->

<div class="main-content"><!--Main Content goes here-->
        <div class="container2" style="background-image: url(https://banksulselbar.co.id/assets/img/bg3.png);background-position:left-top;background-repeat:repeat-x">
          <div class="row">
            <div class="col-md-8">
                <div class="berita-single">
                    <div class="row">
                        <div class="berita-detail-title">
                                 <h4 style="margin-bottom:5px"><i class="fa fa-caret-right" aria-hidden="true">PRIVACY AND POLICY</i></h4>
                            
                            <h1 style="margin-top:0">Kebijakan Privasi untuk Bank Sulselbar</h1>
                            
                        </div>

                        <hr style="border-top: 1px dotted #9ec53b;"/>

                        <div class="berita-content">
                            <p>Jika Anda memerlukan informasi lebih lanjut atau memiliki pertanyaan tentang kebijakan privasi kami, jangan ragu untuk menghubungi kami melalui email di Privasi.<br/>
                            Di banksulselbar.co.id kami menganggap privasi pengunjung kami menjadi sangat penting. Dokumen kebijakan privasi ini menjelaskan secara rinci jenis informasi pribadi yang dikumpulkan dan dicatat oleh banksulselbar.co.id dan bagaimana kami menggunakannya.</p>

                            <h4>File Log</h4>
                            <p>
                                Seperti banyak situs web lain, banksulselbar.co.id memanfaatkan file-file log. File-file ini hanya log pengunjung ke situs - biasanya prosedur standar untuk perusahaan hosting dan bagian dari analisis layanan hosting. Informasi di dalam file log termasuk alamat protokol internet (IP), jenis peramban, Penyedia Layanan Internet (ISP), cap tanggal / waktu, halaman pengarah / keluar, dan mungkin jumlah klik. Informasi ini digunakan untuk menganalisis tren, mengelola situs, melacak pergerakan pengguna di sekitar situs, dan mengumpulkan informasi demografis. Alamat IP, dan informasi lain semacam itu tidak terkait dengan informasi apa pun yang dapat diidentifikasi secara pribadi.
                            </p>

                            <h4>Cookie dan Web Beacon</h4>
                             <p>
                                banksulselbar.co.id tidak menggunakan cookies.
                            </p>

                             <h4>Kebijakan Privasi.</h4>
                             <p>
                                Anda dapat berkonsultasi daftar ini untuk menemukan kebijakan privasi untuk masing-masing mitra iklan dari banksulselbar.co.id.
                                <br/>
                                Server iklan atau jaringan iklan pihak ketiga ini menggunakan teknologi di masing-masing iklan dan tautannya yang muncul di banksulselbar.co.id dan yang dikirim langsung ke browser Anda. Mereka secara otomatis menerima alamat IP Anda saat ini terjadi. Teknologi lain (seperti cookie, JavaScript, atau Web Beacons) juga dapat digunakan oleh jaringan iklan pihak ketiga situs kami untuk mengukur efektivitas kampanye iklan mereka dan / atau untuk mempersonalisasi konten iklan yang Anda lihat di situs.
                                <br/>
                                banksulselbar.co.id tidak memiliki akses atau kontrol atas cookies yang digunakan oleh pengiklan pihak ketiga.
                            </p>

                            <h4>Kebijakan Privasi Pihak Ketiga</h4>
                             <p>
                                Anda harus berkonsultasi dengan kebijakan privasi masing-masing dari server iklan pihak ketiga ini untuk informasi lebih rinci tentang praktik mereka serta untuk petunjuk tentang cara memilih keluar dari praktik-praktik tertentu. kebijakan privasi bankulselbar.co.id tidak berlaku untuk, dan kami tidak dapat mengontrol aktivitas, seperti pengiklan atau situs web lainnya. Anda dapat menemukan daftar lengkap dari kebijakan privasi ini dan tautannya di sini: Tautan Kebijakan Privasi.
                                <br/>
                                Jika Anda ingin menonaktifkan cookie, Anda dapat melakukannya melalui opsi peramban individual Anda. Informasi lebih rinci tentang manajemen cookie dengan browser web tertentu dapat ditemukan di situs web masing-masing browser. Apakah Cookies itu?
                            </p>

                            <h4>Persetujuan</h4>
                             <p>
                                Dengan menggunakan situs web kami, Anda dengan ini menyetujui kebijakan privasi kami dan menyetujui ketentuan-ketentuannya
                            </p>

                        </div>
                        <br/>                        
                    </div>        
                </div>
            </div>

            <div class="col-md-4 berita-video-foto">
              
                <!-- Simulasi Kredit -->
                <div class="simulasi-kredit">
                    <div class="kredit-title">SIMULASI KREDIT</div>
                    <div class="kredit-content">
                      <form role="form" id="formID" action="<?php echo site_url('kalkulator-kredit'); ?>" method="post">
                        <div class="form-group">
                          <label for="">Jumlah Kredit:</label>
                          <input type="input" class="form-control" name="kredit" id="kredit" value="<?php echo $EDIT['kredit'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="This field is required!">
                        </div>
                        <div class="form-group row">
                          <div class="col-xs-9">
                            <label for="">Jangka Waktu:</label>
                            <input type="input" class="form-control" name="waktu" id="waktu" size="5" value="<?php echo $EDIT['waktu'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="This field is required!">
                          </div>
                          <label class="control-label col-xs-3 label-prefix" for="">(Bulan)</label>
                        </div>
                        <div class="form-group row">
                          <div class="col-xs-9">
                            <label for="">Bunga Pertahun:</label>
                            <input type="input" class="form-control" name="bunga" id="bunga" size="4" value="<?php echo $EDIT['bunga'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="This field is required!">
                          </div>
                          <label class="control-label col-xs-1 label-prefix percent" for="">%</label>
                        </div>
                        <div class="form-group">
                          <label for="">Perhitungan Suku Bunga :</label><br/>
                          <div class="row">
                              <div class="col-sm-4" style="padding:10px 0;">
                                <input id="flat" name="tipebunga" type="checkbox" value="flat">
                                <label class="checkbox-inline" for="flat" title="Flat">Flat</label>
                              </div>
                              <div class="col-sm-4" style="padding:10px 0;">
                                <input id="efektif" name="tipebunga" type="checkbox" value="efektif">
                                <label class="checkbox-inline" for="efektif" title="Efektif">Efektif</label>
                              </div>
                              <div class="col-sm-4" style="padding:10px 0;">
                                <input id="anuitas" name="tipebunga" type="checkbox" value="anuitas">
                                <label class="checkbox-inline" for="anuitas" title="Anuitas">Anuitas</label>
                              </div>
                          </div>
                        </div>
                        <input name="calc" type="hidden" id="calc" value="Kalkulasi" />
                        <button type="submit" class="btn btn-default btn-kredit">Hitung Kalkulasi</button>
                      </form>
                    </div>
                </div>
                <!-- End Simulasi Kredit -->

                <!-- Video -->
                <div class="home-video">
                  <h4 class="title">Video</h4>
                  <a href="<?=site_url('video')?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>

                  <?php
                    foreach ($video as $post) {
                        $path  = parseDateTime($post['c_created_date']);
                        $url   = base_url() . 'video/read/'. $path['year'].$path['month'] .$path['day'] .'/'. $post['c_id'] .'/'. $post['c_slug'];
                        $image = $this->config->item('images_posts_uri') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $post['c_id'] .'/'. $post['c_images_thumbnail'];

                        ?>
                            <a href="galeri-video.html">
                              <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                  <div class="galeri-thumbnail-veil">
                                      <!-- <i class="fa fa-play-circle fa-3x" aria-hidden="true"></i> -->
                                      <img class="play" src="<?php echo $this->config->item('template_uri');?>img/play-btn.png" />
                                  </div>
                                  <img src="<?php echo $image; ?>">
                              </div><!--//Galeri Thumbnail-->
                            </a>
                            <a href="#" style="color:#316fc4;"><p style="margin-top:5px"><?php echo $post['c_title']; ?></p></a>
                        <?php
                    }
                  ?>

                </div>
                <br/>
                <!-- End Video -->

                <div class="home-video foto">
                  <h4 class="title">FOTO</h4>
                  <a href="<?php echo site_url('foto')?>" style="color: #a5a5a5" class="more-btn-right">[more]</a>
                  <div class="carousel slide" id="myCarousel2"><!--slider-->
                    <div class="carousel-inner">
                      <?php
                        $total = count($foto);
                        if($foto > 0) {
                            $no = 1;
                            for($i=0; $i < $total; $i++){
                                $photo          = $foto[$i];
                                $path           = parseDateTime($photo['album_created_date']);
                                $image          = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images'];
                                $image_thumb    = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['ph_album_id'].'/'.$photo['ph_images_thumbnail'];
                                $url            = base_url() . 'foto/read/'. $path['year'].$path['month'] .$path['day'].'/'.$photo['album_id'].'/'.$photo['album_title'];
                                $cls = "";
                                if($no==1) {
                                    $cls = "active";
                                }
                                ?>
                                <div class="item slide<?php echo $no?> <?php echo $cls?>" id="slide<?php echo $no?>">
                                  <a href="<?=$url?>">
                                    <div class="galeri-thumbnail-single"><!--Galeri Thumbnail-->
                                      <div class="galeri-thumbnail-veil">
                                        <p>
                                          <?php echo $photo['ph_title']?>
                                        </p>
                                      </div>
                                      <img src="<?php echo $image;?>">
                                    </div><!--//Galeri Thumbnail-->
                                  </a>
                                </div>
                            <?php
                            $no++;
                            }
                        }
                      ?>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="javascript:void(0)" data-slide="prev" data-target="#myCarousel2">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </a>
                    <a class="right carousel-control" href="javascript:void(0)" data-slide="next" data-target="#myCarousel2">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                  </div><!--//slider-->
                </div>
                <!-- End Foto -->

                <!-- Links -->
                <h4 class="title">LINKS</h4>
                <div class="home-links">
                  <a href="http://www.bi.go.id/web/id/Perbankan/Arsitektur+Perbankan+Indonesia/edukasimasyarakat.htm" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link1.png" /></a>
                  <a href="http://www.bi.go.id/web/id/Perbankan/Arsitektur+Perbankan+Indonesia/edukasimasyarakat.htm" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link2.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link3.png" /></a>
                  <a href="http://www.bi.go.id" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link4.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link5.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link6.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link7.png" /></a>
                  <a href="javascript:void(0)"><img src="<?php echo $this->config->item('template_uri');?>img/link8.png" /></a>
                  <a href="https://sikepo.ojk.go.id/sikepo" target="_blank"><img src="<?php echo $this->config->item('template_uri');?>img/link9.png" /></a>
                </div>
                <!-- End Links -->
              </div>

            </div>
        </div>
    </div><!--//Main content-->