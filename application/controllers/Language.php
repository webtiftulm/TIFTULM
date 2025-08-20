<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function switch_lang($language = "id") {
        // Set bahasa yang dipilih ke dalam session
        $this->session->set_userdata('site_lang', $language);

        // Arahkan kembali ke halaman sebelumnya
        // Jika halaman sebelumnya tidak ada, arahkan ke halaman utama
        if (isset($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(base_url());
        }
    }
}
