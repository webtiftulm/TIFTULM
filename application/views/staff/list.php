<section class="bg-servicesstyle2-section">
  <div class="container">
    <div class="row">
      <div class="our-services-option">
        
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
          
            <p class="alert alert-success">Data Staff Pengajar</p>

          
          <div class="table-responsive mailbox-messages">
          <table border=1 width="100%">
           <tbody>
            <?php $i=1; foreach($staff as $staff) { ?>
             <tr>
               <td rowspan=4 width='150'>
                   <!--<img src='pengajar/foto/'<?php// echo $staff->id_staff ?> alt='foto dosen' width='200' height='300'>-->
                   <img src="<?php echo base_url('/assets/upload/staff/'.$staff->gambar); ?>"  width='300' height='400'/>
                   </td>
               <td>Nama</td><td><?php echo $staff->nama ?></td>
               </tr>
               <tr>
               <td>NIDN</td><td><?php echo $staff->keywords ?></td>
               </tr>
               <tr>
               <td>Jabatan</td><td><?php echo $staff->jabatan."<br/>.: <b>".$staff->isi."</b> :." ?></td>
               </tr>
               <tr>
               <td>Bidang Ilmu</td><td><?php echo $staff->keahlian ?></td>
               <!--<td>-->
               <!--  <a href="<?php// echo base_url('pengajar/foto/'.$staff->id_staff) ?>" class="btn btn-primary btn-xs" target="_blank">-->
               <!--    <i class="fa fa-download"></i> Detil</a>-->
               <!--  </td>-->
               </tr>
               <tr>
               <td>ID SINTA:<b><a href='<?php echo "https://sinta.kemdikbud.go.id/authors/profile/".$staff->password_hint ?>' target="_blank">
               <?php echo $staff->password_hint ?></b></td>
               </tr>
               <tr><td colspan=3><hr/></td></tr>
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