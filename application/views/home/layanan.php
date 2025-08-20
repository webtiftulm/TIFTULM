<section class="bg-servicesstyle2-section">
<div class="container">
    <div class="row">
        <div class="our-services-option">
            <div class="section-header">
                <h2><?php echo lang_text('Layanan', 'Services'); ?> <br><?php echo lang_text('di', 'at'); ?> <?php echo $site->namaweb ?></h2>
            </div>
            <!-- .section-header -->
            <div class="row">
                <?php foreach($layanan as $layanan) { ?>
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="our-services-box">
                        <div class="our-services-items">
                            <i class="<?php echo $layanan->icon ?> fa-5x" style="color:#337ab7; margin-bottom: 20px;"></i>
                            <div class="our-services-content">
                                <h4><a href="<?php echo base_url('berita/layanan/'.$layanan->slug_berita) ?>"><?php echo smart_translate($layanan->judul_berita, 'layanan_title_'.$layanan->id_berita, 80); ?></a></h4>
                                <p><?php echo smart_translate($layanan->keywords, 'layanan_desc_'.$layanan->id_berita, 100); ?></p>
                                <a href="<?php echo base_url('berita/layanan/'.$layanan->slug_berita) ?>"><?php echo lang_text('baca selengkapnya', 'read more'); ?><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            </div>
                            <!-- .our-services-content -->
                        </div>
                        <!-- .our-services-items -->
                    </div>
                    <!-- .our-services-box -->
                </div>
                <?php } ?>
            </div>
            <!-- .row -->
        </div>
        <!-- .our-services-option -->
    </div>
    <!-- .row -->
</div>
<!-- .container -->
</section>


<!-- End Service Style2 Section -->

