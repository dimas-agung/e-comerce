<?php

if (!function_exists('Rupiah')) {
    function Rupiah($value) {
        return "Rp. ". number_format($value,0,',','.');
    }
}
if (!function_exists('api_url_img')) {
    function api_url_img($value) {
        return "https://admin.fammeessentials.com/public/storage/".$value;
    }
}
if (!function_exists('generate_order_no')) {
    function generate_order_no($count) {
        $prefix = date('Ymd');
        $nomor_penomoran = $prefix . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        return $nomor_penomoran;
        // Logika fungsi Anda di sini
    }
}