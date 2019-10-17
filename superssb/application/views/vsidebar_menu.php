<?php 
$active_menu = $this->uri->segment(1); 
$akses       = $this->session->userdata('privilege');
?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a <?php echo ( ($active_menu=='dashboard')? 'class="active"' : ''); ?> href="<?= site_url('dashboard') ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <? //============== CORPORATE SITE =========== ?>
                <li class="sub-menu">
                <?php
                $content_array = array('profil-perusahaan', 'akses-informasi', 'sumber-daya-manusia', 'teknologi-informasi', 'manajemen-resiko', 'kantor_cabang', 'cash_office', 'atm_location', 'payment_point');
                ?>
                    <a href="javascript:;" <?= (in_array($active_menu, $content_array)) ? "class='active'":"" ?>>
                        <i class="fa fa-bank"></i>
                        <span>Corporate Site</span>
                    </a>
                    <ul class="sub">
                        <li <?= ($active_menu=='profil-perusahaan') ? "class='active'":"" ?>><a href="<?= site_url('profil-perusahaan') ?>">Profil Perusahaan</a></li>
                        <li <?= ($active_menu=='akses-informasi') ? "class='active'":"" ?>><a href="<?= site_url('akses-informasi') ?>">Akses Informasi</a></li>
                        <li <?= ($active_menu=='sumber-daya-manusia') ? "class='active'":"" ?>><a href="<?= site_url('sumber-daya-manusia') ?>">Sumber Daya Manusia</a></li>
                        <li <?= ($active_menu=='teknologi-informasi') ? "class='active'":"" ?>><a href="<?= site_url('teknologi-informasi') ?>">Teknologi Informasi</a></li>
                        <li <?= ($active_menu=='manajemen-resiko') ? "class='active'":"" ?>><a href="<?= site_url('manajemen-resiko') ?>">Manajemen Resiko</a></li>
                        <li <?= ($active_menu=='kantor_cabang' || $active_menu=='cash_office' || $active_menu=='atm_location' || $active_menu=='payment_point') ? "class='active'":"" ?>><a href="<?= site_url('kantor_cabang') ?>">Jaringan</a></li>
                    </ul>
                </li>

                <? /* //============== JARINGAN =========== ?>
                <li class="sub-menu">
                <?php
                $content_array = array('kantor_cabang', 'cash_office', 'atm_location', 'payment_point');
                ?>
                    <a href="javascript:;" <?= (in_array($active_menu, $content_array)) ? "class='active'":"" ?>>
                        <i class="fa fa-tasks"></i>
                        <span>Jaringan</span>
                    </a>
                    <ul class="sub">
                        <li <?= ($active_menu=='kantor_cabang') ? "class='active'":"" ?>><a href="<?= site_url('kantor_cabang') ?>">Kantor Cabang / Capem</a></li>
                        <li <?= ($active_menu=='cash_office') ? "class='active'":"" ?>><a href="<?= site_url('cash_office') ?>">Kantor Kas</a></li>
                        <li <?= ($active_menu=='atm_location') ? "class='active'":"" ?>><a href="<?= site_url('atm_location') ?>">Lokasi ATM</a></li>
                        <li <?= ($active_menu=='payment_point') ? "class='active'":"" ?>><a href="<?= site_url('payment_point') ?>">Payment Point</a></li>
                    </ul>
                </li>
                */?>

                <? //====== Headline ====== ?>
                <li>
                    <a <?php echo ( ($active_menu=='headline')? 'class="active"' : ''); ?> href="<?= site_url('headline') ?>">
                        <i class="fa fa-picture-o"></i>
                        <span>Headline</span>
                    </a>
                </li>
                <li>
                    <a <?php echo ( ($active_menu=='highlight')? 'class="active"' : ''); ?> href="<?= site_url('highlight') ?>">
                        <i class="fa fa-picture-o"></i>
                        <span>Highlight</span>
                    </a>
                </li>

                <? //============== Contact =========== ?>
                <li class="sub-menu">
                <?php
                $content_array = array('contact', 'testimoni');
                ?>
                    <a href="javascript:;" <?= (in_array($active_menu, $content_array)) ? "class='active'":"" ?>>
                        <i class="fa fa-sticky-note"></i>
                        <span>Contact</span>
                    </a>
                    <ul class="sub">
                        <li <?= ($active_menu=='contact') ? "class='active'":"" ?>><a href="<?= site_url('contact') ?>">Contact</a></li>
                        <li <?= ($active_menu=='testimoni') ? "class='active'":"" ?>><a href="<?= site_url('testimoni') ?>">Testimoni</a></li>
                    </ul>
                </li>

                <? //============== CONTENTS =========== ?>
                <li class="sub-menu">
                <?php
                $content_array = array('csr', 'berita', 'artikel', 'locked', 'photo', 'trash', 'photo', 'video');
                ?>
                    <a href="javascript:;" <?= (in_array($active_menu, $content_array)) ? "class='active'":"" ?>>
                        <i class="fa fa-newspaper-o"></i>
                        <span>Contents</span>
                    </a>
                    <ul class="sub">
                        <li <?= ($active_menu=='csr') ? "class='active'":"" ?>><a href="<?= site_url('csr') ?>">CSR</a></li>
                        <li <?= ($active_menu=='berita') ? "class='active'":"" ?>><a href="<?= site_url('berita') ?>">Berita</a></li>
                        <li <?= ($active_menu=='artikel') ? "class='active'":"" ?>><a href="<?= site_url('artikel') ?>">Artikel</a></li>
                        <li <?= ($active_menu=='locked') ? "class='active'":"" ?>><a href="<?= site_url('locked') ?>">Locked</a></li>
                        <li <?= ($active_menu=='trash') ? "class='active'":"" ?>><a href="<?= site_url('trash') ?>">Trash</a></li>
                        <li <?= ($active_menu=='photo') ? "class='active'":"" ?>><a href="<?= site_url('photo') ?>">Photo</a></li>
                        <li <?= ($active_menu=='video') ? "class='active'":"" ?>><a href="<?= site_url('video') ?>">Video</a></li>
                    </ul>
                </li>

                <? //============== LAYANAN =========== ?>
                <li class="sub-menu">
                <?php
                $content_array = array('simpanan', 'simpanan-tapemda', 'pinjaman', 'jasa-bank', 'syariah', 'atm', 'garansi-bank', 'produk-dan-jasa-uus');
                ?>
                    <a href="javascript:;" <?= (in_array($active_menu, $content_array)) ? "class='active'":"" ?>>
                        <i class="fa fa-support"></i>
                        <span>Layanan Kami</span>
                    </a>
                    <ul class="sub">
                        <li <?= ($active_menu=='simpanan') ? "class='active'":"" ?>><a href="<?= site_url('simpanan') ?>">Simpanan</a></li>
                        <li <?= ($active_menu=='simpanan-tapemda') ? "class='active'":"" ?>><a href="<?= site_url('simpanan-tapemda') ?>">Simpanan - TAPEMDA</a></li>
                        <li <?= ($active_menu=='pinjaman') ? "class='active'":"" ?>><a href="<?= site_url('pinjaman') ?>">Pinjaman</a></li>
                        <li <?= ($active_menu=='jasa-bank') ? "class='active'":"" ?>><a href="<?= site_url('jasa-bank') ?>">Jasa Bank</a></li>
                        <li <?= ($active_menu=='syariah') ? "class='active'":"" ?>><a href="<?= site_url('syariah') ?>">Syariah</a></li>
                        <li <?= ($active_menu=='atm') ? "class='active'":"" ?>><a href="<?= site_url('atm') ?>">ATM</a></li>
                        <li <?= ($active_menu=='garansi-bank') ? "class='active'":"" ?>><a href="<?= site_url('garansi-bank') ?>">Garansi Bank</a></li>
                        <li <?= ($active_menu=='produk-dan-jasa-uus') ? "class='active'":"" ?>><a href="<?= site_url('produk-dan-jasa-uus') ?>">Produk dan Jasa UUS</a></li>
                    </ul>
                </li>

                <? //============= INFORMASI ========== ?>
                <li>
                    <a <?php echo ( ($active_menu=='events')? 'class="active"' : ''); ?> href="<?= site_url('events') ?>">
                        <i class="fa fa-info-circle"></i>
                        <span>Agenda Kegiatan</span>
                    </a>
                </li>

                <? //============== DOWNLOAD =========== ?>
                <li class="sub-menu">
                <?php
                $content_array = array('annual-report', 'laporan_keuangan', 'gcg', 'psp', 'data-lainnya', 'lelang', 'sbdk');
                ?>
                    <a href="javascript:;" <?= (in_array($active_menu, $content_array)) ? "class='active'":"" ?>>
                        <i class="fa fa-upload"></i>
                        <span>Downloads</span>
                    </a>
                    <ul class="sub">
                        <li <?= ($active_menu=='annual-report') ? "class='active'":"" ?>><a href="<?= site_url('annual-report') ?>">Annual Report</a></li>
                        <li <?= ($active_menu=='laporan_keuangan') ? "class='active'":"" ?>><a href="<?= site_url('laporan_keuangan') ?>">Laporan Keuangan</a></li>
                        <li <?= ($active_menu=='gcg') ? "class='active'":"" ?>><a href="<?= site_url('gcg') ?>">GCG</a></li>
                        <li <?= ($active_menu=='psp') ? "class='active'":"" ?>><a href="<?= site_url('psp') ?>">Pengumuman Sekretaris Perusahaan</a></li>
                        <li <?= ($active_menu=='lelang') ? "class='active'":"" ?>><a href="<?= site_url('lelang') ?>">Lelang</a></li>
                        <li <?= ($active_menu=='sbdk') ? "class='active'":"" ?>><a href="<?= site_url('sbdk') ?>">Suku Bunga Dasar Kredit</a></li>
                        <li <?= ($active_menu=='data-lainnya') ? "class='active'":"" ?>><a href="<?= site_url('data-lainnya') ?>">Data Lainnya</a></li>
                    </ul>
                </li>

                <? //====== Lowongan ====== ?>
                <li>
                    <a <?php echo ( ($active_menu=='karir')? 'class="active"' : ''); ?> href="<?= site_url('karir') ?>">
                        <i class="fa fa-object-ungroup"></i>
                        <span>Karir</span>
                    </a>
                </li>

                <? //============== SETTING =========== ?>
                <li class="sub-menu">
                <?php
                $content_array = array('channels', 'user', 'features', 'province', 'header-image');
                ?>
                    <a href="javascript:;" <?= (in_array($active_menu, $content_array)) ? "class='active'":"" ?>>
                        <i class="fa fa-upload"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="sub">
                        <?php
                        $akses = $this->session->userdata('privilege');
                            if($akses=='admin'){
                                ?>
                                    <li <?= ($active_menu=='user') ? "class='active'":"" ?>><a href="<?= site_url('user') ?>">Users</a></li>
                                    <li <?= ($active_menu=='channels') ? "class='active'":"" ?>><a href="<?= site_url('channels') ?>">Channels</a></li>
                                    <li <?= ($active_menu=='features') ? "class='active'":"" ?>><a href="<?= site_url('features') ?>">Features</a></li>
                                <?php
                            }
                            else{
                                ?>
                                    <li <?= ($active_menu=='user') ? "class='active'":"" ?>><a href="<?= site_url('user') ?>">Users</a></li>
                                <?php
                            }
                        ?>                        
                    </ul>
                </li>
 
                <? //============= PERSONAL ========== ?>
                <li class="sub-menu">
                    <a href="javascript:;" <?= ($active_menu=='profile' OR $active_menu=='edit-profile' OR $active_menu=='my_article' OR $active_menu=='my_rubric')? 'class="active"': ''; ?>>
                        <i class="fa fa-user"></i>
                        <span>Personal</span>
                    </a>
                    <ul class="sub">
                        <li <?= ($active_menu=='profile') ? "class='active'":"" ?>><a href="<?php echo site_url('profile') ?>">Profile</a></li>
                        <li <?= ($active_menu=='edit-profile') ? "class='active'":"" ?>><a href="<?php echo site_url('edit-profile') ?>">Change Password</a></li>
                    </ul>
                </li>

                <? //====== LOGOUT ====== ?>
                <li>
                    <a href="<?= site_url('log/out') ?>">
                        <i class="fa fa-sign-out"></i>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>