<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing($id_anggota=FALSE) {
		$this->db->select('alumni.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff');
		$this->db->from('staff');
		$this->db->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
		if($id_anggota) {
			$this->db->where('staff.id_anggota', $id_anggota);
		}
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function cek_login($nim,$tglLhr,$pin){
	    $query = $this->db->query("select * from alumni where noPin = ? and nimAlumni = ? and tglLhrAlumni = ?",
	    array($pin,$nim,$tglLhr));
	    return $query->row_array();
	    
// 	    $afftectedRows = $this->db->affected_rows();
//   if($afftectedRows == 1){
//       return true;
//   }else{
//      return false;
//   }
  
// 	    $array = array('noPin'=>$alumni['noPin'],
// 	    'nimAlumni'=> $alumni['nimAlumni'],
// 	    'tglLhrAlumni'	=> $alumni['tglLhrAlumni']);
// 		$query = $this->db->where($array);
// 		$query = $this->db->get('alumni');
// 		return $query;
	}	
	
	public function profil($nim){
	    $this->db->select('*');
		$this->db->from('alumni');
		$this->db->where('nimAlumni',$nim);
		$query = $this->db->get();
		return $query->row();
	  }
	  
	public function kerjaan()
	{
		$this->db->select('*');
		$this->db->from('kerjaAlumni');
		$this->db->where(array('berakhirBekerja'=>NULL));
		$this->db->order_by('berakhirBekerja','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Semua
	public function semua() {
		$this->db->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff');
		$this->db->from('staff');
		$this->db->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
		$this->db->where(array(	'status_staff'		=>'Yes'));
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Semua
	public function home() {
		$this->db->select('staff.*, kategori_staff.nama_kategori_staff, kategori_staff.slug_kategori_staff');
		$this->db->from('staff');
		$this->db->join('kategori_staff','kategori_staff.id_kategori_staff = staff.id_kategori_staff','LEFT');
		$this->db->where(array(	'status_staff'		=>'Yes'));
		$this->db->order_by('urutan','ASC');
		$this->db->limit(12);
		$query = $this->db->get();
		return $query->result();
	}

	// Semua
	public function kategori($id_kategori_staff) {
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where(array(	'status_staff'		=>'Yes',
								'id_kategori_staff'	=> $id_kategori_staff));
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Semua
// 	public function semua_staff($limit, $start) {
	public function semua_alumni() {
		$this->db->select('*');
		$this->db->from('alumni');
		$this->db->order_by('idAlumni','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Semua
	public function total_staff() {
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where(array('status_staff'=>'Yes'));
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Listing Besar
	public function listing_besar() {
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where(array('status_staff'=>'Ya','ukuran' => 'Besar'));
		$this->db->order_by('id_staff','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Besar
	public function total_besar() {
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where(array('status_staff'=>'Ya','ukuran' => 'Besar'));
		$this->db->order_by('id_staff','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
		
	// Detail
	public function detail($id_staff) {
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where('id_staff',$id_staff);
		$this->db->order_by('urutan','DESC');
		$query = $this->db->get();
		return $query->row();
	}
	
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('staff',$data);
	}
	
// 	Edit
	public function edit($data) {
		$this->db->where('id_staff', $data['id_staff']);
		$this->db->update('staff',$data);
	}

	// Delete
	public function delete($data) {
		$this->db->where('id_staff',$data['id_staff']);
		$this->db->delete('staff',$data);
	}
}
