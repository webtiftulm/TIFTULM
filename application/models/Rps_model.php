<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rps_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing() {
		$this->db->select('rps.*');
		$this->db->from('rps');
		$this->db->order_by('semesterMatkul','ASC');
		$this->db->order_by('kdMatkul', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function populer() {
		$this->db->select('*');
		$this->db->from('download');
		$this->db->order_by('hits','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data slider
	public function slider() {
		$this->db->select('download.*, kategori_download.nama_kategori_download, users.nama');
		$this->db->from('download');
		// Join dg 2 tabel
		$this->db->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
		$this->db->join('users','users.id_user = download.id_user','LEFT');
		// End join
		$this->db->where('jenis_download','Homepage');
		$this->db->order_by('id_download','DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data slider
	public function rps() {
		$this->db->select('rps.*');
		$this->db->from('rps');
		$this->db->where('aktif',1);
		$this->db->order_by('semesterMatkul','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data slider
	public function total() {
		$this->db->select('download.*, kategori_download.nama_kategori_download, users.nama');
		$this->db->from('download');
		// Join dg 2 tabel
		$this->db->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download','LEFT');
		$this->db->join('users','users.id_user = download.id_user','LEFT');
		// End join
		$this->db->where('jenis_download','Download');
		$this->db->order_by('id_download','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Kategori
	public function kategori($id_kategori_download) {
		$this->db->select('download.*, kategori_download.nama_kategori_download, users.nama, 
						kategori_download.slug_kategori_download');
		$this->db->from('download');
		// Join dg 2 tabel
		$this->db->join('kategori_download','kategori_download.id_kategori_download = download.id_kategori_download');
		$this->db->join('users','users.id_user = download.id_user','LEFT');
		// End join
		$this->db->where(array(	'jenis_download'				=> 'Download',
								'download.id_kategori_download'	=> $id_kategori_download));
		$this->db->order_by('id_download','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_download) {
		$this->db->select('*');
		$this->db->from('rps');
		$this->db->where('idRps',$id_download);
		$this->db->order_by('idRps','DESC');
		$query = $this->db->get();
		return $query->row();
	}

    // Detail data
	public function read($slug_download) {
		$this->db->select('*');
		$this->db->from('rps');
		$this->db->where('idRps',$slug_download);
		$query = $this->db->get();
		return $query->row();
	}
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('rps',$data);
	}

	// Edit
	public function edit($data) {
		$this->db->where('idRps',$data['idRps']);
		$this->db->update('rps',$data);
	}

	// Edit
	public function edit2($data2) {
		$this->db->where('id_download',$data2['id_download']);
		$this->db->update('download',$data2);
	}

	// Delete
	public function delete($data) {
		$this->db->where('idRps',$data['idRps']);
		$this->db->delete('rps',$data);
	}
}

/* End of file Download_model.php */
/* Location: ./application/models/Download_model.php */