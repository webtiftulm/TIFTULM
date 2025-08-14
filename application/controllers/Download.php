<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('download_model');
		$this->load->model('kategori_download_model');
	}

	// Main page
	public function index()	{
		try {
			$site 	= $this->konfigurasi_model->listing();
			$download 	= $this->download_model->download();
			// End paginasi

			$data = array(	'title'		=> 'Download - '.$site->namaweb,
							'deskripsi'	=> 'Download - '.$site->namaweb,
							'keywords'	=> 'Download - '.$site->namaweb,
							'download'	=> $download,
							'site'		=> $site,
							'isi'		=> 'download/list');
			$this->load->view('layout/wrapper', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menampilkan halaman download. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
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
			show_error('Terjadi error saat menampilkan kategori download. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
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
			show_error('Terjadi error saat menampilkan detail download. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Unduh
	public function unduh($id_download) {
		try {
		    // 1. Validate ID is a number
		    if (!is_numeric($id_download)) {
		        show_error('Invalid download ID.', 400, 'Bad Request');
		        return;
		    }

		    $this->load->helper('download');
		    $download = $this->download_model->detail((int)$id_download);

		    // 2. Check if download entry exists and has a filename
		    if ($download && !empty($download->gambar)) {
		        // 3. Sanitize filename to prevent path traversal
		        $filename = basename($download->gambar);
		        $filepath = './assets/upload/file/' . $filename;

		        // 4. Check if file actually exists before trying to download
		        if (file_exists($filepath)) {
		            force_download($filepath, NULL);
		        } else {
		            show_error('File not found.', 404, 'Not Found');
		        }
		    } else {
		        show_error('Download record not found or filename is missing.', 404, 'Not Found');
		    }
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat mengunduh file. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}

	}
}

/* End of file Download.php */
/* Location: ./application/controllers/Download.php */