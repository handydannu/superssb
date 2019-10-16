<?php 
// ---- SET ACTIVE MENU ------
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);

$arr_corporate = array('visi-misi', 'nilai-nilai', 'logo', 'identitas-perusahaan', 'sejarah-singkat', 'dewan-komisaris', 'direksi', 'pemegang-saham', 'dewan-pengawas-syariah', 'pimpinan-grup', 'struktur-organisasi', 'penghargaan', 'akses-informasi', 'teknologi-informasi', 'manajemen-resiko', 'sumber-daya-manusia', 'kantor-cabang', 'kantor-kas', 'lokasi-atm', 'payment-point');
$arr_layanan   = array('simpeda', 'tapemda-pelajar', 'tapemda-pensiunan', 'tapemda-sayang-petani', 'tampan', 'tabunganku', 'giro', 'deposito', 'kredit-umum-lainnya-kul', 'kredit-pensiun', 'kredit-pur', 'kredit-konstruksi', 'kredit-koperasi', 'kredit-kepada-pemerintah-daerah-pemda', 'jasa-bank', 'syariah', 'syariah-investasi', 'atm', 'garansi-bank', 'produk-dan-jasa-uus');
$arr_informasi = array('informasi', 'berita', 'foto', 'video', 'download', 'read');
$arr_kontak    = array('kontak', 'testimoni');
?>

    <header class="main-header">

    <?php /*
        <div class="kurs-wrap"><!--kurs atas-->
            <div class="kurs-title">
                <div class="kurs-arrow"></div>
                KURS VALAS
            </div>
            <div class="kurs-date">
                <div class="kurs-arrow"></div>
                Update : 05/10/15 09:00 WIB
            </div>
            <div class="kurs-detail">
                <ul id="webTicker">
                    <li>USD - Jual: Rp 10,251.9366</li>
                    <li>Beli: Rp 10,167.5978 EUR - Jual: Rp 16,488.0560</li>
                    <li>Beli: Rp 16,336.3200 HKD - Jual: Rp 1,895.3616</li>
                </ul>
            </div>
        </div><!--//kurs atas-->
      */ ?>
      
        <div class="headmenu-wrap">
            <div class="row">
                <div class="col-lg-3 col-sm-2"><!--Main logo-->
                    <div class="main-logo">
                        <a href="<?php echo site_url(); ?>"><img src="<?php echo $this->config->item('template_uri');?>images/main-logo.png" class="img-responsive"></a>
                    </div>
                </div><!--//Main logo-->
                <div class="col-lg-8 col-sm-10"><!--Nav Menus-->
                    <div class="menus">
                        <div class="language">
                            <a href="javascript:;" onclick="doGTranslate('id|id');return false;" id="langina" title="Indonesia" class="nturl active" style="background-position:-300px -300px;">Indonesia</a>&nbsp;|&nbsp;
                            <a href="javascript:;" onclick="doGTranslate('id|en');return false;" id="langen" title="English" class="nturl" style="background-position:-0px -0px;">English</a>

                            <!-- GTranslate: https://gtranslate.io/ -->
                            <div id="google_translate_element2"></div>                            

                        </div>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <li class="main-menu-single desktop-hide tablet-hide">
                                    <form class="input-group has-feedback has-feedback-left" method="get" action="<?php echo site_url('search'); ?>">
                                        <label class="sr-only">Search</label>
                                        <input class="form-control border-default" placeholder="Cari..." name="q" type="text">
                                        <i class="fa fa-search form-control-feedback"></i>
                                    </form>
                                </li>
                                <li class="main-menu-single home-btn <?php echo ($uri1=='' || $uri1=='home')? 'active' : ''; ?>"><a href="<?php echo site_url()?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                <li class="dropdown-submenu firstlevel main-menu-single <?php echo ( in_array($uri2, $arr_corporate) OR in_array($uri1, $arr_corporate))?  'active' : ''; ?>">
                                    <a class="test" tabindex="-1" href="javascript:;">CORPORATE SITE <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu secondlevel">
                                        <li class="dropdown-submenu secondlevel">
                                            <a class="test" href="javascript:;">Profil<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu thirdlevel">
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/visi-misi'); ?>">Visi dan Misi</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/nilai-nilai'); ?>">Nilai Nilai</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/logo'); ?>">Logo</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/identitas-perusahaan'); ?>">Identitas Perusahaan</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/sejarah-singkat'); ?>">Sejarah Singkat</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/dewan-komisaris'); ?>">Dewan Komisaris</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/direksi'); ?>">Direksi</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/pemegang-saham'); ?>">Pemegang Saham</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/dewan-pengawas-syariah'); ?>">Dewan Pengawas Syariah</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/pimpinan-grup'); ?>">Pimpinan Grup</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/struktur-organisasi'); ?>">Struktur Organisasi</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/penghargaan'); ?>">Penghargaan</a></li>
                                            </ul>
                                        </li>
                                        <li><a tabindex="-1" href="<?php echo site_url('page/akses-informasi'); ?>">Akses Informasi</a></li>
                                        <li><a tabindex="-1" href="<?php echo site_url('page/sumber-daya-manusia'); ?>">Sumber Daya Manusia</a></li>
                                        <li><a tabindex="-1" href="<?php echo site_url('page/teknologi-informasi'); ?>">Teknologi Informasi</a></li>
                                        <li><a tabindex="-1" href="<?php echo site_url('page/manajemen-resiko'); ?>">Manajemen Resiko</a></li>
                                        <li class="dropdown-submenu secondlevel">
                                            <a class="test" href="#">Jaringan<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu thirdlevel">
                                              <li class="main-menu-single"><a href="<?=site_url('kantor-cabang') ?>">Kantor Cabang / Capem</a></li>
                                              <li class="main-menu-single"><a href="<?=site_url('kantor-kas') ?>">Kantor Kas</a></li>
                                              <li class="main-menu-single"><a href="<?=site_url('lokasi-atm') ?>">Lokasi ATM</a></li>
                                              <li class="main-menu-single"><a href="<?=site_url('payment-point') ?>">Payment Point</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="main-menu-single <?php echo ($uri1=='csr')? 'active' : ''; ?>"><a href="<?php echo site_url('csr'); ?>">CSR</a></li>
                                <li class="dropdown-submenu firstlevel main-menu-single <?php echo ( in_array($uri2, $arr_layanan))?  'active' : ''; ?>">
                                   <a class="test" tabindex="-1" href="javascript:;">LAYANAN <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu secondlevel">
                                        <li class="dropdown-submenu secondlevel">
                                            <a class="test" href="#">Simpanan<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu thirdlevel">
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/simpeda'); ?>">SIMPEDA</a></li>
                                              <li class="dropdown-submenu secondlevel">
                                                <a class="test" href="#">TAPEMDA<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                                <ul class="dropdown-menu thirdlevel">
                                                  <li class="main-menu-single"><a href="<?php echo site_url('page/tapemda-pelajar'); ?>">TAPEMDA PELAJAR</a></li>
                                                  <li class="main-menu-single"><a href="<?php echo site_url('page/tapemda-pensiunan'); ?>">TAPEMDA PENSIUNAN</a></li>
                                                  <li class="main-menu-single"><a href="<?php echo site_url('page/tapemda-sayang-petani'); ?>">TAPEMDA SAYANG PETANI</a></li>
                                                </ul>
                                              </li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/tampan'); ?>">Tampan</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/tabunganku'); ?>">Tabunganku</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/deposito'); ?>">Deposito</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/giro'); ?>">Giro</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu secondlevel">
                                            <a class="test" href="#">Pinjaman<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu thirdlevel">
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/kredit-umum-lainnya-kul'); ?>">Kredit Umum Lainnya (KUL)</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/kredit-pensiun'); ?>">Kredit Pensiun</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/kredit-pur'); ?>">Kredit PUR</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/kredit-pur-pola-kemitraan'); ?>">Kredit PUR Pola Kemitraan</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/kredit-konstruksi'); ?>">Kredit Konstruksi</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/kredit-koperasi'); ?>">Kredit Koperasi</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/kredit-kepada-pemerintah-daerah-pemda'); ?>">Kredit Kepada Pemerintah Daerah (PEMDA)</a></li>
                                            </ul>
                                        </li>
                                        <li class="main-menu-single"><a tabindex="-1" href="<?php echo site_url('page/jasa-bank'); ?>">Jasa Bank</a></li>
                                        <li class="dropdown-submenu secondlevel">
                                            <a class="test" href="#">Syariah<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu thirdlevel">
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/syariah'); ?>">Pembiayaan</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('page/syariah-investasi'); ?>">Simpanan Investasi Nasabah</a></li>
                                            </ul>
                                        </li>
                                        <li class="main-menu-single"><a tabindex="-1" href="<?php echo site_url('page/atm'); ?>">ATM</a></li>
                                        <li class="main-menu-single"><a tabindex="-1" href="<?php echo site_url('page/garansi-bank'); ?>">Garansi Bank</a></li>
                                        <li class="main-menu-single"><a tabindex="-1" href="<?php echo site_url('page/produk-dan-jasa-uus'); ?>">Produk dan Jasa UUS</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu firstlevel main-menu-single <?php echo ( in_array($uri1, $arr_informasi))?  'active' : ''; ?>">
                                   <a class="test" tabindex="-1" href="<?php echo site_url('informasi'); ?>">INFORMASI <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu secondlevel">
                                        <li class="main-menu-single desktop-hide"><a tabindex="-1" href="informasi.html">Informasi</a></li>
                                        <li class="main-menu-single"><a tabindex="-1" href="<?php echo site_url('berita'); ?>">Berita</a></li>
                                        <li class="dropdown-submenu secondlevel">
                                            <a class="test" href="#">Galeri<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu thirdlevel">
                                              <li class="main-menu-single"><a href="<?php echo site_url('foto')?>">Foto</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('video')?>">Video</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu secondlevel">
                                            <a class="test" href="javascript:;">Download<i class="fa fa-caret-right right-dropdown" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu thirdlevel">
                                              <li class="main-menu-single"><a href="<?php echo site_url('download/pengumuman-lelang')?>">Pengumuman Lelang</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('download/laporan-tahunan')?>">Laporan Tahunan</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('download/laporan-keuangan-publikasi')?>">Laporan Keuangan Publikasi</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('download/sbdk')?>">Suku Bunga Dasar Kredit</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('download/gcg')?>">Good Corporate Governance</a></li>
                                              <li class="main-menu-single"><a href="<?php echo site_url('download/other')?>">Data Lain</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="main-menu-single <?php echo ($uri1 == 'sbdk')? 'active' : ''; ?>"><a href="<?php echo site_url('sbdk'); ?>">SBDK</a></li>
                                <li class="main-menu-single <?php echo (in_array($uri1, $arr_kontak))? 'active' : ''; ?>"><a href="<?php echo base_url('kontak')?>">KONTAK</a></li>
                                <li class="main-menu-single <?php echo ($uri2 == 'karir')? 'active' : ''; ?>"><a href="<?php echo site_url('page/karir');?>">KARIR</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!--//Nav Menus-->

                <div class="col-sm-12"><!--Search button-->
                    <div class="search" id="search">
                        <a class="search-btn" href="javascript:void(0)"><i class="fa fa-search fa-3x" aria-hidden="true"></i></a>
                        <div class="input-group search-input">
                        <form method="get" action="<?php echo site_url('search'); ?>">
                          <input type="text" name="q" class="form-control" id="" placeholder="Search Here...">
                          <span class="input-group-btn">
                            <button class="btn btn-default go-btn" type="button">Go!</button>
                          </span>
                        </form>
                        </div>
                    </div>
                </div><!--//Search button-->
            </div>
        </div><!--//Navbar-->

    </header><!--//header-->