<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('html_purify')) {
    function html_purify($dirty_html, $config = null) {
        require_once FCPATH . 'vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
        if (is_null($config)) {
            $config = HTMLPurifier_Config::createDefault();
            $config->set('HTML.Allowed', 'p,b,a[href],i,em,strong,ul,li,ol,br');
            $config->set('HTML.Nofollow', true);
            $config->set('HTML.TargetBlank', true);
        }
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($dirty_html);
    }
}
