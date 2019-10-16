<div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Download&nbsp;/&nbsp;Data lainnya</span>
        </div>
    </div>

    <div class="main-content"><!--Main Content goes here-->
        <div class="container">
            <?php
                foreach ($files as $data) {
                    $path          = parseDateTime($data['doc_created_date']);
                    $download_link = $this->config->item('pdf_dir') . $path['year'] .'/'. $path['month'] .'/'. $path['day'] .'/'. $data['doc_id'] .'/'.$data['doc_file'];
                    $date = parseDateTime($data['doc_created_date']);
                    $showdate = $date['day_ind_name'] .' | '. $date['day'] .' '. $date['month_ind_name'] .' '. $date['year'];
                    ?>
                        <div class="lelang-single"><!--Informasi lelang single row-->
                            <div class="row">
                                <div class="col-lg-2">
                                    <a class="donlod-btn1" href="<?=$download_link?>"download>
                                        <img src="<?php echo $this->config->item('template_uri'); ?>images/donlod1.png">
                                        <img src="<?php echo $this->config->item('template_uri'); ?>images/donlod2.png">
                                    </a>
                                </div>

                                <div class="col-lg-10"><!--Lelang Caption-->
                                    <a href="<?=$download_link?>"download><p class="title"><?php echo htmlspecialchars_decode($data['doc_title']); ?></p></a>
                                    <p class="date"><?php echo $showdate; ?></p>
                                    <p class="text"><?php echo htmlspecialchars_decode($data['doc_summary']); ?></p>
                                    <a href="<?=$download_link?>" class="btn" title="Download" download> Download</a>
                                    <button type="button" class="btn popup_download" data-toggle="modal" data-target="#previewModal" data-download="<?php echo $download_link; ?>" data-title="<?php echo stripslashes($data['doc_title']); ?>">Preview</button>
                                </div>
                            </div>
                        </div><!--//Informasi lelang single row-->
                    <?php
                }
            ?>
            <center>
                <?php echo $pagination; ?>
            </center>

        </div>
    </div><!--//Main content-->

    <div class="up-btn"><!--Up Button-->
        <a href="#top">
            <img src="assets/img/up-btn.png">
            <img src="assets/img/up-btn2.png">
        </a>
    </div><!--//Up Button-->


    <!-- Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
              <iframe frameborder="0" width="860" height="570" src="" id="prev_content"></iframe>
          </div>
        </div>
      </div>
    </div>
