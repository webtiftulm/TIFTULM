<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Berita extends CI_Controller {

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('berita_model');
		$this->load->model('kategori_model');
		$this->load->model('download_model');
		$this->load->model('galeri_model');
		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan',$url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);

	}

	// Halaman berita
	public function index(){
		try {
			$berita = $this->berita_model->listing();
			$site 	= $this->konfigurasi_model->listing();

			$data = array(	'title'			=> 'Berita/Profil ('.count($berita).')',
							'berita'		=> $berita,
							'site'			=> $site,
							'isi'			=> 'admin/berita/list');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengambil data berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Halaman download
	public function files(){
		try {
			$download = $this->download_model->listing();
			$data = array(	'title'			=> 'Download',
							'download'		=> $download);
			$this->load->view('admin/berita/files', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengambil data file. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Halaman download
	public function gambar(){
		try {
			$galeri = $this->galeri_model->listing();
			$data = array(	'title'			=> 'Galeri',
							'galeri'		=> $galeri);
			$this->load->view('admin/berita/gambar', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengambil data gambar. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Jenis berita
	public function jenis_berita($jenis_berita){
		try {
			$berita = $this->berita_model->jenis_admin($jenis_berita);
			$data = array(	'title'			=> 'Jenis berita: '.$jenis_berita.' ('.count($berita).')',
							'berita'		=> $berita,
							'isi'			=> 'admin/berita/list');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengambil data jenis berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Status berita
	public function status_berita($status_berita){
		try {
			$berita = $this->berita_model->status_admin($status_berita);
			$data = array(	'title'			=> 'Status berita: '.$status_berita.' ('.count($berita).')',
							'berita'		=> $berita,
							'isi'			=> 'admin/berita/list');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengambil data status berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Proses
	public function proses()
	{
		try {
			$site = $this->konfigurasi_model->listing();
			// PROSES HAPUS MULTIPLE
			if(isset($_POST['hapus'])) {
				$inp 				= $this->input;
				$id_beritanya		= $inp->post('id_berita');

				for($i=0; $i < sizeof($id_beritanya);$i++) {
					$berita 	= $this->berita_model->detail($id_beritanya[$i]);
					if($berita->gambar !='') {
						unlink('./assets/upload/berita/'.$berita->gambar);
						unlink('./assets/upload/berita/thumbs/'.$berita->gambar);
					}
					$data = array(	'id_berita'	=> $id_beritanya[$i]);
					$this->berita_model->delete($data);
				}

				$this->session->set_flashdata('sukses', 'Data telah dihapus');
				redirect(base_url('admin/berita'),'refresh');
			// PROSES SETTING DRAFT
			}elseif(isset($_POST['draft'])) {
				$inp 				= $this->input;
				$id_beritanya		= $inp->post('id_berita');

				for($i=0; $i < sizeof($id_beritanya);$i++) {
					$berita 	= $this->berita_model->detail($id_beritanya[$i]);
					$data = array(	'id_berita'		=> $id_beritanya[$i],
												'status_berita'	=> 'Draft');
					$this->berita_model->edit($data);
				}

				$this->session->set_flashdata('sukses', 'Data telah diset untuk tidak dipublikasikan');
				redirect(base_url('admin/berita'),'refresh');
			// PROSES SETTING PUBLISH
			}elseif(isset($_POST['publish'])) {
				$inp 				= $this->input;
				$id_beritanya		= $inp->post('id_berita');

				for($i=0; $i < sizeof($id_beritanya);$i++) {
					$berita 	= $this->berita_model->detail($id_beritanya[$i]);
					$data = array(	'id_berita'		=> $id_beritanya[$i],
												'status_berita'	=> 'Publish');
					$this->berita_model->edit($data);
				}

				$this->session->set_flashdata('sukses', 'Data telah dipublikasikan');
				redirect(base_url('admin/berita'),'refresh');
			}
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat memproses berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Kategori berita
	public function kategori($id_kategori){
		try {
			$berita 	= $this->berita_model->kategori_admin($id_kategori);
			$kategori 	= $this->kategori_model->detail($id_kategori);

			$data = array(	'title'			=> 'Kategori berita: '.$kategori->nama_kategori.' ('.count($berita).')',
							'berita'		=> $berita,
							'isi'			=> 'admin/berita/list');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengambil data kategori berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Author berita
	public function author($id_user){
		try {
			$berita 	= $this->berita_model->author_admin($id_user);
			$user 		= $this->user_model->detail($id_user);

			$data = array(	'title'			=> 'Penulis berita: '.$user->nama.' ('.count($berita).')',
							'berita'		=> $berita,
							'isi'			=> 'admin/berita/list');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengambil data penulis berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Tambah berita
	public function tambah(){
		try {
			// $this->session->set_userdata('upload_image_file_manager',true);
			$kategori = $this->kategori_model->listing();
			$this->session->set_userdata('upload_image_file_manager',true);

			// Validasi
			$valid = $this->form_validation;

			$valid->set_rules('judul_berita','Judul','required',
				array( 	'required' 	=> 'Judul harus diisi'));

			$valid->set_rules('isi','Isi','required',
				array( 	'required' 	=> 'Isi berita harus diisi'));

			if($valid->run()) {
				if(!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 	= './assets/upload/image/';
      			$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
      			$config['max_size'] 		= '12000'; // KB  
				$this->load->library('upload', $config);
      			if(! $this->upload->do_upload('gambar')) {
			// End validasi

			$data = array( 	'title'			=> 'Tambah Berita/Profil',
								'kategori'		=> $kategori,
								'error'    		=> $this->upload->display_errors(),
								'isi'			=> 'admin/berita/tambah');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk database
			}else{
				$upload_data 			= array('uploads' =>$this->upload->data());
		        // Image Editor
		        $config['image_library']  	= 'gd2';
		        $config['source_image']   	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
		        $config['new_image']     	= './assets/upload/image/thumbs/';
		        $config['create_thumb']   	= TRUE;
		        $config['quality']       	= "100%";
		        $config['maintain_ratio'] 	= TRUE;
		        $config['width']       		= 360; // Pixel
		        $config['height']       	= 360; // Pixel
		        $config['x_axis']       	= 0;
		        $config['y_axis']       	= 0;
		        $config['thumb_marker'] 	= '';
		        $this->load->library('image_lib', $config);
		        $this->image_lib->resize();

		        $i 		= $this->input;
		        $slug 	= url_title($i->post('judul_berita'),'dash',TRUE);

				// Terjemahkan konten
				$tr = new GoogleTranslate('en');
				$judul_berita_id = $i->post('judul_berita');
				$isi_id = $i->post('isi');

				$judul_berita_en = $tr->translate($judul_berita_id);
				$isi_en = $tr->translate($isi_id);


		        $data = array( 	'id_kategori'	=> $i->post('id_kategori'),
	        							'id_user'		=> $this->session->userdata('id_user'),
	        							'slug_berita'	=> $slug,
	        							'judul_berita'	=> $judul_berita_id,
	        							'isi'			=> $isi_id,
										'judul_berita_en'	=> $judul_berita_en,
										'isi_en'			=> $isi_en,
	        							'jenis_berita'	=> $i->post('jenis_berita'),
	        							'status_berita'	=> $i->post('status_berita'),
	        							'gambar'		=> $upload_data['uploads']['file_name'],
	        							'icon'			=> $i->post('icon'),
	        							'keywords'		=> $i->post('keywords'),
	        							'tanggal_publish'=> date('Y-m-d',strtotime($i->post('tanggal_publish'))).' '.$i->post('jam_publish'),
	        							// 'tanggal_mulai'		=> $i->post('tanggal_mulai'),
	        							// 'tanggal_selesai'		=> $i->post('tanggal_selesai'),
	        							'urutan'	=> $i->post('urutan'),
	        							'tanggal_post'	=> date('Y-m-d H:i:s'),
	        							);
		        $this->berita_model->tambah($data);
		        $this->session->set_flashdata('sukses', 'Data telah ditambah');
		        redirect(base_url('admin/berita/jenis_berita/'.$i->post('jenis_berita')),'refresh');
			}}
			else{
				$i 		= $this->input;
		        $slug 	= url_title($i->post('judul_berita'),'dash',TRUE);

				// Terjemahkan konten
				$tr = new GoogleTranslate('en');
				$judul_berita_id = $i->post('judul_berita');
				$isi_id = $i->post('isi');

				$judul_berita_en = $tr->translate($judul_berita_id);
				$isi_en = $tr->translate($isi_id);

		        $data = array( 	'id_kategori'	=> $i->post('id_kategori'),
	        							'id_user'		=> $this->session->userdata('id_user'),
	        							'slug_berita'	=> $slug,
	        							'judul_berita'	=> $judul_berita_id,
	        							'isi'			=> $isi_id,
										'judul_berita_en'	=> $judul_berita_en,
										'isi_en'			=> $isi_en,
	        							'jenis_berita'	=> $i->post('jenis_berita'),
	        							'status_berita'	=> $i->post('status_berita'),
	        							'icon'			=> $i->post('icon'),
	        							'keywords'		=> $i->post('keywords'),
	        							'tanggal_publish'=> date('Y-m-d',strtotime($i->post('tanggal_publish'))).' '.$i->post('jam_publish'),
	        							// 'tanggal_mulai'		=> $i->post('tanggal_mulai'),
	        							// 'tanggal_selesai'		=> $i->post('tanggal_selesai'),
	        							'urutan'	=> $i->post('urutan'),
	        							'tanggal_post'	=> date('Y-m-d H:i:s'),
	        							);
		        $this->berita_model->tambah($data);
		        $this->session->set_flashdata('sukses', 'Data telah ditambah');
		        redirect(base_url('admin/berita/jenis_berita/'.$i->post('jenis_berita')),'refresh');
			}}
			// End masuk database
			$data = array( 	'title'			=> 'Tambah Berita/Profil',
								'kategori'		=> $kategori,
								'isi'			=> 'admin/berita/tambah');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menambah berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Edit berita
	public function edit($id_berita){
		try {
			$this->session->set_userdata('upload_image_file_manager',true);
			$kategori 	= $this->kategori_model->listing();
			$berita 	= $this->berita_model->detail($id_berita); 
			$this->session->set_userdata('upload_image_file_manager',true);
			
			// Validasi
			$valid = $this->form_validation;

			$valid->set_rules('judul_berita','Judul','required',
				array( 	'required' 	=> 'Judul harus diisi'));

			$valid->set_rules('isi','Isi','required',
				array( 	'required' 	=> 'Isi berita harus diisi'));

			if($valid->run()) {

				if(!empty($_FILES['gambar']['name'])) {

				$config['upload_path'] 	= './assets/upload/image/';
      			$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
      			$config['max_size'] 		= '12000'; // KB  
				$this->load->library('upload', $config);
      			if(! $this->upload->do_upload('gambar')) {
			// End validasi

			$data = array( 	'title'			=> 'Edit Berita/Profil',
								'kategori'		=> $kategori,
								'berita'		=> $berita,
								'error'    		=> $this->upload->display_errors(),
								'isi'			=> 'admin/berita/edit');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk database
			}else{
				$upload_data 			= array('uploads' =>$this->upload->data());
		        // Image Editor
		        $config['image_library']  	= 'gd2';
		        $config['source_image']   	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
		        $config['new_image']     	= './assets/upload/image/thumbs/';
		        $config['create_thumb']   	= TRUE;
		        $config['quality']       	= "100%";
		        $config['maintain_ratio'] 	= TRUE;
		        $config['width']       		= 360; // Pixel
		        $config['height']       	= 360; // Pixel
		        $config['x_axis']       	= 0;
		        $config['y_axis']       	= 0;
		        $config['thumb_marker'] 	= '';
		        $this->load->library('image_lib', $config);
		        $this->image_lib->resize();

		        //Hapus gambar
		        if($berita->gambar != "") {
		        	unlink('./assets/upload/image/'.$berita->gambar);
					unlink('./assets/upload/image/thumbs/'.$berita->gambar);
		        }
		        // End hapus

		        $i 		= $this->input;
		        $slug 	= url_title($i->post('judul_berita'),'dash',TRUE);

				// Terjemahkan konten
				$tr = new GoogleTranslate('en');
				$judul_berita_id = $i->post('judul_berita');
				$isi_id = $i->post('isi');

				$judul_berita_en = $tr->translate($judul_berita_id);
				$isi_en = $tr->translate($isi_id);

		        $data = array( 	'id_berita'		=> $id_berita,
	        							'id_kategori'	=> $i->post('id_kategori'),
	        							'id_user'		=> $this->session->userdata('id_user'),
	        							'slug_berita'	=> $slug,
	        							'judul_berita'	=> $judul_berita_id,
	        							'isi'			=> $isi_id,
										'judul_berita_en'	=> $judul_berita_en,
										'isi_en'			=> $isi_en,
	        							'jenis_berita'	=> $i->post('jenis_berita'),
	        							'status_berita'	=> $i->post('status_berita'),
	        							'icon'			=> $i->post('icon'),
	        							'gambar'		=> $upload_data['uploads']['file_name'],
	        							'keywords'		=> $i->post('keywords'),
	        							'tanggal_publish'=> date('Y-m-d',strtotime($i->post('tanggal_publish'))).' '.$i->post('jam_publish'),
	        							// 'tanggal_mulai'		=> $i->post('tanggal_mulai'),
	        							// 'tanggal_selesai'		=> $i->post('tanggal_selesai'),
	        							'urutan'	=> $i->post('urutan'),
	        							);
		        $this->berita_model->edit($data);
		        $this->session->set_flashdata('sukses', 'Data telah diedit');
		        redirect(base_url('admin/berita/jenis_berita/'.$i->post('jenis_berita')),'refresh');
			}}
			else{
				$data = array( 	'id_berita'		=> $id_berita,
	        							'id_kategori'	=> $i->post('id_kategori'),
	        							'id_user'		=> $this->session->userdata('id_user'),
	        							'slug_berita'	=> $slug,
	        							'judul_berita'	=> $i->post('judul_berita'),
	        							'isi'			=> $i->post('isi'),
	        							'jenis_berita'	=> $i->post('jenis_berita'),
	        							'status_berita'	=> $i->post('status_berita'),
	        							'icon'			=> $i->post('icon'),
	        							'keywords'		=> $i->post('keywords'),
	        							'tanggal_publish'=> date('Y-m-d',strtotime($i->post('tanggal_publish'))).' '.$i->post('jam_publish'),
	        							// 'tanggal_mulai'		=> $i->post('tanggal_mulai'),
	        							// 'tanggal_selesai'		=> $i->post('tanggal_selesai'),
	        							'urutan'	=> $i->post('urutan'),
	        							);
		        $this->berita_model->edit($data);
		        $this->session->set_flashdata('sukses', 'Data telah diedit');
		        redirect(base_url('admin/berita/jenis_berita/'.$i->post('jenis_berita')),'refresh');
			}}
			// End masuk database
			$data = array( 	'title'			=> 'Edit Berita/Profil',
								'kategori'		=> $kategori,
								'berita'		=> $berita,
								'isi'			=> 'admin/berita/edit');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengedit berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}


	// Delete
	public function delete($id_berita) {
		try {
			// Tambahkan proteksi halaman
			$url_pengalihan = str_replace('index.php/', '', current_url());
			$pengalihan 	= $this->session->set_userdata('pengalihan',$url_pengalihan);
			// Ambil check login dari simple_login
			$this->simple_login->check_login($pengalihan);

			
			$berita = $this->berita_model->detail($id_berita);
			// Proses hapus gambar
			if($berita->gambar != "") {
				unlink('./assets/upload/image/'.$berita->gambar);
				unlink('./assets/upload/image/thumbs/'.$berita->gambar);
			}
			// End hapus gambar
			$data = array('id_berita'	=> $id_berita);
			$this->berita_model->delete($data);
		    $this->session->set_flashdata('sukses', 'Data telah dihapus');
		    redirect(base_url('admin/berita'),'refresh');
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menghapus berita. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}
}

/* End of file Berita.php */
/* Location: ./application/controllers/admin/Berita.php */