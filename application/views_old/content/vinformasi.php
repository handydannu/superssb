    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Informasi</span>
        </div>
    </div>

    <div class="main-content">
        <div class="container informasi">

            <div class="informasi-content">
                <div class="row">

                    <div class="col-lg-8 highlight-galeri">

                        <div class="informasi-highlight">

                            <div class="row">

                                <div class="highlight-sign">
                                    HIGHLIGHT
                                </div>

                                <?php
                                $post = $berita[0];
                                $path = parseDateTime($post['c_created_date']);
                                $image_url = $this->config->item('images_posts_uri') . $path['year'] .'/'.$path['month'].'/'.$path['day'].'/'.$post['c_id'] .'/'.$post['c_images_thumbnail'];

                                $date     = parseDateTime($post['c_publish_date']);
                                $b_url    = base_url() . 'read/'. $date['year'].$date['month'].$date['day']. '/' .$post['c_id'].'/'.$post['c_slug'];
                                $showdate = $date['day_ind_name'] .', '.$date['day'].' '.$date['month_ind_name'].' '.$date['year'];
                                ?>

                                <div class="informasi-highlight-single">

                                    <div class="col-lg-5">
                                        <a href="<?php echo $b_url; ?>"><img src="<?php echo $image_url; ?>" width="266" height="175" onError="this.src='<?php echo images_uri(); ?>logo-banksulselbar-sm.jpg'"></a>
                                    </div>

                                    <div class="col-lg-7">
                                        <a href="<?php echo $b_url; ?>"><div class="highlight-title"> <?php echo stripslashes($post['c_title']); ?> </div></a>
                                        <div class="highlight-date"> <?php echo $showdate; ?> </div>
                                        <div class="highlight-text"> <?php echo html_entity_decode($post['c_summary']); ?> </div>
                                        <div class="more-button">
                                            <a href="<?php echo site_url('berita'); ?>"><span>more</span>&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="informasi-galeri">

                            <div class="informasi-galeri-title"><i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;GALERI</div>

                            <div class="row">

                                <?php
                                foreach ($photos as $photo) {
                                    $path  = parseDateTime($photo['album_created_date']);
                                    $image = $this->config->item('images_photo_uri').$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['album_id'].'/'.$photo['ph_images_thumbnail'];
                                    $url   = base_url(). 'foto/read/'.$path['year'].$path['month'].$path['day']. '/'. $photo['album_id'] .'/'. $photo['album_slug'];
                                ?>

                                <div class="col-lg-4"><!--Galeri Single Box-->
                                    <a href="<?php echo $url; ?>">
                                        <div class="galeri-thumbnail-single">
                                            <div class="galeri-thumbnail-veil">
                                                <p><?php echo stripslashes($photo['album_title']); ?></p>
                                            </div>
                                            <img src="<?php echo $image; ?>" width="240" height="140">
                                        </div>
                                    </a>
                                </div>

                                <?php } ?>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 simulasi-kredit">

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
                                <div class="col-xs-10">
                                  <label for="">Bunga Pertahun:</label>
                                  <input type="input" class="form-control" name="bunga" id="bunga" size="4" value="<?php echo $EDIT['bunga'] ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="This field is required!">
                                </div>
                                <label class="control-label col-xs-2 label-prefix percent" for="">%</label>
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

                </div>
            </div>

            <div class="pembatas-line"><!--Garis Pembatas-->
                <div class="pembatas-text">
                    <i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Download&nbsp;
                </div>
            </div>

            <div class="download-links-wrapper">

                <div class="row">

                    <div class="col-lg-4">
                        <a href="<?php echo site_url('download/pengumuman-lelang'); ?>" class="donlod"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon1.png"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon12.png"></a>
                        <a href="<?php echo site_url('download/pengumuman-lelang'); ?>"><p>Pengumuman Lelang</p></a>
                    </div>

                    <div class="col-lg-4">
                        <a href="<?php echo site_url('download/laporan-tahunan'); ?>" class="donlod"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon2.png"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon22.png"></a>
                        <a href="<?php echo site_url('download/laporan-tahunan'); ?>"><p>Laporan Tahunan</p></a>
                    </div>

                    <div class="col-lg-4">
                        <a href="<?php echo site_url('download/laporan-keuangan-publikasi'); ?>" class="donlod"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon3.png"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon32.png"></a>
                        <a href="<?php echo site_url('download/laporan-keuangan-publikasi'); ?>"><p>Laporan Keuangan Publikasi</p></a>
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-4">
                        <a href="<?php echo site_url('download/sbdk'); ?>" class="donlod"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon4.png"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon42.png"></a>
                        <a href="<?php echo site_url('download/sbdk'); ?>"><p>Suku Bunga Dasar Kredit (SBDK)</p></a>
                    </div>

                    <div class="col-lg-4">
                        <a href="<?php echo site_url('download/gcg'); ?>" class="donlod"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon5.png"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon52.png"></a>
                        <a href="<?php echo site_url('download/gcg'); ?>"><p>Good Corporate Governance (GCG)</p></a>
                    </div>

                    <div class="col-lg-4">
                        <a href="<?php echo site_url('download/other'); ?>" class="donlod"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon6.png"><img src="<?php echo $this->config->item('template_uri'); ?>images/download-icon62.png"></a>
                        <a href="<?php echo site_url('download/other'); ?>"><p>Data Lain</p></a>
                    </div>

                </div>

            </div>

            <div class="pembatas-line"><!--Garis Pembatas-->
                <div class="pembatas-text">
                   <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Agenda Kegiatan&nbsp;
                </div>
            </div>

            <div class="row row2-wrapper">
                <div class="col-xs-12">
                    <div class="widget widget-agenda">
                        <div class="widget-content">
                            <div class="agenda-wrapper">
                                <div id='calendar'></div>
                                <!-- <div class="col-lg-8">
                                    <div class="row agenda-title">
                                        <h2><a href="#"><i class="fa fa-angle-left"></i></a>August 2016<a href="#"><i class="fa fa-angle-right"></i></a></h2>
                                    </div>
                                    <div class="row agenda-day">
                                        <ul>
                                            <li class="agenda-day-single">S</li>
                                            <li class="agenda-day-single">M</li>
                                            <li class="agenda-day-single">T</li>
                                            <li class="agenda-day-single">W</li>
                                            <li class="agenda-day-single">T</li>
                                            <li class="agenda-day-single">F</li>
                                            <li class="agenda-day-single">S</li>
                                        </ul>
                                    </div>
                                    <div class="row agenda-date">
                                        <ul>
                                            <li class="agenda-date-single"><a href="#">1</a></li>
                                            <li class="agenda-date-single"><a href="#">2</a></li>
                                            <li class="agenda-date-single"><a href="#">3</a></li>
                                            <li class="agenda-date-single"><a href="#">4</a></li>
                                            <li class="agenda-date-single"><a href="#">5</a></li>
                                            <li class="agenda-date-single"><a href="#">6</a></li>
                                            <li class="agenda-date-single"><a href="#">7</a></li>
                                            <li class="agenda-date-single"><a href="#">8</a></li>
                                            <li class="agenda-date-single"><a href="#">9</a></li>
                                            <li class="agenda-date-single"><a href="#">10</a></li>
                                            <li class="agenda-date-single"><a href="#">11</a></li>
                                            <li class="agenda-date-single"><a href="#">12</a></li>
                                            <li class="agenda-date-single"><a href="#">13</a></li>
                                            <li class="agenda-date-single"><a href="#">14</a></li>
                                            <li class="agenda-date-single"><a href="#">15</a></li>
                                            <li class="agenda-date-single"><a href="#">16</a></li>
                                            <li class="agenda-date-single"><a href="#">17</a></li>
                                            <li class="agenda-date-single"><a href="#">18</a></li>
                                            <li class="agenda-date-single"><a href="#">19</a></li>
                                            <li class="agenda-date-single"><a href="#">20</a></li>
                                            <li class="agenda-date-single"><a href="#">21</a></li>
                                            <li class="agenda-date-single"><a href="#">21</a></li>
                                            <li class="agenda-date-single"><a href="#">22</a></li>
                                            <li class="agenda-date-single"><a href="#">23</a></li>
                                            <li class="agenda-date-single"><a href="#">24</a></li>
                                            <li class="agenda-date-single"><a href="#">25</a></li>
                                            <li class="agenda-date-single"><a href="#">26</a></li>
                                            <li class="agenda-date-single"><a href="#">27</a></li>
                                            <li class="agenda-date-single"><a href="#" class="agenda-date-active">28</a></li>
                                            <li class="agenda-date-single"><a href="#">29</a></li>
                                            <li class="agenda-date-single"><a href="#">30</a></li>
                                            <li class="agenda-date-single"><a href="#">31</a></li>
                                        </ul>
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-4">
                                    <h1>Month</h1>
                                    <h2>Friday</h2>
                                    <div class="agenda-detail-wrapper">
                                        <div class="agenda-detail-event">
                                            <p>Seminar Nasional "PROSPEK PERBANKAN dan BISNIS PROPERTI di TENGAH TANTANGAN MENJAGA MOMENTUM PERTUMBUHAN"</p>
                                        </div>
                                        <div class="agenda-detail-date">
                                            <p>Jumat, 28 Nov 2015</p>
                                        </div>
                                        <div class="agenda-detail-time">
                                            <p><span>08.00</span> - 17.00</p>
                                        </div>
                                        <div class="agenda-detail-venue">
                                            <p>Hotel JW Marriot, Jakarta</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
