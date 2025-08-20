<section class="bg-servicesstyle2-section">
  <div class="container">
    <div class="row">
      <div class="our-services-option">
        <div class="section-header">
          <h2><?php echo lang_text('Rencana Pembelajaran Semester', 'Semester Learning Plan'); ?></h2>
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
            <p class="alert alert-success"><?php echo lang_text('Berikut data Rencana Pembelajaran Semester (RPS) Tiap Matakuliah pada Program Studi Teknologi Informasi ULM', 'Following are Semester Learning Plan (RPS) data for each course in Information Technology Study Program ULM'); ?></p>

          <?php }else{ ?>
            <p class="alert alert-success">Berikut data file <strong><?php echo $kategori_download->nama_kategori_download ?></strong> yang dapat Anda unduh</p>
          <?php } ?>
          <div class="table-responsive mailbox-messages">
          <table id="example1" class="display table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
             <tr>
               <th width="5%"><?php echo lang_text('No', 'No'); ?></th>
               <th><?php echo lang_text('Kode Mata Kuliah', 'Course Code'); ?></th>
               <th><?php echo lang_text('Nama Mata Kuliah', 'Course Name'); ?></th>
               <th><?php echo lang_text('SKS', 'Credits'); ?></th>
               <th><?php echo lang_text('Semester', 'Semester'); ?></th>
               <th><?php echo lang_text('Keterangan', 'Description'); ?></th>
               <th><?php echo lang_text('Dokumen RPS', 'RPS Document'); ?></th>
             </tr>
           </thead>
           <tbody>
            <?php $i=1; foreach($rps as $rps) { ?>
             <tr <?php if($rps->semesterMatkul % 2 == 0){ echo"bgcolor='#EBF5FB'";}?>>
               <td><?php echo $i ?></td>
               <td><?php echo html_escape($rps->kdMatkul) ?></td>
               <td><?php echo smart_translate(html_escape($rps->namaMatkul), 'rps_name_'.$rps->idRps, 80); ?></td>
               <td><?php echo html_escape($rps->sksMatkul) ?></td>
               <td><?php echo html_escape($rps->semesterMatkul) ?></td>
               <td><?php echo smart_translate(html_purify($rps->ket), 'rps_desc_'.$rps->idRps, 100); ?></td>
               <td><?php if(!empty($rps->fileRps)){ ?>
                 <a href="<?php echo base_url('rps/unduh/'.html_escape($rps->idRps)) ?>" class="btn btn-primary btn-xs" target="_blank">
                   <i class="fa fa-download"></i> <?php echo lang_text('Unduh RPS', 'Download RPS'); ?></a>
                   <?php } ?>
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