<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	// Login page
	public function index()
	{
		try {
			// Validasi input
			$this->form_validation->set_rules('username','Username','required',
				array(	'required'	=> '%s harus diisi'));

			$this->form_validation->set_rules('password','Password','required',
				array(	'required'	=> '%s harus diisi'));

			if($this->form_validation->run()) {
				$username 	= strip_tags($this->input->post('username'));
				$password 	= strip_tags($this->input->post('password'));
				// Proses ke simple login
				$this->simple_login->login($username,$password);
			}
			// End validasi

			$data = array(	'title'		=> 'Halaman Login');
			$this->load->view('login/list', $data, FALSE);
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat menampilkan halaman login. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

	// Logout
	public function logout()
	{
		try {
			// Panggil library logout
			$this->simple_login->logout();
		} catch (Exception $e) {
						\Sentry\captureException($e);
			show_error('Terjadi error saat logout. Silakan coba lagi nanti.', 500, 'Kesalahan Server');
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */