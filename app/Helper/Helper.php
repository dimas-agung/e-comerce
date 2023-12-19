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