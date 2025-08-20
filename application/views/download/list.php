<section class="bg-servicesstyle2-section">
  <div class="container">
    <div class="row">
      <div class="our-services-option">
        <div class="section-header">
          <h2><?php echo lang_text('Unduhan', 'Downloads'); ?></h2>
        </div>
        <!-- .section-header -->
        <div class="row">

          <style type="text/css" media="screen">
          th, td {
            text-align: left !important;
            vertical-align: top  !important;
            padding: 6px 12px !important;
            color: #000 !important;
          }
        </style>

        <div class="col-md-12">
          <?php if($this->uri->segment(3) == "") { ?>
            <p class="alert alert-success"><?php echo lang_text('Berikut data file yang dapat Anda unduh', 'Here are the files you can download'); ?></p>

          <?php }else{ ?>
            <p class="alert alert-success"><?php echo lang_text('Berikut data file dengan kategori', 'Here are files in category'); ?> <strong><?php echo $kategori_download->nama_kategori_download ?></strong> <?php echo lang_text('yang dapat Anda unduh', 'that you can download'); ?></p>
          <?php } ?>
          <div class="table-responsive mailbox-messages">
          <table id="example1" class="display table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
             <tr>
               <th width="5%"><?php echo lang_text('No', 'No'); ?></th>
               <th><?php echo lang_text('Judul', 'Title'); ?></th>
               <th><?php echo lang_text('Keterangan', 'Description'); ?></th>
               <th width="5%"></th>
             </tr>
           </thead>
           <tbody>
            <?php $i=1; foreach($download as $download) { ?>
             <tr>
               <td><?php echo $i ?></td>
               <td><?php echo smart_translate(html_escape($download->judul_download), 'download_title_'.$download->id_download, 100); ?></td>
               <td><?php echo smart_translate(html_purify($download->isi), 'download_desc_'.$download->id_download, 150); ?></td>
               <td>
                 <a href="<?php echo base_url('download/unduh/'.html_escape($download->id_download)) ?>" class="btn btn-primary btn-xs" target="_blank">
                   <i class="fa fa-download"></i> <?php echo lang_text('Unduh', 'Download'); ?></a>
                 </td>
               </tr>
               <?php $i++; } ?>
             </tbody>
           </table>
         </div>
         </div><!-- End .row -->
       </div>
       </div>
     </div>
   </div>
 </section>