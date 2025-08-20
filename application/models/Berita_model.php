<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing() {
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function dasbor() {
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function bulanan($bulan) {
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where('DATE_FORMAT(berita.tanggal,"%Y-%m")',$bulan);
		$this->db->order_by('hits','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function tahunan($tahun) {
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where('DATE_FORMAT(berita.tanggal,"%Y")',$tahun);
		$this->db->order_by('hits','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Kunjungan berita teramai
	public function populer()
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array(	'berita.status_berita'	=> 'Publish'));
		$this->db->order_by('hits','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Kunjungan berita teramai
	public function hits()
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->order_by('hits','DESC');
		$this->db->limit(100);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function kategori_admin($id_kategori) {
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.id_kategori'	=> $id_kategori));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function status_admin($status_berita) {
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.status_berita'	=> $status_berita));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function jenis_admin($jenis_berita) {
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.jenis_berita'	=> $jenis_berita));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function author_admin($id_user) {
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.id_user'	=> $id_user));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function kategori($id_kategori,$limit,$start) {
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.id_kategori'	=> $id_kategori,
								'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Berita'));
		$this->db->order_by('id_berita','DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function all_kategori($id_kategori) {
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.id_kategori'	=> $id_kategori,
								'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Berita'));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}


	// Listing berita
	public function berita($limit,$start) {
		$language = $this->session->userdata('language');

        if ($language == 'english') {
            $this->db->select('berita.id_berita, berita.slug_berita, berita.judul_berita_en AS judul_berita, berita.isi_en AS isi, berita.gambar, berita.tanggal_publish, users.nama, kategori.nama_kategori, kategori.slug_kategori');
        } else {
    		$this->db->select('berita.*, 
					users.nama, 
					kategori.nama_kategori, kategori.slug_kategori,
					kategori.slug_kategori
					');
        }
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Berita'));
		$this->db->order_by('berita.tanggal_publish','DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing total
	public function total() {
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Berita'));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing berita
	public function search($keywords,$limit,$start) {
		$this->load->helper('translation');
		
		// Get all berita first, then filter with bilingual search
		$this->db->select('berita.*, 
				users.nama, 
				kategori.nama_kategori, kategori.slug_kategori
				');
		$this->db->from('berita');
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Berita'));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		$all_berita = $query->result();
		
		// Filter dengan bilingual search
		$matching_results = [];
		foreach ($all_berita as $berita) {
			// Cek judul dan isi dengan bilingual matching
			$title_match = bilingual_search_match($berita->judul_berita, 'berita_list_title_'.$berita->id_berita, $keywords, 120);
			$content_match = bilingual_search_match($berita->isi, 'berita_list_content_'.$berita->id_berita, $keywords, 180);
			
			if ($title_match || $content_match) {
				$matching_results[] = $berita;
			}
		}
		
		// Apply pagination
		return array_slice($matching_results, $start, $limit);
	}

	// Listing total
	public function total_search($keywords) {
		$this->load->helper('translation');
		
		// Get all berita first, then filter with bilingual search
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Berita'));
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		$all_berita = $query->result();
		
		// Filter dengan bilingual search
		$matching_results = [];
		foreach ($all_berita as $berita) {
			// Cek judul dan isi dengan bilingual matching
			$title_match = bilingual_search_match($berita->judul_berita, 'berita_list_title_'.$berita->id_berita, $keywords, 120);
			$content_match = bilingual_search_match($berita->isi, 'berita_list_content_'.$berita->id_berita, $keywords, 180);
			
			if ($title_match || $content_match) {
				$matching_results[] = $berita;
			}
		}
		
		return $matching_results;
	}

	// Listing read
	public function listing_read() {
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Berita'));
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing profil
	public function listing_profil() {
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Profil'));
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing layanan
	public function listing_layanan() {
		$this->db->select('berita.*, users.nama');
		$this->db->from('berita');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Layanan'));
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing headline
	public function listing_headline() {
		$this->db->select('berita.*, 
					users.nama, 
					kategori.nama_kategori, kategori.slug_kategori,
					kategori.slug_kategori
					');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		// End join
		$this->db->where(array(	'berita.status_berita'	=> 'Publish',
								'berita.jenis_berita'	=> 'Headline'));
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(9);
		$query = $this->db->get();
		return $query->result();
	}


	// Read data
	public function read($slug_berita) {
		// Ambil bahasa dari session
        $language = $this->session->userdata('language');

        if ($language == 'english') {
            // Jika bahasa Inggris, pilih kolom _en dan beri alias ke nama kolom asli
            $this->db->select('berita.id_berita, berita.id_user, berita.id_kategori, '.
                               'berita.slug_berita, berita.judul_berita_en AS judul_berita, '.
                               'berita.isi_en AS isi, berita.gambar, berita.icon, '.
                               'berita.keywords, berita.status_berita, berita.jenis_berita, '.
                               'berita.tanggal_publish, berita.urutan, berita.tanggal_post, '.
                               'berita.hits, users.nama, kategori.nama_kategori, '.
                               'kategori.slug_kategori');
        } else {
            // Jika bahasa Indonesia atau default
            $this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
        }

		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori','kategori.id_kategori = berita.id_kategori','LEFT');
		$this->db->join('users','users.id_user = berita.id_user','LEFT');
		$this->db->where('slug_berita',$slug_berita);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail data
	public function detail($id_berita) {
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('id_berita',$id_berita);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data) {
		$this->db->insert('berita',$data);
	}

	// Edit
	public function edit($data) {
		$this->db->where('id_berita',$data['id_berita']);
		$this->db->update('berita',$data);
	}

	// Edit hit
	public function update_hit($hit) {
		$this->db->where('id_berita',$hit['id_berita']);
		$this->db->update('berita',$hit);
	}

	// Delete
	public function delete($data) {
		$this->db->where('id_berita',$data['id_berita']);
		$this->db->delete('berita',$data);
	}
}

/* End of file Berita_model.php */
/* Location: ./application/models/Berita_model.php */