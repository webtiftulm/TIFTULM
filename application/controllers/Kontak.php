<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	// Database
	public function __construct()
	{
		parent::__construct();
	}

	// Main page kontak
	public function index()	{
		try {
			$site 			= $this->konfigurasi_model->listing();

			// Validasi
			$valid = $this->form_validation;
			$valid->set_rules('nama','Nama','required',
				array(	'required'		=> 'Nama harus diisi'));

			$valid->set_rules('subject','subject','required',
				array(	'required'		=> 'Subject harus diisi'));
			
			$valid->set_rules('email','Email','required',
				array(	'required'		=> 'Email harus diisi'));
			
			$valid->set_rules('pesan','Pesan','required',
				array(	'required'		=> 'Pesan harus diisi'));
			
			if($valid->run() === FALSE) {
			// End validasi

			$data = array(	'title'		=> 'Kontak '.$site->namaweb.' | '.$site->tagline,
							'deskripsi'	=> 'Kontak '.$site->namaweb.' | '.$site->tagline.' '.$site->tentang,
							'keywords'	=> 'Kontak '.$site->namaweb.' | '.$site->tagline.' '.$site->keywords,
							'site'		=> $site,
							'isi'		=> 'kontak/list');
			$this->load->view('layout/wrapper', $data, FALSE);
			//Kirim ke pemilik website
			}else{
				      $this->load->helper('security');
				$i 			= $this->input;
				$nama		= $this->security->xss_clean($i->post('nama'));
				$email		= $this->security->xss_clean($i->post('email'));
				$subject	= $this->security->xss_clean($i->post('subject')).' - '.$site->namaweb;
				$pesan		= $this->security->xss_clean($i->post('pesan'));

				$message	= 'Nama pengirim: '.$nama.'<br>'.
							  'Email: '.$email.'<br>'.
							  'Berikut isi pesan:<hr>'.
							  $pesan;
				
				$this->load->library('email');

				$this->email->from($email, $nama);
				$this->email->to($site->email);
				$this->email->cc($email);
				$this->email->bcc($site->email);
				
				$this->email->subject($subject);
				$this->email->message($message);
				
				$this->email->send();
				
				// Redirect page
				$this->session->set_flashdata('sukses','Terimakasih, pesan Anda sudah terkirim');
				redirect(base_url('kontak'));
			}
			// End kirim
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menampilkan halaman kontak. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

}

/* End of file Contact.php */
/* Location: ./application/controllers/Kontak.php */
