    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Kalkulator Kredit</span>
        </div>
    </div>

    <div class="main-content">
        <div class="container informasi">

          <div class="col-sm-6 simulasi-kredit">
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
                            <input id="flat" name="tipebunga" type="checkbox" value="flat" <?php echo ($EDIT['tipebunga']=='flat')? 'checked="checked"' : ''; ?>>
                            <label class="checkbox-inline" for="flat" title="Flat">Flat</label>
                          </div>
                          <div class="col-sm-4" style="padding:10px 0;">
                            <input id="efektif" name="tipebunga" type="checkbox" value="efektif" <?php echo ($EDIT['tipebunga']=='efektif')? 'checked="checked"' : ''; ?>>
                            <label class="checkbox-inline" for="efektif" title="efektif">Efektif</label>
                          </div>
                          <div class="col-sm-4" style="padding:10px 0;">
                            <input id="anuitas" name="tipebunga" type="checkbox" value="anuitas" <?php echo ($EDIT['tipebunga']=='anuitas')? 'checked="checked"' : ''; ?>>
                            <label class="checkbox-inline" for="anuitas" title="Anuitas">Anuitas</label>
                          </div>
                      </div>
                    </div>
                    <input name="calc" type="hidden" id="calc" value="Kalkulasi" />
                    <button type="submit" class="btn btn-default btn-kredit">Hitung Kalkulasi</button>
                  </form>
              </div>
          </div>
          <div class="col-sm-6 load-simulasi">
              <div class="informasi-galeri simulasi-details">
                  <div class="informasi-galeri-title"><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;Hasil Simulasi Kredit </div>
                  <form class="form-horizontal">
                      <div class="form-group">
                        <div class="col-sm-6">Total pinjaman</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            Rp. <?php echo (isset($EDIT['kredit']))? number_format($EDIT['kredit'], 0) : ''; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">Lama pinjaman</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            <?php echo $EDIT['waktu']; ?> Bulan
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">Bunga Pertahun</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            <?php echo $EDIT['bunga']; ?> %
                        </div>
                      </div>

                      <?php if ($EDIT['tipebunga']=='flat'){ ?>
                      <div class="form-group">
                        <div class="col-sm-6">Angsuran Pokok Perbulan</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            Rp. <?php echo number_format($angsuran_pokok, 0); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">Angsuran Bunga Perbulan</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            Rp. <?php echo number_format($angsuran_bunga, 0); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">Total angsuran per bulan</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            Rp. <?php echo number_format($angsuran_total, 0); ?>
                        </div>
                      </div>
                      <?php } ?>
                  </form>
              </div>
          </div>

          <?php if ($EDIT['tipebunga']=='flat'){ ?>
          
          <div class="col-sm-12 simulasi-kredit list">
                <h2>Cicilan Anda (Bunga FLAT)</h2>
                <table class="table table-bordered table-hover">
                    <tr class="info">
                        <th>Bulan</th>
                        <th>Bunga</th>
                        <th>Pokok</th>
                        <th>Angsuran</th>
                        <th>Sisa Pinjaman</th>
                    </tr>
                    
                    <?php 
                    for ($i=1; $i <= $lama; $i++) { 
                        $bln=1;
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo "Rp. ".number_format($angsuran_bunga, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($angsuran_pokok, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($angsuran_total, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($pinjaman - $angsuran_pokok, 0); ?></td>
                    </tr>

                    <?php
                      $bln++;
                      $pinjaman-=$angsuran_pokok;
                    }
                    ?>

                    <tr class="info">
                        <td><strong>Total</strong></td>
                        <td><strong><?php echo "Rp. ".number_format($angsuran_bunga*$lama, 0); ?></strong></td>
                        <td><strong><?php echo "Rp. ".number_format($angsuran_pokok*$lama, 0); ?></strong></td>
                        <td><strong><?php echo "Rp. ".number_format(($angsuran_pokok+$angsuran_bunga)*$lama, 0); ?></strong></td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <?php }elseif ($EDIT['tipebunga']=='efektif') { ?>
            
            <div class="col-sm-12 simulasi-kredit list">
                <h2>Cicilan Anda (Bunga EFEKTIF)</h2>
                <table class="table table-bordered table-hover">
                    <tr class="info">
                        <th>Bulan</th>
                        <th>Bunga</th>
                        <th>Pokok</th>
                        <th>Angsuran</th>
                        <th>Sisa Pinjaman</th>
                    </tr>
                    
                    <?php 
                    $bln = 1;
                    $efektif = 0;
                    for ($i=1; $i <= $lama; $i++) { 

                        if ($efektif==0){
                            $efektif=(($pinjaman*$bunga)/12)/100;
                        }
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo "Rp. ".number_format($efektif, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($angsuran_pokok, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($angsuran_pokok + $efektif, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($pinjaman - $angsuran_pokok, 0); ?></td>
                    </tr>

                    <?php
                      $bln++;
                      $tefektif+= $efektif;
                      $efektif=(($pinjaman-=$angsuran_pokok)*$bunga/12)/100;
                    }
                    ?>

                    <tr class="info">
                        <td><strong>Total</strong></td>
                        <td><strong><?php echo "Rp. ".number_format($tefektif, 0); ?></strong></td>
                        <td><strong><?php echo "Rp. ".number_format($angsuran_pokok*$lama, 0); ?></strong></td>
                        <td><strong><?php echo "Rp. ".number_format(($angsuran_pokok*$lama) + $tefektif, 0); ?></strong></td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <?php }elseif ($EDIT['tipebunga']=='anuitas') { 
            ?>

            <div class="col-sm-12 simulasi-kredit list">
                <h2>Cicilan Anda (Bunga ANUITAS)</h2>
                <table class="table table-bordered table-hover">
                    <tr class="info">
                        <th>Bulan</th>
                        <th>Bunga</th>
                        <th>Pokok</th>
                        <th>Angsuran</th>
                        <th>Sisa Pinjaman</th>
                    </tr>
                    
                    <?php 

                    $pinjaman = $EDIT['kredit'];
                    $lama     = $EDIT['waktu'];
                    $bunga    = $EDIT['bunga']/100;
                    $bpt      = ($pinjaman*($bunga/100)) / 12;
                    $pokok    = $pinjaman/$lama;
                    $saldo    = $pinjaman;
                    $a        = $bunga/12;
                    $b        = 1+$a;
                    $c        = $b^$lama;
                    $d        = 1/$c;
                    $e        = 1-$d;
                    $f        = 1/$e;
                    $g        = $pinjaman*-$a;
                    $h        = $g*$f;
                    $aa       = ($pinjaman*($bunga/12));
                    $bb       = 1-1/(1+$bunga/12)^$lama;
                    $cc       = $aa/$bb;
                    $dd       = ($pinjaman*($bunga/12))/(1-1/(1+$bunga/12)^$lama);
                    $ff       = ($pinjaman*($bunga/12));
                    $gg       = (1-1/(1+$bunga/12)^$lama)/100;
                    $hh       = $ff/$gg;
                    $ab       = 1+$bunga/12;
                    $bc       = pow($ab,$lama);
                    $de       = 1-1/$bc;
                    $ef       = $aa/$de;

                    $bln=1;
                    for ($i=1; $i <= $lama; $i++) { 
                      $bungabulanan = $saldo*$bunga/12;
                      $angsuran     = $ef-$bungabulanan;
                      $saldo        -= $angsuran;
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo "Rp. ".number_format($bungabulanan, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($angsuran, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($ef, 0); ?></td>
                        <td><?php echo "Rp. ".number_format($saldo, 0); ?></td>
                    </tr>

                    <?php
                      $bln++;
                      $tbungabulanan+=$bungabulanan;
                      $tsaldo+=$angsuran;
                    }
                    ?>

                    <tr class="info">
                        <td><strong>Total</strong></td>
                        <td><strong><?php echo "Rp. ".number_format($tbungabulanan, 0); ?></strong></td>
                        <td><strong><?php echo "Rp. ".number_format($tsaldo, 0); ?></strong></td>
                        <td><strong><?php echo "Rp. ".number_format(($tbungabulanan+$tsaldo), 0); ?></strong></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <?php }else{
            }
            ?>  

        </div>
    </div>
