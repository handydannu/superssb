    <div class="breadcrumb-temp">
        <div class="container">
            <span class="canal-title">Informasi</span><span class="canal-subtitle">&nbsp;/&nbsp;Kredit</span>
        </div>
    </div>

    <div class="main-content"><!--Main Content goes here-->
      <div class="container tabel">

          <div class="row">
            <div class="col-lg-12">
              <div class="table-title">
                <h4>HASIL HITUNG KREDIT ANDA</h4>
              </div>
            </div>
          </div>

          <div class="table-content">

              <table class="kredit-detail" width="350px" style="border:0!important;background:transparent!important;margin-bottom: 30px;width:unset;line-height: 2;">
                <tr>
                  <td><strong>Pinjaman Anda</strong></td>
                </tr>
                <tr>
                  <td>Total pinjaman</td>
                  <td>:&nbsp;</td>
                  <td>Rp. <?php echo (isset($EDIT['kredit']))? number_format($EDIT['kredit'], 0) : ''; ?></td>
                </tr>
                <tr>
                  <td>Lama Pinjaman</td>
                  <td>:&nbsp;</td>
                  <td><?php echo $EDIT['waktu']; ?> Bulan</td>
                </tr>
                <tr>
                  <td>Bunga Pertahun</td>
                  <td>:&nbsp;</td>
                  <td><?php echo $EDIT['bunga']; ?> %</td>
                </tr>
                <tr>
                  <td>Jenis Kredit</td>
                  <td>:&nbsp;</td>
                  <td><?php echo $EDIT['tipebunga']; ?></td>
                </tr>
              </table>

            <?php if ($EDIT['tipebunga']=='flat'){ ?>

          <div class="col-sm-12 simulasi-kredit list" style="margin-bottom:20px;">
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

            <div class="col-sm-12 simulasi-kredit list" style="margin-bottom:20px;">
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

            <div class="col-sm-12 simulasi-kredit list" style="margin-bottom:20px;">
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
            <br/>
            <center>
              <a class="kembali-btn" href="<?php echo site_url('informasi')?>">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Hitung Lagi
              </a>
            </center>

          </div>

        </div>
    </div><!--//Main content-->
