  <section class="bg-servicesstyle2-section">
    <div class="col-md-12">
Login berhasil!
<div><b>Hai, <?php echo $this->session->userdata("nama"); ?></b></div>
<div align="right"><a href="<?php echo base_url('alumni/logout'); ?>">Logout</a></div>
<?php echo form_open_multipart(base_url('alumni/edit/'.$profil->idAlumni),'id="edit"') ?>

    <div class="row">
      <div class="col-md-5">
        <div class="form-group has-error">
          <label class="text-danger">Nama <span class="text-danger">*</span></label>
          <input type="text" name="nama" id="nama" class="form-control" disabled value="<?php echo $profil->namaAlumni ?>">
        </div>

        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tmptLhr" class="form-control" disabled value="<?php echo $profil->tmptLhrAlumni ?>">
          </div>
          
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="text" name="tglLhr" class="form-control" disabled value="<?php echo $profil->tglLhrAlumni ?>">
          </div>

        <div class="form-group">
          <label>Telepon</label>
          <input type="number" name="telepon" id="telepon" class="form-control" placeholder="Telepon" value="<?php echo $profil->telpAlumni ?>" required>
        </div>

        <div class="form-group">
          <label>Alamat Tempat Tinggal</label>
          <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" required><?php echo $profil->alamat ?></textarea>
        </div>
        </div>
        
        <div class="col-md-7">
        <div class="row">
            <div class="col-md-12">
        <div class="form-group">
          <label>Judul TA</label><br/>
          <?php echo $profil->jdlTa ?>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
        <label>Email</label>
          <input type="email" name="email" id="email" class="form-control" disabled value="<?php echo $profil->emailAlumni ?>">
              </div>
            </div>
            
        <div class="col-md-6">
        <div class="form-group">
         <label>IPK</label>
            <input type="number" name="ipk" class="form-control" disabled value="<?php echo $profil->ipk ?>">
            </div>
          </div>
        
<br/>
        <div class="form-group">
          <label>Upload Pas Foto</label>
          <div class="input-group">
              <div class="custom-file">
                <input type="file" name="gambar" id="gambar" class="custom-file-input" placeholder="gambar" value="<?php echo $profil->foto ?>" required>
                <!--<label class="custom-file-label" for="exampleInputFile">Upload Foto/Logo</label>-->
              </div>
          </div>
        </div>
<br/>
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan Data</button>
          <button type="reset" name="reset" class="btn btn-info btn-lg"><i class="fa fa-cut"></i> Reset</button>
         
        </div>

      </div>

    </div>
    </div>
  
<?php echo form_close(); ?>

<script>
$().ready(function() {
// validate signup form on keyup and submit
$("#tambah").validate({
rules: {
  nama: {
    required: true,
    minlength: 4
  },
  email: {
    required: false,
    email: true
  },
},
messages: {
  nama: {
    required: "Isi nama dengan lengkap",
    minlength: "Nama minimal 4 karakter"
  },
  email: "Masukkan alamat email",
}
});
});
</script>

</div>
</section>