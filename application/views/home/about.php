<!-- Start About Greenforest Section -->
<section class="bg-about-greenforest">
    <div class="container">
        <div class="row">
            <div class="about-greenforest">
                <?php $noprof=1; foreach($profil as $profil) { if($noprof==1) { ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-greenforest-content">
                            <h2><?php echo smart_translate($profil->judul_berita, 'profil_title_'.$profil->id_berita, 100); ?></h2>
                            <?php echo smart_translate($profil->isi, 'profil_content_'.$profil->id_berita, 500); ?>
                        </div>
                        <!-- .about-greenforest-content -->
                    </div>
                    <!-- .col-md-8 -->
                    <div class="col-md-4">
                        <div class="about-greenforest-img">
                            <img src="<?php echo base_url('assets/upload/image/'.$profil->gambar) ?>" alt="about-greenforet-img" class="img-responsive" />
                        </div>
                        <!-- .about-greenforest-img -->
                    </div>
                    <!-- .col-md-4 -->
                </div>
                <?php }$noprof++; } ?>
            </div>
            <!-- .about-greenforest -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>

