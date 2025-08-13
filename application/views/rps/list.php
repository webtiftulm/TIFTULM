<section class="bg-servicesstyle2-section">
  <div class="container">
    <div class="row">
      <div class="our-services-option">
        <div class="section-header">
          <h2><?php //echo $title ?> Rencana Pembelajaran Semester</h2>
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
            <p class="alert alert-success">Berikut data Rencana Pembelajaran Semester (RPS) Tiap Matakuliah pada Program Studi Teknologi Informasi ULM</p>

          <?php }else{ ?>
            <p class="alert alert-success">Berikut data file <strong><?php echo $kategori_download->nama_kategori_download ?></strong> yang dapat Anda unduh</p>
          <?php } ?>
          <div class="table-responsive mailbox-messages">
          <table id="example1" class="display table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
             <tr>
               <th width="5%">No</th>
               <th>Kode Mata Kuliah</th>
               <th>Nama Mata Kuliah</th>
               <th>SKS</th>
               <th>Semester</th>
               <th>Keterangan</th>
               <th>Dokumen RPS</th>
             </tr>
           </thead>
           <tbody>
            <?php $i=1; foreach($rps as $rps) { ?>
             <tr <?php if($rps->semesterMatkul % 2 == 0){ echo"bgcolor='#EBF5FB'";}?>>
               <td><?php echo $i ?></td>
               <td><?php echo $rps->kdMatkul ?></td>
               <td><?php echo $rps->namaMatkul ?></td>
               <td><?php echo $rps->sksMatkul ?></td>
               <td><?php echo $rps->semesterMatkul ?></td>
               <td><?php echo $rps->ket ?></td>
               <td><?php if(!empty($rps->fileRps)){ ?>
                 <a href="<?php echo base_url('rps/unduh/'.$rps->idRps) ?>" class="btn btn-primary btn-xs" target="_blank">
                   <i class="fa fa-download"></i> Unduh RPS</a>
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