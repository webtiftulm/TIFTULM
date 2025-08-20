<?php
$site = $this->konfigurasi_model->listing();
$site_nav = $this->konfigurasi_model->listing();
$nav_profil = $this->nav_model->nav_profil();
$nav_download = $this->nav_model->nav_download();
$nav_berita = $this->nav_model->nav_berita();
$nav_agenda = $this->nav_model->nav_agenda();
$nav_layanan = $this->nav_model->nav_layanan();
// var_dump($nav_berita);
?>
<!-- Start Menu -->
<div class="bg-main-menu menu-scroll" style="background-color:#faa441;">
    <div class="container">
        <div class="row">
            <div class="main-menu">
                <a class="show-res-logo" href="<?php echo base_url() ?>"><img src="<?php echo $this->website->logo() ?>"
                        alt="logo" class="img-responsive" style="max-height: 76px; width: auto;" /></a>
                <nav class="navbar">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url() ?>"><img
                                src="<?php echo $this->website->logo() ?>" alt="logo" class="img-responsive"
                                style="max-height: 56px; width: auto;" /></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <!-- home -->
                            <li class="<?php if($this->uri->segment(1) == '') { echo 'active'; } ?>"><a href="<?php echo base_url() ?>"><?php echo lang_text('BERANDA', 'HOME'); ?></a></li>

                            <!-- berita -->
                            <li class="dropdown <?php if($this->uri->segment(1) == 'berita' && $this->uri->segment(2) != 'layanan' && $this->uri->segment(2) != 'profil') { echo 'active'; } ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><?php echo lang_text('BERITA', 'NEWS'); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php
                                    if (!empty($nav_berita)) {
                                        foreach ($nav_berita as $nav_berita2) {
                                            ?>
                                            <li class="sub-active"><a
                                                    href="<?php echo base_url('berita/kategori/' . $nav_berita2->slug_kategori) ?>"><i
                                                        class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                    <?php echo smart_translate($nav_berita2->nama_kategori, 'nav_kategori_'.$nav_berita2->id_kategori, 50); ?></a></li>
                                        <?php }
                                    }
                                    ?>
                                    <li class="sub-active"><a href="<?php echo base_url('berita') ?>"><i
                                                class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo lang_text('Indeks Berita', 'News Index'); ?></a></li>
                                </ul>
                            </li>

                            <!-- Agenda -->
                            <!--<li class="dropdown">-->
                            <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">AGENDA<span class="caret"></span></a>-->
                            <!--    <ul class="dropdown-menu sub-menu">-->
                            <!--        <? php// foreach($nav_agenda as $nav_agenda) { ?>-->
                            <!--        <li class="sub-active"><a href="<? php// echo base_url('berita/layanan/'.$nav_agenda->jenis_agenda) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <? php// echo $nav_agenda->jenis_agenda ?></a></li>-->
                            <!--        <? php// } ?> -->
                            <!--    </ul>-->
                            <!--</li>-->
                            <!-- LAYANAN -->
                            <li class="dropdown <?php if($this->uri->segment(1) == 'rps' || ($this->uri->segment(1) == 'berita' && $this->uri->segment(2) == 'layanan')) { echo 'active'; } ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><?php echo lang_text('LAYANAN', 'SERVICES'); ?><span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php foreach ($nav_layanan as $nav_layanan) { ?>
                                        <li class="sub-active"><a
                                                href="<?php echo base_url('berita/layanan/' . $nav_layanan->slug_berita) ?>"><i
                                                    class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                <?php echo smart_translate($nav_layanan->judul_berita, 'nav_layanan_'.$nav_layanan->id_berita, 60); ?></a></li>
                                    <?php } ?>
                                    <li class="sub-active"><a href="<?php echo base_url('rps') ?>"><i
                                                class="fa fa-angle-double-right" aria-hidden="true"></i> R P S</a></li>
                                </ul>
                            </li>
                            <!-- PROFIL -->
                            <li class="dropdown <?php if($this->uri->segment(1) == 'pengajar' || ($this->uri->segment(1) == 'berita' && $this->uri->segment(2) == 'profil')) { echo 'active'; } ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><?php echo lang_text('PROFIL', 'PROFILE'); ?><span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php foreach ($nav_profil as $nav_profil) { ?>
                                        <li class="sub-active"><a
                                                href="<?php echo base_url('berita/profil/' . $nav_profil->slug_berita) ?>"><i
                                                    class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                <?php echo smart_translate($nav_profil->judul_berita, 'nav_profil_'.$nav_profil->id_berita, 60); ?></a></li>
                                    <?php } ?>
                                    <li class="sub-active"><a href="<?php echo base_url('pengajar') ?>"><i
                                                class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo lang_text('Staff Pengajar', 'Teaching Staff'); ?></a></li>
                                </ul>
                            </li>

                            <!-- galeri -->
                            <!--
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GALERI <span class="caret"></span></a>
                <ul class="dropdown-menu sub-menu">
                    
                    <li class="sub-active"><a href="<? php// echo base_url('galeri'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Galeri Foto</a></li>
                    <li class="sub-active"><a href="<? php// echo base_url('video'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Galeri Video</a></li>                   
                </ul>
            </li>
        -->

                            <!-- DOWNLOAD -->
                            <li class="<?php if($this->uri->segment(1) == 'download') { echo 'active'; } ?>"><a href="<?php echo base_url('download') ?>"><?php echo lang_text('UNDUHAN', 'DOWNLOAD'); ?></a></li>

                            <!-- kontak  -->
                            <li class="<?php if($this->uri->segment(1) == 'kontak') { echo 'active'; } ?>"><a href="<?php echo base_url('kontak') ?>"><?php echo lang_text('KONTAK', 'CONTACT'); ?></a></li>
                        </ul>
                        <div class="menu-right-option pull-right">
                            <!-- Language Switcher -->
                            <div class="language-switcher" style="display: inline-block; margin-right: 15px;">
                                <?php 
                                $current_lang = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'id';
                                ?>
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent; border: 1px solid #fff; color: #fff; padding: 5px 10px;">
                                        <?php echo ($current_lang == 'id') ? 'ID' : 'EN'; ?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown" style="min-width: 80px;">
                                        <li><a href="<?php echo base_url('language/switch_lang/id'); ?>" style="padding: 5px 15px;">
                                            <i class="fa fa-flag" style="margin-right: 5px;"></i>ID
                                        </a></li>
                                        <li><a href="<?php echo base_url('language/switch_lang/en'); ?>" style="padding: 5px 15px;">
                                            <i class="fa fa-flag-o" style="margin-right: 5px;"></i>EN
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="search-box">
                                <i class="fa fa-search first_click" aria-hidden="true" style="display: block;"></i>
                                <i class="fa fa-times second_click" aria-hidden="true" style="display: none;"></i>
                            </div>
                            <div class="search-box-text">
                                <?php echo form_open('berita/cari', ['method' => 'post', 'autocomplete' => 'off']); ?>
                                    <input type="text" name="s" id="all-search" placeholder="<?php echo lang_text('Cari berita...', 'Search news...'); ?>"
                                        maxlength="50" autocomplete="off" value="<?php echo set_value('s'); ?>">
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <!-- .header-search-box -->
                    </div>
                    <!-- .navbar-collapse -->
                </nav>
            </div>
            <!-- .main-menu -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</div>
<!-- .bg-main-menu -->
</header>