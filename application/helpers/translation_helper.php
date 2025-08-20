<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Memuat autoloader dari Composer
if (file_exists(FCPATH . 'vendor/autoload.php')) {
    require_once(FCPATH . 'vendor/autoload.php');
}

if (!function_exists('translate')) {
    /**
     * Menerjemahkan teks menggunakan DeepL API.
     * @param string $text Teks yang akan diterjemahkan.
     * @param string $target_lang Kode bahasa target (misal: 'EN-US').
     * @param string $source_lang Kode bahasa sumber (misal: 'ID').
     * @return string Teks yang sudah diterjemahkan atau teks asli jika gagal.
     */
    function translate($text, $target_lang = 'EN-US', $source_lang = 'ID') {
        // Dapatkan instance CodeIgniter
        $CI =& get_instance();

        // Ambil API key dari file config
        $api_key = $CI->config->item('deepl_api_key');

        if (empty($api_key) || empty($text)) {
            return $text; // Kembalikan teks asli jika tidak ada API key atau teks kosong
        }

        // URL untuk DeepL API (gunakan api-free.deepl.com untuk paket gratis)
        $api_url = 'https://api-free.deepl.com/v2/translate';

        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->post($api_url, [
                'headers' => [
                    'Authorization' => 'DeepL-Auth-Key ' . $api_key,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'text' => [$text],
                    'source_lang' => $source_lang,
                    'target_lang' => $target_lang,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $body = json_decode($response->getBody()->getContents(), true);
                // Periksa apakah terjemahan ada dan tidak kosong
                if (!empty($body['translations']) && !empty($body['translations'][0]['text'])) {
                    return $body['translations'][0]['text'];
                }
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Tangani error jika ada masalah dengan request (misal: koneksi, dll)
            // Di sini kita bisa menambahkan logging error jika diperlukan
            // log_message('error', 'DeepL API request failed: ' . $e->getMessage());
            return $text; // Kembalikan teks asli jika terjadi error
        }

        return $text; // Kembalikan teks asli jika ada masalah lain
    }
}

if (!function_exists('lang_text')) {
    /**
     * Fungsi untuk terjemahan manual berdasarkan session bahasa
     * @param string $id_text Teks dalam bahasa Indonesia
     * @param string $en_text Teks dalam bahasa Inggris
     * @return string Teks sesuai bahasa yang dipilih
     */
    function lang_text($id_text, $en_text) {
        $CI =& get_instance();
        $current_lang = $CI->session->userdata('site_lang');
        
        // Default ke bahasa Indonesia jika tidak ada session
        if (!$current_lang || $current_lang == 'id') {
            return $id_text;
        } else {
            return $en_text;
        }
    }
}

if (!function_exists('smart_translate')) {
    /**
     * Fungsi terjemahan cerdas dengan cache untuk menghemat API
     * @param string $text Teks yang akan diterjemahkan
     * @param string $unique_key Key unik untuk cache (misal: berita_id)
     * @param int $char_limit Batasan karakter (default 200)
     * @return string Teks yang sudah diterjemahkan atau original
     */
    function smart_translate($text, $unique_key = '', $char_limit = 200) {
        $CI =& get_instance();
        $current_lang = $CI->session->userdata('site_lang');
        
        // Batasi karakter untuk tampilan yang rapi (berlaku untuk semua bahasa)
        $limited_text = character_limiter(strip_tags($text), $char_limit);
        
        // Jika bahasa Indonesia atau tidak ada session, return limited text
        if (!$current_lang || $current_lang == 'id') {
            return $limited_text;
        }
        
        // Buat cache key unik
        $cache_key = 'translate_' . md5($unique_key . $text);
        $cached = $CI->session->userdata($cache_key);
        
        // Jika ada cache, gunakan cache
        if ($cached) {
            return $cached;
        }
        
        // Translate menggunakan DeepL
        $translated = translate($limited_text, 'EN-US', 'ID');
        
        // Cache hasil terjemahan ke session
        $CI->session->set_userdata($cache_key, $translated);
        
        return $translated;
    }
}

if (!function_exists('bilingual_search_match')) {
    /**
     * Fungsi untuk mencocokkan keyword dengan teks dalam kedua bahasa
     * @param string $text Teks asli (Indonesia)
     * @param string $unique_key Key unik untuk cache
     * @param string $keywords Kata kunci pencarian
     * @param int $char_limit Batasan karakter untuk terjemahan
     * @return bool True jika cocok dalam salah satu bahasa
     */
    function bilingual_search_match($text, $unique_key, $keywords, $char_limit = 200) {
        $CI =& get_instance();
        $current_lang = $CI->session->userdata('site_lang');
        
        // Cek di teks asli Indonesia
        if (stripos($text, $keywords) !== false) {
            return true;
        }
        
        // Jika bahasa Inggris, cek juga di terjemahan
        if ($current_lang === 'en') {
            $cache_key = 'translate_' . md5($unique_key . $text);
            $cached_translation = $CI->session->userdata($cache_key);
            
            if ($cached_translation && stripos($cached_translation, $keywords) !== false) {
                return true;
            }
            
            // Jika belum ada cache, translate dan cek
            if (!$cached_translation) {
                $limited_text = character_limiter(strip_tags($text), $char_limit);
                $translated = translate($limited_text, 'EN-US', 'ID');
                $CI->session->set_userdata($cache_key, $translated);
                
                if (stripos($translated, $keywords) !== false) {
                    return true;
                }
            }
        }
        
        return false;
    }
}
