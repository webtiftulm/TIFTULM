<?php
echo form_open(base_url('admin/rps/proses'));
?>
<p class="btn-group">
  <a href="<?php echo base_url('admin/rps/tambah') ?>" class="btn btn-success btn-lg">
  <i class="fa fa-plus"></i> Tambah File</a>

  <button class="btn btn-danger" type="submit" name="hapus" onClick="check();" >
      <i class="fa fa-trash-o"></i> Hapus
    </button> 

</p>


<div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
<tr class="bg-info">
    <th width="5%">
        <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-xs checkbox-toggle"><i class="fa fa-square-o"></i>
            </button>
        </div>
    </th>
    <th width="10%">UNDUH RPS</th>
    <th width="25%">Mata Kuliah</th>
    <th width="20%">SKS</th>
    <th width="20%">Semester</th>
    <th>Keterangan</th>
    <th width="15%">ACTION</th>
</tr>
</thead>
<tbody>

<?php $i=1; foreach($rps as $rps) { ?>

<tr>
    <td>
      <div class="mailbox-star text-center"><div class="text-center">
        <input type="checkbox" class="icheckbox_flat-blue " name="id_download[]" value="<?php echo $rps->idRps ?>">
        <span class="checkmark"></span>
      </div>
    </td>
    <td>
      <a href="<?php echo base_url('admin/rps/unduh/'.$rps->idRps) ?>" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-download"></i> Download</a>
    </td>
    <td><?php echo $rps->kdMatkul ?> - <?php echo $rps->namaMatkul ?>
      
      <br><small>
      Link:<br> 
      <textarea name="aa"><?php echo base_url('rps/unduh/'.$rps->idRps) ?></textarea>
      </small>

    </td>
    <td><?php echo $rps->sksMatkul ?> SKS</td>
    <td><?php echo $rps->semesterMatkul ?></td>
    <td><?php echo $rps->ket ?></td>
    <td>
      <div class="btn-group">
      <!--<a href="<?php// echo base_url('rps/read/'.$rps->idRps) ?>" -->
      <!--class="btn btn-success btn-xs" target="_blank"><i class="fa fa-eye"></i></a>-->

      <a href="<?php echo base_url('admin/rps/edit/'.$rps->idRps) ?>" 
      class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

      <a href="<?php echo base_url('admin/rps/delete/'.$rps->idRps) ?>" 
      class="btn btn-danger btn-xs" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
    </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
<?php echo form_close(); ?>