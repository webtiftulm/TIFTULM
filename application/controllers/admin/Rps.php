<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rps extends CI_Controller {

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rps_model');
// 		$this->load->model('kategori_download_model');
		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan',$url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman download
	public function index()	{
		$rps = $this->rps_model->listing();
		$data = array(	'title'			=> 'Rencana Pembelajaran Semester',
						'rps'		=> $rps,
						'isi'			=> 'admin/rps/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}

	// Proses
	public function proses()
	{
		$site = $this->konfigurasi_model->listing();
		// PROSES HAPUS MULTIPLE
		if(isset($_POST['hapus'])) {
			$inp 				= $this->input;
			$id_downloadnya		= $inp->post('idRps');

   			for($i=0; $i < sizeof($id_downloadnya);$i++) {
   				$rps 	= $this->rps_model->detail($id_downloadnya[$i]);
   				if($rps->fileRps !='') {
					unlink('./assets/upload/file/'.$rps->fileRps);
				}
				$data = array(	'idRps'	=> $id_downloadnya[$i]);
   				$this->rps_model->delete($data);
   			}

   			$this->session->set_flashdata('sukses', 'Data telah dihapus');
   			redirect(base_url('admin/rps'),'refresh');
   		// PROSES SETTING DRAFT
   		}
   	}

	// Download file
	public function unduh($id_download) {
		$rps = $this->download_model->detail($id_download);
		// Contents of photo.jpg will be automatically read
		$data = './assets/upload/file/'.$rps->fileRps;
		force_download($data, NULL);
	}

	// Tambah download
	public function tambah()	{
// 		$kategori_download = $this->kategori_download_model->listing();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('kdMatkul','Kode Mata Kuliah','required',
			array(	'required'	=> 'Kode Matkul harus diisi'));

		$valid->set_rules('namaMatkul','Nama Mata Kuliah','required',
			array(	'required'	=> 'Nama Matkul harus diisi'));
		
		$valid->set_rules('sksMatkul','Jumlah SKS','required',
			array(	'required'	=> 'SKS Matkul harus diisi'));
			
		$valid->set_rules('semesterMatkul','Semester Ditawarkan','required',
			array(	'required'	=> 'Semester harus diisi'));

		if($valid->run()) {
			$config['upload_path']   = './assets/upload/file/';
      		$config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf|zip|rar|doc|docx|xls|xlsx|ppt|pptx';
      		$config['max_size']      = '12000'; // KB  
			$this->load->library('upload', $config);
      		if(! $this->upload->do_upload('fileRps')) {
		// End validasi

		$data = array(	'title'				=> 'Tambah RPS',
				// 		'kategori_download'	=> $kategori_download,
						'error'    			=> $this->upload->display_errors(),
						'isi'				=> 'admin/rps/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_data        		= array('uploads' =>$this->upload->data());
	        $i 		= $this->input;

	        $data = array(	
	           // 'id_kategori_download'=> $i->post('id_kategori_download'),
	        				'id_user'			=> $this->session->userdata('id_user'),
	        				'kdMatkul'		=> $i->post('kdMatkul'),
	        				'namaMatkul'				=> $i->post('namaMatkul'),
	        				'sksMatkul'		=> $i->post('sksMatkul'),
	        				'semesterMatkul'		=> $i->post('semesterMatkul'),
	        				'ket'		=> $i->post('ket'),
	        				'aktif'		=> $i->post('aktif'),
	        				'fileRps'			=> $upload_data['uploads']['file_name']
	        				);
	        $this->rps_model->tambah($data);
	        $this->session->set_flashdata('sukses', 'Data telah ditambah');
	        redirect(base_url('admin/rps'),'refresh');
		}}
		// End masuk database
		$data = array(	'title'				=> 'Tambah RPS',
				// 		'kategori_download'	=> $kategori_download,
						'isi'				=> 'admin/rps/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}

	// Edit download
	public function edit($id_download)	{
// 		$kategori_download 	= $this->kategori_download_model->listing();
		$rps 	= $this->rps_model->detail($id_download); 

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('kdMatkul','Kode Mata Kuliah','required',
			array(	'required'	=> 'Kode Matkul harus diisi'));

		$valid->set_rules('namaMatkul','Nama Mata Kuliah','required',
			array(	'required'	=> 'Nama Matkul harus diisi'));
		
		$valid->set_rules('sksMatkul','Jumlah SKS','required',
			array(	'required'	=> 'SKS Matkul harus diisi'));
			
		$valid->set_rules('semesterMatkul','Semester Ditawarkan','required',
			array(	'required'	=> 'Semester harus diisi'));

		if($valid->run()) {

			if(!empty($_FILES['fileRps']['name'])) {

			$config['upload_path']   = './assets/upload/file/';
      		$config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf|zip|rar|doc|docx|xls|xlsx|ppt|pptx';
      		$config['max_size']      = '120000'; // KB  
			$this->load->library('upload', $config);
      		if(! $this->upload->do_upload('fileRps')) {
		// End validasi

		$data = array(	'title'				=> 'Edit RPS',
				// 		'kategori_download'	=> $kategori_download,
						'rps'			=> $rps,
						'error'    			=> $this->upload->display_errors(),
						'isi'				=> 'admin/rps/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_data        		= array('uploads' =>$this->upload->data());
	        $i 		= $this->input;

	        $data = array(	'idRps'			=> $id_download,
	        			// 	'id_kategori_download'=> $i->post('id_kategori_download'),
	        				'id_user'			=> $this->session->userdata('id_user'),
	        				'kdMatkul'		=> $i->post('kdMatkul'),
	        				'namaMatkul'				=> $i->post('namaMatkul'),
	        				'sksMatkul'		=> $i->post('sksMatkul'),
	        				'semesterMatkul'		=> $i->post('semesterMatkul'),
	        				'ket'		=> $i->post('ket'),
	        				'aktif'		=> $i->post('aktif'),
	        				'fileRps'			=> $upload_data['uploads']['file_name']
	        				);
	        $this->rps_model->edit($data);
	        $this->session->set_flashdata('sukses', 'Data telah diedit');
	        redirect(base_url('admin/rps'),'refresh');
		}}else{

			$i 		= $this->input;

	        $data = array(	'idRps'			=> $id_download,
	        			// 	'id_kategori_download'=> $i->post('id_kategori_download'),
	        				'id_user'			=> $this->session->userdata('id_user'),
	        				'kdMatkul'		=> $i->post('kdMatkul'),
	        				'namaMatkul'				=> $i->post('namaMatkul'),
	        				'sksMatkul'		=> $i->post('sksMatkul'),
	        				'ket'		=> $i->post('ket'),
	        				'aktif'		=> $i->post('aktif'),
	        				'semesterMatkul'			=> $i->post('semesterMatkul')
	        				);
	        $this->rps_model->edit($data);
	        $this->session->set_flashdata('sukses', 'Data telah diedit');
	        redirect(base_url('admin/rps'),'refresh');
		}}
		// End masuk database
		$data = array(	'title'				=> 'Edit RPS',
				// 		'kategori_download'	=> $kategori_download,
						'rps'			=> $rps,
						'isi'				=> 'admin/rps/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}


	// Delete
	public function delete($id_download) {
		// Tambahkan proteksi halaman
$url_pengalihan = str_replace('index.php/', '', current_url());
$pengalihan 	= $this->session->set_userdata('pengalihan',$url_pengalihan);
// Ambil check login dari simple_login
$this->simple_login->check_login($pengalihan);

		$rps = $this->rps_model->detail($id_download);
		// Proses hapus gambar
		if($rps->fileRps != "") {
			unlink('./assets/upload/file/'.$rps->fileRps);
		}
		// End hapus gambar
		$data = array('idRps'	=> $id_download);
		$this->rps_model->delete($data);
	    $this->session->set_flashdata('sukses', 'Data telah dihapus');
	    redirect(base_url('admin/rps'),'refresh');
	}
}

/* End of file Download.php */
/* Location: ./application/controllers/admin/Download.php */