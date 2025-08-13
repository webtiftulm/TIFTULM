
<?php
// Validasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload
if(isset($error)) {
	echo '<div class="alert alert-warning">';
	echo $error;
	echo '</div>';
}

// Form open
echo form_open_multipart(base_url('admin/rps/tambah'));
?>
<div class="row">
<div class="col-md-12">

<div class="form-group form-group-lg">
<label>Kode Mata Kuliah</label>
<input type="text" name="kdMatkul" class="form-control" placeholder="Kode Mata Kuliah" value="<?php echo set_value('kdMatkul') ?>">
</div>

</div>

<div class="col-md-12">
<div class="form-group form-group-lg">
<label>Nama Mata Kuliah</label>
<input type="text" name="namaMatkul" class="form-control" placeholder="Nama Mata Kuliah" value="<?php echo set_value('namaMatkul') ?>">
</div>
</div>
<div class="col-md-4">

<div class="form-group">
<label>SKS Matkul</label>
<select name="sksMatkul" class="form-control">
	<?php for($i=1; $i<=6; $i++){ ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>

</div>
</div>

<div class="col-md-4">

<div class="form-group">
<label>Semester Penawaran Mata kuliah</label>
<select name="semesterMatkul" class="form-control">
<?php for($i=1; $i<=8; $i++){ ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Upload file RPS</label>
<input type="file" name="fileRps" class="form-control" required="required" placeholder="Upload file RPS">
</div>
</div>

<div class="col-md-12">

<div class="form-group">
<label>Isi/keterangan</label>
<textarea name="ket" id="ket" class="form-control" placeholder="Keterangan tentang RPS"><?php echo set_value('ket') ?></textarea>
</div>

<div class="form-group">
<label>Status Terlihat</label>
<select name="aktif" class="form-control">
	<?php for($i=0; $i<=1; $i++){ ?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php } ?>
</select>
</div>

<div class="form-group">
<input type="submit" name="submit" class="btn btn-success btn-lg" value="Simpan Data">
<input type="reset" name="reset" class="btn btn-default btn-lg" value="Reset">
</div>

</div>
</div>
<?php
// Form close
echo form_close();
?>