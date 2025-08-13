<script type="text/javascript" 
        src="https://code.jquery.com/jquery-3.5.1.js">
    </script>
  
    <!-- DataTables CSS -->
    <link rel="stylesheet" href=
"https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <style type="text/css" class="init">
		/*div.dataTables_wrapper {*/
		/*	margin-bottom: 3em;*/
		/*}*/
	.tebal {
    font-weight : bold;
    }
    td{
    vertical-align: top;
	}
	</style>
    <!-- DataTables JS -->
    <script src=
"https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
    </script>
<script type="text/javascript" src="<?php echo base_url('/assets/viewerjs/site.js.download'); ?>" data-domain="datatables.net"
		data-api="https://plausible.sprymedia.co.uk/api/event"></script>
<script type="text/javascript" class="init">
// 		dt_demo.init({
// 			jquery: function () {
// 				$('table.display').DataTable();
// 			},
// 			vanilla: function () {
// 				new DataTable('table.display');
// 			}
// 		});
		        $(document).ready( function () {
            var tables = $('.mytables').DataTable({
                "dom": '<"top"i>rt<"bottom">p<"clear">',
                "paging": false,
                'ordering': true,
                'searching': true
            });
            
            $('#mySearch').on( 'keyup click', function () {
                tables.tables().search($(this).val()).draw();
            });
        } );
</script>

    <section class="bg-servicesstyle2-section">
    <div class="col-md-12">
          
            <p class="alert alert-success">Data Alumni</p>
        <!--<div class="container">-->
        <p>
        <label for="mySearch">Search Tables</label>
        <input type="text" placeholder="Search..." id="mySearch">
      </p>
<table class="table" width="100%"><tr><td>
					<!--<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper">-->
						<table id="ganjil" class="display mytables" style="width:100%">
							<thead>
								<tr>
								    <th>No.</th>
									<th>Nama</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
							    <?php $i=1; foreach($lulusan as $alumni){ 
            if($alumni->idAlumni % 2 <> 0){
            ?>
								<tr class="odd">
								    <td><?php echo $alumni->idAlumni ?></td>
									<td align="center"><div class="tebal"><?php echo $alumni->namaAlumni ?></div>
										<?php
                   if(empty($alumni->foto)){
                   ?>
                   <img src="<?php echo base_url('/assets/upload/alumni/profil.jpg'); ?>"  width='120' height='400'/>
                   <?php
                   }
                   else{
                    ?>
                    <img src="<?php echo base_url('/assets/upload/alumni/'.$alumni->foto); ?>"  width='300'/>
                    <?php   
                   }
                   ?>
                   <a href="" class="btn btn-sm btn-info" data-toggle="modal"
            data-target="#modal<?php echo $alumni->idAlumni; ?>">Update Biodata</a>
            <div class="modal fade" id="modal<?php echo $alumni->idAlumni; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Data Alumni</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="<?php echo base_url('alumni/aksi_login')?>" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Alumni</label>
                                <input type="text" class="form-control" value="<?php echo $alumni->namaAlumni; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="<?php if($alumni->jkAlumni=="L"){echo "Pria";}else{echo "Wanita";} ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tempat Lahir</label>
                                <input type="text" class="form-control" value="<?php echo $alumni->tmptLhrAlumni; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIM</label>
                                <input type="text" name="nim" class="form-control" placeholder="Masukan NIM sewaktu aktif sebagai mahasiswa" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Lahir</label>
                                <input type="date" name="tglLhr" class="form-control" placeholder="Masukan tanggal lahir anda" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No. PIN</label>
                                <input type="number" name="pin" class="form-control" placeholder="Masukan Penomoran Ijazah Nasional (tertera di ijazah)" required>
                            </div>
                    <!--</div>-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
									</td>
									<td>
										<div class="tebal">Judul TA</div><div><?php echo $alumni->jdlTa ?></div>
										<br/><div class="tebal">Pekerjan Sekarang</div><?php
               foreach($kerjaan as $kerjaanAlumni) {
                  if(($kerjaanAlumni->nim) == ($alumni->nimAlumni)){
                      echo $kerjaanAlumni->jenisPekerjaan." pada ".$kerjaanAlumni->namaInstansi." (".$kerjaanAlumni->jabatan.")<br/>";
                  }
               }
               ?>
          <!--     <ol>-->
          <!--         <li>Pegawa Negeri Sipil (PNS) pada Kominfo (Kasubdit Informasi)</li>-->
										<!--<li>Wirausaha pada PT Perahu Layar (Konsultan)</li>-->
										<!--</ol>-->
									</td>

								</tr>
								<?php
								$i++;    }
                                    }
                                ?>
							</tbody>
							<tfoot>
								<tr>
								    <th rowspan="1" colspan="1">No.</th>
									<th rowspan="1" colspan="1">Nama</th>
									<th rowspan="1" colspan="1">Keterangan</th>
								</tr>
							</tfoot>
						</table>
					<!--</div>-->
				</td>
				
				<td>
					<!--<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper">-->
					<!--<div>-->
						<table id="genap" class="display mytables" width:100%">
							<thead>
								<tr>
								    <th>No.</th>
									<th>Nama</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
							    <?php $i=1; foreach($lulusan as $alumni){ 
                                if($alumni->idAlumni % 2 == 0){
                                ?>
								<tr>
								    <td><?php echo $alumni->idAlumni ?></td>
									<td align="center"><div class="tebal"><?php echo $alumni->namaAlumni ?></div>
										<?php
                   if(empty($alumni->foto)){
                   ?>
                   <img src="<?php echo base_url('/assets/upload/alumni/profil.jpg'); ?>" width='120' height='400'/>
                   <?php
                   }
                   else{
                    ?>
                    <img src="<?php echo base_url('/assets/upload/alumni/'.$alumni->foto); ?>" width='300'/>
                    <?php   
                   }
                   ?>
                   <a href="" class="btn btn-sm btn-info" data-toggle="modal"
            data-target="#modal<?php echo $alumni->idAlumni; ?>">Update Biodata</a>
            <div class="modal fade" id="modal<?php echo $alumni->idAlumni; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Data Alumni</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Alumni</label>
                                <input type="text" class="form-control" value="<?php echo $alumni->namaAlumni; ?>" disabled >
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="<?php if($alumni->jkAlumni=="L"){echo "Pria";}else{echo "Wanita";} ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tempat Lahir</label>
                                <input type="text" class="form-control" value="<?php echo $alumni->tmptLhrAlumni; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NIM</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Lahir</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No. PIN</label>
                                <input type="text" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Masuk</button>
                    </div>
                </div>
            </div>
        </div>
									</td>
									<td>
										<div class="tebal">Judul TA</div><div><?php echo $alumni->jdlTa ?></div>
										<br/><div class="tebal">Pekerjan Sekarang</div><?php
               foreach($kerjaan as $kerjaanAlumni) {
                  if(($kerjaanAlumni->nim) == ($alumni->nimAlumni)){
                      echo $kerjaanAlumni->jenisPekerjaan." pada ".$kerjaanAlumni->namaInstansi." (".$kerjaanAlumni->jabatan.")<br/>";
                  }
               }
               ?>
          <!--     <ul><li>Pegawa Negeri Sipil (PNS) pada Kominfo (Kasubdit Informasi)</li>-->
										<!--<li>Wirausaha pada PT Perahu Layar (Konsultan)</li>-->
										<!--</ul>-->
									</td>

								</tr>
								<?php
								$i++;
								    }
                                    }
                                ?>
							</tbody>
							<tfoot>
								<tr>
								    <th rowspan="1" colspan="1">No.</th>
									<th rowspan="1" colspan="1">Nama</th>
									<th rowspan="1" colspan="1">Keterangan</th>
								</tr>
							</tfoot>
						</table>
					<!--</div>-->
				</td></tr></table>
				<!--</div>-->
				</div>
				</section>