<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rps extends CI_Controller {

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rps_model');
// 		$this->load->model('kategori_download_model');
	}

	// Main page
	public function index()	{
		$site 	= $this->konfigurasi_model->listing();
		$rps 	= $this->rps_model->rps();
		// End paginasi

		$data = array(	'title'		=> 'RPS - '.$site->namaweb,
						'deskripsi'	=> 'RPS - '.$site->namaweb,
						'keywords'	=> 'RPS - '.$site->namaweb,
						'rps'	=> $rps,
						'site'		=> $site,
						'isi'		=> 'rps/list');
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Kategori
	public function kategori($slug_kategori_download)	{
		$site 					= $this->konfigurasi_model->listing();
		$kategori_download 		= $this->kategori_download_model->read($slug_kategori_download);

		// if(count(array($kategori_download) < 1)) {
		// 	redirect(base_url('oops'),'refresh');
		// }

		$id_kategori_download	= $kategori_download->id_kategori_download;

		

		$download 				= $this->download_model->kategori($id_kategori_download);

		$data = array(	'title'				=> 'Kategori download: '.
												$kategori_download->nama_kategori_download,
						'deskripsi'			=> 'Kategori download: '.
												$kategori_download->nama_kategori_download,
						'keywords'			=> 'Kategori download: '.
												$kategori_download->nama_kategori_download,
						'download'			=> $download,
						'site'				=> $site,
						'kategori_download'	=> $kategori_download,
						'isi'		=> 'download/list');
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Read download detail
	public function read($slug_download)	{
		$site 		= $this->konfigurasi_model->listing();
		$download 	= $this->download_model->read($slug_download);

		if(count(array($download)) < 1) {
			redirect(base_url('oops'),'refresh');
		}



		$listing 	= $this->download_model->listing_read();
		$kategori 	= $this->nav_model->nav_download();

		$data = array(	'title'		=> $download->judul_download,
						'deskripsi'	=> $download->judul_download,
						'keywords'	=> $download->judul_download,
						'download'	=> $download,
						'listing'	=> $listing,
						'kategori'	=> $kategori,
						'site'		=> $site,
						'isi'		=> 'download/read');
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Unduh
	public function unduh($id_download) {
		$this->load->helper('download');
		$rps = $this->rps_model->detail($id_download);
		// Contents of photo.jpg will be automatically read
		force_download('./assets/upload/file/'.$rps->fileRps, NULL);

	}
}

/* End of file Download.php */
/* Location: ./application/controllers/Download.php */