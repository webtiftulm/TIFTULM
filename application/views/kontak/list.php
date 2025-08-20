<!-- Start Contact us Section -->
<section class="bg-contact-us">
    <div class="container">
        <div class="row">
            <div class="contact-us">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="contact-title">HUBUNGI KAMI</h3>
                        <?php
                        echo validation_errors('<div class="alert alert-warning">', '</div>');

                        // Notifikasi
                        if ($this->session->flashdata('sukses')) {
                            echo '<div class="alert alert-success">';
                            echo $this->session->flashdata('sukses');
                            echo '</div>';
                        }

                        ?>

                        <?php echo form_open('kontak', ['class' => 'contact-form']); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nameId" name="nama" placeholder="<?php echo lang_text('Nama Lengkap', 'Full Name'); ?>" value="<?php echo html_escape(set_value('nama')); ?>">
                                    </div>
                                    <!-- .form-group -->
                                </div>
                                <!-- .col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="emailId" name="email" placeholder="<?php echo lang_text('Alamat Email', 'Email Address'); ?>" value="<?php echo html_escape(set_value('email')); ?>">
                                    </div>
                                </div>
                                <!-- .col-md-6 -->
                            </div>
                            <!-- .row -->
                            <div class="form-group">
                                <input type="text" class="form-control" id="subjectId" name="subject" placeholder="<?php echo lang_text('Subjek', 'Subject'); ?>" value="<?php echo html_escape(set_value('subject')); ?>">
                            </div>
                            <textarea class="form-control text-area" name="pesan" rows="3" placeholder="<?php echo lang_text('Pesan', 'Message'); ?>"><?php echo html_escape(set_value('pesan')); ?></textarea>
                            <button type="submit" class="btn btn-default"><?php echo lang_text('Kirim Email', 'Send Email'); ?></button>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- .col-md-8 -->
                    <div class="col-md-4">
                        <h3 class="contact-title">KONTAK KAMI</h3>
                        <ul class="contact-address">
                            <li>
                                <i class="flaticon-placeholder"></i>
                                <div class="contact-content">
                                    <p><?php echo $site->alamat; ?></p>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-vibrating-phone"></i>
                                <div class="contact-content">
                                    <p><?php echo $site->telepon; ?></p>
                                    <p><?php echo $site->hp; ?></p>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-message"></i>
                                <div class="contact-content">
                                    <p><?php echo $site->email; ?></p>
                                    <p><?php echo $site->email_cadangan; ?></p>
                                </div>
                            </li>
                        </ul>
                        <!-- .contact-address -->
                        <ul class="social-icon-rounded contact-social-icon">
                            <li><a href="<?php echo $site->facebook; ?>"><i class="fa fa-facebook"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo $site->twitter; ?>"><i class="fa fa-twitter"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo $site->instagram; ?>"><i class="fa fa-instagram"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo $site->google_plus; ?>"><i class="fa fa-google"
                                        aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <!-- .col-md-4 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .contact-us -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Contact us Section -->


<!-- STart Maps Section -->
<style type="text/css" media="screen">
    iframe {
        width: 100%;
        height: auto;
        min-height: 400px;
    }
</style>
<div id="map"><?php echo $site->google_map; ?></div>
<!-- End Maps Section -->