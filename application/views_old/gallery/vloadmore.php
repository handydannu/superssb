                <!-- <div class="gallery"> -->
                    <?php // ------------------ 1st Row -------------------- ?>
                	<div class="row">
                        <?php 
                            $total = count($albums);
                            $first = ($total <=3)? $total : '3' ;
                            for ($i=0; $i < $first; $i++) { 
                                $photo = $albums[$i];
                                $path  = parseDateTime($photo['album_created_date']);
                                $image = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['album_id'].'/'.$photo['ph_images'];
                                $url   = base_url(). 'gallery/read/'.$path['year'].$path['month'].$path['day']. '/'. $photo['album_id'] .'/'. $photo['album_slug'];
                                          
                                switch ($i) {
                                    case '0':
                                        $class_bootstrap = 'col-md-3 col-sm-3 col-xs-12';
                                        break;

                                    case '1':
                                        $class_bootstrap = 'col-md-6 col-sm-6 col-xs-12';
                                        break;

                                    case '2':
                                        $class_bootstrap = 'col-md-3 col-sm-3 col-xs-12';
                                        break;
                                    
                                    default:
                                        $class_bootstrap = '';
                                        break;
                                }
                        ?>
                		<div class="<?php echo $class_bootstrap ?>">
                        	<a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo $image; ?>" class="img-responsive img-caption-bg" data-caption="&nbsp;" alt="<?php echo $photo['ph_title']; ?>" />
                            <div class="caption">
                            	<div class="category"><span>PR Bandung</span></div>
                                <div class="description"><?php echo $photo['ph_title']; ?></div>
                                <div class="date"><?php echo $photo['ph_photographer']; ?> • 13 Mar '15</div>
                            </div></a>
                        </div>

                        <?php } ?>
                    </div>

                    <?php // ------------------ 2nd Row --------------------
                    if (!empty($albums[3])){
                    ?>
                    <div class="row">
                        <?php 
                        $second = ($total <5)? $total : '5' ;
                        for ($i=3; $i < $second; $i++) { 
                                $photo = $albums[$i];
                                $path  = parseDateTime($photo['album_created_date']);
                                $image = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['album_id'].'/'.$photo['ph_images'];
                                $url   = base_url(). 'gallery/read/'.$path['year'].$path['month'].$path['day']. '/'. $photo['album_id'] .'/'. $photo['album_slug'];
                                          
                                switch ($i) {
                                    case '3':
                                        $class_bootstrap = 'col-md-5 col-sm-5 col-xs-12';
                                        break;
                                    case '4':
                                        $class_bootstrap = 'col-md-7 col-sm-7 col-xs-12';
                                        break;                                    
                                    default:
                                        $class_bootstrap = '';
                                        break;
                                }
                        ?>
                    	<div class="<?php echo $class_bootstrap; ?>">
                        	<a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo $image; ?>" class="img-responsive img-caption-bg" data-caption="&nbsp;" alt="" />
                            <div class="caption">
                            	<div class="category"><span>PR Surabaya</span></div>
                                <div class="description"><?php echo $photo['ph_title']; ?></div>
                                <div class="date"><?php echo $photo['ph_photographer']; ?> • 13 Mar '15</div>
                            </div></a>
                        </div>
                       
                    <?php } ?>
                </div>
                    <?php } ?>

                    <?php // ------------------ 3rd Row -------------------- 
                    if (!empty($albums[5])){
                    ?>
                     <div class="row">
                        <?php 
                        for ($i=5; $i < $total; $i++) { 
                                $photo = $albums[$i];
                                $path  = parseDateTime($photo['album_created_date']);
                                $image = $this->config->item('images_data').'photos/'.$path['year'].'/'.$path['month'].'/'.$path['day'].'/'.$photo['album_id'].'/'.$photo['ph_images'];
                                $url   = base_url(). 'gallery/read/'.$path['year'].$path['month'].$path['day']. '/'. $photo['album_id'] .'/'. $photo['album_slug'];
                                          
                                switch ($i) {
                                    case '5':
                                        $class_bootstrap = 'col-md-7 col-sm-7 col-xs-12';
                                        break;
                                    case '6':
                                        $class_bootstrap = 'col-md-5 col-sm-5 col-xs-12';
                                        break;                                    
                                    default:
                                        $class_bootstrap = '';
                                        break;
                                }
                        ?>
                    	<div class="<?php echo $class_bootstrap; ?>">
                        	<a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo $image; ?>" class="img-responsive img-caption-bg" data-caption="&nbsp;" alt="" />
                            <div class="caption">
                            	<div class="category"><span>PR Bandung</span></div>
                                <div class="description"><?php echo $photo['ph_title']; ?></div>
                                <div class="date"><?php echo $photo['ph_photographer']; ?> • 13 Mar '15</div>
                            </div></a>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <!-- </div> -->