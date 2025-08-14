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
		try {
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
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menampilkan halaman RPS. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Kategori
	public function kategori($slug_kategori_download)	{
		try {
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
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menampilkan kategori RPS. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Read download detail
	public function read($slug_download)	{
		try {
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
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menampilkan detail RPS. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Unduh
	public function unduh($idRps) { // Changed variable name for clarity
	    try {
	        // 1. Validate ID is a number
	        if (!is_numeric($idRps)) {
	            show_error('Invalid RPS ID.', 400, 'Bad Request');
	            return;
	        }

	        $this->load->helper('download');
	        $rps = $this->rps_model->detail((int)$idRps);

	        // 2. Check if RPS entry exists and has a filename
	        if ($rps && !empty($rps->fileRps)) {
	            // 3. Sanitize filename to prevent path traversal
	            $filename = basename($rps->fileRps);
	            $filepath = './assets/upload/file/' . $filename;

	            // 4. Check if file actually exists before trying to download
	            if (file_exists($filepath)) {
	                force_download($filepath, NULL);
	            } else {
	                show_error('File not found.', 404, 'Not Found');
	            }
	        } else {
	            show_error('RPS record not found or filename is missing.', 404, 'Not Found');
	        }
	    } catch (Exception $e) {
	                \Sentry\captureException($e);
	        show_error('Terjadi error saat mengunduh RPS. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
	    }
	}
}

/* End of file Download.php */
/* Location: ./application/controllers/Download.php */