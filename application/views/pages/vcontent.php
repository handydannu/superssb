<?php
$active_menu = $this->uri->segment(2);
?>
<div class="breadcrumb-temp">
    <?php
        $list_channel = array('profil', 'simpanan', 'tapemda', 'pinjaman', 'syariah');
        $current_channel = strtolower($page_data['ch_name']);
        if (in_array($current_channel, $list_channel))
        {
            $breadcrumb = '<span class="canal-title">'.$page_data['tp_name'].'&nbsp;&nbsp;/ <a href= "'.site_url('page/'.$page_data['ch_slug']).'">'.$page_data['ch_name'].'</a> / </span><span class="canal-subtitle">&nbsp;&nbsp;'.$page_data['p_title'].'</span>';
        }else{
            $breadcrumb = '<span class="canal-title">'.$page_data['tp_name'].'&nbsp;&nbsp;/ </span><span class="canal-subtitle">&nbsp;&nbsp;'.$page_data['p_title'].'</span>';
        }
    ?>

    <?php if ($this->uri->segment(2) == 'karir'){ ?>

    <span class="canal-title">Karir</span>

    <?php }else{ ?>

    <?php echo $breadcrumb; ?>

    <?php } ?>
</div>

<div class="main-content">
    <div class="container2" style="padding-left:30px;padding-right:15px;background-image: url(https://banksulselbar.co.id/assets/img/bg3.png);background-position:left-top;background-repeat:repeat-x">
        <div class="berita-content">
          <div class="row">
            <div class="col-md-8">
                <div class="berita-content-detail">
                    <?php echo html_entity_decode($page_data['p_content']);  ?>
                </div>
            </div>
            <div class="col-md-4">

              <div class="about-side-nav-wrap">
                <?php
                  $content_corporate= array('visi-misi', 'nilai-nilai', 'logo', 'identitas-perusahaan', 'sejarah-singkat','dewan-komisaris',
                    'direksi', 'pemegang-saham', 'dewan-pengawas-syariah', 'pimpinan-grup', 'penghargaan',
                    'akses-informasi', 'sumber-daya-manusia', 'teknologi-informasi', 'manajemen-risiko');
                  $content_layanan = array('simpeda', 'tapemda-pelajar', 'tapemda-pensiunan', 'tapemda-sayang-petani', 'tampan', 'tabunganku',
                    'deposito', 'giro', 'kredit-umum-lainnya-kul', 'kredit-pensiun', 'kredit-pur', 'kredit-pur-pola-kemitraan', 'kredit-konstruksi',
                    'kredit-koperasi', 'kredit-kepada-pemerintah-daerah-pemda', 'jasa-bank', 'pendanaan-uus', 'pembiayaan-uus', 'jasa-uus', 'atm', 'garansi-bank', 'produk-dan-jasa-uus');
                  $content_karir = array('karir');
                  $content_struktur = array('struktur-organisasi');
                  if($active_menu == in_array($active_menu, $content_corporate)){
                    ?>
                      <ul class="about-side-nav">
                        <li class="side-nav-single dropdown active"><a href="javascript:void(0)">Profil</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('page/visi-misi')?>"><li <?= ($active_menu=='visi-misi') ? "class='side-nav-single active'":"" ?>>Visi dan Misi</li></a>
                            <a href="<?php echo site_url('page/nilai-nilai')?>"><li <?= ($active_menu=='nilai-nilai') ? "class='side-nav-single active'":"" ?>>Nilai Nilai</li></a>
                            <a href="<?php echo site_url('page/logo')?>"><li <?= ($active_menu=='logo') ? "class='side-nav-single active'":"" ?>>Logo</li></a>
                            <a href="<?php echo site_url('page/identitas-perusahaan')?>"><li <?= ($active_menu=='identitas-perusahaan') ? "class='side-nav-single active'":"" ?>>Identitas Perusahaan</li></a>
                            <a href="<?php echo site_url('page/sejarah-singkat')?>"><li <?= ($active_menu=='sejarah-singkat') ? "class='side-nav-single active'":"" ?>>Sejarah Singkat</li></a>
                            <a href="<?php echo site_url('page/dewan-komisaris')?>"><li <?= ($active_menu=='dewan-komisaris') ? "class='side-nav-single active'":"" ?>>Dewan Komisaris</li></a>
                            <a href="<?php echo site_url('page/direksi')?>"><li <?= ($active_menu=='direksi') ? "class='side-nav-single active'":"" ?>>Direksi</li></a>
                            <a href="<?php echo site_url('page/pemegang-saham')?>"><li <?= ($active_menu=='pemegang-saham') ? "class='side-nav-single active'":"" ?>>Pemegang Saham</li></a>
                            <a href="<?php echo site_url('page/dewan-pengawas-syariah')?>"><li <?= ($active_menu=='dewan-pengawas-syariah') ? "class='side-nav-single active'":"" ?>>Dewan Pengawas Syariah</li></a>
                            <a href="<?php echo site_url('page/pimpinan-grup')?>"><li <?= ($active_menu=='pimpinan-grup') ? "class='side-nav-single active'":"" ?>>Pimpinan Grup</li></a>
                            <a href="<?php echo site_url('page/struktur-organisasi')?>"><li <?= ($active_menu=='struktur-organisasi') ? "class='side-nav-single active'":"" ?>>Struktur Organisasi</li></a>
                            <a href="<?php echo site_url('page/penghargaan')?>"><li <?= ($active_menu=='penghargaan') ? "class='side-nav-single active'":"" ?>>Penghargaan</li></a>
                          </ul>
                        </li>
                        <li <?= ($active_menu=='akses-informasi') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/akses-informasi')?>">Akses Informasi</a></li>
                        <li <?= ($active_menu=='sumber-daya-manusia') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/sumber-daya-manusia')?>">Sumber Daya Manusia</a></li>
                        <li <?= ($active_menu=='teknologi-informasi') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/teknologi-informasi')?>">Teknologi Informasi</a></li>
                        <li <?= ($active_menu=='manajemen-risiko') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/manajemen-risiko')?>">Manajemen Risiko</a></li>
                        <li class="side-nav-single dropdown"><a href="javascript:void(0)">Jaringan</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('kantor-cabang')?>"><li class="side-nav-single active">Kantor Cabang/Capem</li></a>
                            <a href="<?php echo site_url('kantor-kas')?>"><li class="side-nav-single">Kantor Kas</li></a>
                            <a href="<?php echo site_url('lokasi-atm')?>"><li class="side-nav-single">Lokasi ATM</li></a>
                            <a href="<?php echo site_url('payment-point')?>"><li class="side-nav-single">Payment Point</li></a>
                          </ul>
                        </li>
                      </ul>
                    <?php
                  }
                  else if($active_menu == in_array($active_menu, $content_karir)){
                    ?>
                      <ul class="about-side-nav">
                        <li class="side-nav-single dropdown"><a href="javascript:void(0)">Profil</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('page/visi-misi')?>"><li <?= ($active_menu=='visi-misi') ? "class='side-nav-single active'":"" ?>>Visi dan Misi</li></a>
                            <a href="<?php echo site_url('page/nilai-nilai')?>"><li <?= ($active_menu=='nilai-nilai') ? "class='side-nav-single active'":"" ?>>Nilai Nilai</li></a>
                            <a href="<?php echo site_url('page/logo')?>"><li <?= ($active_menu=='logo') ? "class='side-nav-single active'":"" ?>>Logo</li></a>
                            <a href="<?php echo site_url('page/identitas-perusahaan')?>"><li <?= ($active_menu=='identitas-perusahaan') ? "class='side-nav-single active'":"" ?>>Identitas Perusahaan</li></a>
                            <a href="<?php echo site_url('page/sejarah-singkat')?>"><li <?= ($active_menu=='sejarah-singkat') ? "class='side-nav-single active'":"" ?>>Sejarah Singkat</li></a>
                            <a href="<?php echo site_url('page/dewan-komisaris')?>"><li <?= ($active_menu=='dewan-komisaris') ? "class='side-nav-single active'":"" ?>>Dewan Komisaris</li></a>
                            <a href="<?php echo site_url('page/direksi')?>"><li <?= ($active_menu=='direksi') ? "class='side-nav-single active'":"" ?>>Direksi</li></a>
                            <a href="<?php echo site_url('page/pemegang-saham')?>"><li <?= ($active_menu=='pemegang-saham') ? "class='side-nav-single active'":"" ?>>Pemegang Saham</li></a>
                            <a href="<?php echo site_url('page/dewan-pengawas-syariah')?>"><li <?= ($active_menu=='dewan-pengawas-syariah') ? "class='side-nav-single active'":"" ?>>Dewan Pengawas Syariah</li></a>
                            <a href="<?php echo site_url('page/pimpinan-grup')?>"><li <?= ($active_menu=='pimpinan-grup') ? "class='side-nav-single active'":"" ?>>Pimpinan Grup</li></a>
                            <a href="<?php echo site_url('page/struktur-organisasi')?>"><li <?= ($active_menu=='struktur-organisasi') ? "class='side-nav-single active'":"" ?>>Struktur Organisasi</li></a>
                            <a href="<?php echo site_url('page/penghargaan')?>"><li <?= ($active_menu=='penghargaan') ? "class='side-nav-single active'":"" ?>>Penghargaan</li></a>
                          </ul>
                        </li>
                        <li><a href="<?php echo site_url('page/akses-informasi')?>">Akses Informasi</a></li>
                        <li><a href="<?php echo site_url('page/sumber-daya-manusia')?>">Sumber Daya Manusia</a></li>
                        <li><a href="<?php echo site_url('page/teknologi-informasi')?>">Teknologi Informasi</a></li>
                        <li><a href="<?php echo site_url('page/manajemen-risiko')?>">Manajemen Risiko</a></li>
                        <li class="side-nav-single dropdown"><a href="javascript:void(0)">Jaringan</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('kantor-cabang')?>"><li class="side-nav-single">Kantor Cabang/Capem</li></a>
                            <a href="<?php echo site_url('kantor-kas')?>"><li class="side-nav-single">Kantor Kas</li></a>
                            <a href="<?php echo site_url('lokasi-atm')?>"><li class="side-nav-single">Lokasi ATM</li></a>
                            <a href="<?php echo site_url('payment-point')?>"><li class="side-nav-single">Payment Point</li></a>
                          </ul>
                        </li>
                      </ul>
                    <?php
                  }
                  elseif($active_menu == in_array($active_menu, $content_layanan)){
                    ?>
                      <ul class="about-side-nav">
                        <li class="side-nav-single dropdown active"><a href="javascript:void(0)">SIMPANAN</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('page/simpeda')?>"><li <?= ($active_menu=='simpeda') ? "class='side-nav-single active'":"" ?>>SIMPEDA</li></a>
                            <a href="<?php echo site_url('page/tapemda-pelajar')?>"><li <?= ($active_menu=='tapemda-pelajar') ? "class='side-nav-single active'":"" ?>>Tapemda Pelajar</li></a>
                            <a href="<?php echo site_url('page/tapemda-pensiunan')?>"><li <?= ($active_menu=='tapemda-pensiunan') ? "class='side-nav-single active'":"" ?>>Tapemda Pensiunan</li></a>
                            <a href="<?php echo site_url('page/tapemda-sayang-petani')?>"><li <?= ($active_menu=='tapemda-sayang-petani') ? "class='side-nav-single active'":"" ?>>Tapemda Sayang Petani</li></a>
                            <a href="<?php echo site_url('page/tampan')?>"><li <?= ($active_menu=='tampan') ? "class='side-nav-single active'":"" ?>>Tampan</li></a>
                            <a href="<?php echo site_url('page/tabunganku')?>"><li <?= ($active_menu=='tabunganku') ? "class='side-nav-single active'":"" ?>>Tabunganku</li></a>
                            <a href="<?php echo site_url('page/deposito')?>"><li <?= ($active_menu=='deposito') ? "class='side-nav-single active'":"" ?>>Deposito</li></a>
                            <a href="<?php echo site_url('page/giro')?>"><li <?= ($active_menu=='giro') ? "class='side-nav-single active'":"" ?>>Giro</li></a>
                          </ul>
                        </li>
                        <li class="side-nav-single dropdown active"><a href="javascript:void(0)">PINJAMAN</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('page/kredit-umum-lainnya-kul')?>"><li <?= ($active_menu=='kredit-umum-lainnya-kul') ? "class='side-nav-single active'":"" ?>>Kredit Umum Lainnya (KUL)</li></a>
                            <a href="<?php echo site_url('page/kredit-pensiun')?>"><li <?= ($active_menu=='kredit-pensiun') ? "class='side-nav-single active'":"" ?>>Kredit Pensiun</li></a>
                            <a href="<?php echo site_url('page/kredit-pur')?>"><li <?= ($active_menu=='kredit-pur') ? "class='side-nav-single active'":"" ?>>Kredit PUR</li></a>
                            <a href="<?php echo site_url('page/kredit-pur-pola-kemitraan')?>"><li <?= ($active_menu=='kredit-pur-pola-kemitraan') ? "class='side-nav-single active'":"" ?>>Kredit PUR Pola Kemitraan</li></a>
                            <a href="<?php echo site_url('page/kredit-konstruksi')?>"><li <?= ($active_menu=='kredit-konstruksi') ? "class='side-nav-single active'":"" ?>>Kredit Konstruksi</li></a>
                            <a href="<?php echo site_url('page/kredit-koperasi')?>"><li <?= ($active_menu=='kredit-koperasi') ? "class='side-nav-single active'":"" ?>>Kredit Koperasi</li></a>
                            <a href="<?php echo site_url('page/kredit-kepada-pemerintah-daerah-pemda')?>"><li <?= ($active_menu=='kredit-kepada-pemerintah-daerah-pemda') ? "class='side-nav-single active'":"" ?>>Kredit Kepada Pemerintah Daerah (PEMDA)</li></a>
                          </ul>
                        </li>
                        <li <?= ($active_menu=='jasa-bank') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/jasa-bank')?>">Jasa Bank</a></li>
                        <li class="side-nav-single dropdown active"><a href="javascript:void(0)">Syariah</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('page/pendanaan-uus')?>"><li <?= ($active_menu=='pendanaan-uus') ? "class='side-nav-single active'":"" ?>>Pendanaan UUS</li></a>
                            <a href="<?php echo site_url('page/pembiayaan-uus')?>"><li <?= ($active_menu=='pembiayaan-uus') ? "class='side-nav-single active'":"" ?>>Pembiayaan UUS</li></a>
                            <a href="<?php echo site_url('page/jasa-uus')?>"><li <?= ($active_menu=='jasa-uus') ? "class='side-nav-single active'":"" ?>>Jasa UUS</li></a>
                          </ul>
                        </li>
                        <li <?= ($active_menu=='atm') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/atm')?>">ATM</a></li>
                        <li <?= ($active_menu=='garansi-bank') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/garansi-bank')?>">Garansi Bank</a></li>
                      </ul>
                    <?php
                  }
                  else if($active_menu == in_array($active_menu, $content_struktur)){
                    ?>
                      
                    <?php
                  }
                  else{
                    ?>
                      <ul class="about-side-nav">
                        <li class="side-nav-single dropdown active"><a href="javascript:void(0)">Profil</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('page/visi-misi')?>"><li <?= ($active_menu=='visi-misi') ? "class='side-nav-single active'":"" ?>>Visi dan Misi</li></a>
                            <a href="<?php echo site_url('page/nilai-nilai')?>"><li <?= ($active_menu=='nilai-nilai') ? "class='side-nav-single active'":"" ?>>Nilai Nilai</li></a>
                            <a href="<?php echo site_url('page/logo')?>"><li <?= ($active_menu=='logo') ? "class='side-nav-single active'":"" ?>>Logo</li></a>
                            <a href="<?php echo site_url('page/identitas-perusahaan')?>"><li <?= ($active_menu=='identitas-perusahaan') ? "class='side-nav-single active'":"" ?>>Identitas Perusahaan</li></a>
                            <a href="<?php echo site_url('page/sejarah-singkat')?>"><li <?= ($active_menu=='sejarah-singkat') ? "class='side-nav-single active'":"" ?>>Sejarah Singkat</li></a>
                            <a href="<?php echo site_url('page/dewan-komisaris')?>"><li <?= ($active_menu=='dewan-komisaris') ? "class='side-nav-single active'":"" ?>>Dewan Komisaris</li></a>
                            <a href="<?php echo site_url('page/direksi')?>"><li <?= ($active_menu=='direksi') ? "class='side-nav-single active'":"" ?>>Direksi</li></a>
                            <a href="<?php echo site_url('page/pemegang-saham')?>"><li <?= ($active_menu=='pemegang-saham') ? "class='side-nav-single active'":"" ?>>Pemegang Saham</li></a>
                            <a href="<?php echo site_url('page/dewan-pengawas-syariah')?>"><li <?= ($active_menu=='dewan-pengawas-syariah') ? "class='side-nav-single active'":"" ?>>Dewan Pengawas Syariah</li></a>
                            <a href="<?php echo site_url('page/pimpinan-grup')?>"><li <?= ($active_menu=='pimpinan-grup') ? "class='side-nav-single active'":"" ?>>Pimpinan Grup</li></a>
                            <a href="<?php echo site_url('page/struktur-organisasi')?>"><li <?= ($active_menu=='struktur-organisasi') ? "class='side-nav-single active'":"" ?>>Struktur Organisasi</li></a>
                            <a href="<?php echo site_url('page/penghargaan')?>"><li <?= ($active_menu=='penghargaan') ? "class='side-nav-single active'":"" ?>>Penghargaan</li></a>
                          </ul>
                        </li>
                        <li <?= ($active_menu=='akses-informasi') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/akses-informasi')?>">Akses Informasi</a></li>
                        <li <?= ($active_menu=='sumber-daya-manusia') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/sumber-daya-manusia')?>">Sumber Daya Manusia</a></li>
                        <li <?= ($active_menu=='teknologi-informasi') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/teknologi-informasi')?>">Teknologi Informasi</a></li>
                        <li <?= ($active_menu=='manajemen-risiko') ? "class='side-nav-single active'":"" ?>><a href="<?php echo site_url('page/manajemen-risiko')?>">Manajemen Risiko</a></li>
                        <li class="side-nav-single dropdown"><a href="javascript:void(0)">Jaringan</a>
                          <ul class="about-side-nav anakan">
                            <a href="<?php echo site_url('kantor-cabang')?>"><li class="side-nav-single active">Kantor Cabang/Capem</li></a>
                            <a href="<?php echo site_url('kantor-kas')?>"><li class="side-nav-single">Kantor Kas</li></a>
                            <a href="<?php echo site_url('lokasi-atm')?>"><li class="side-nav-single">Lokasi ATM</li></a>
                            <a href="<?php echo site_url('payment-point')?>"><li class="side-nav-single">Payment Point</li></a>
                          </ul>
                        </li>
                      </ul>
                    <?php
                  }
                ?>


              </div>

            </div>
          </div>
        </div>

    </div>
</div>
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
