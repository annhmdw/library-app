<?php
function snake_case($string) {
    // Ubah ke lowercase
    $string = strtolower($string);
    // Ganti karakter non-alfanumerik (selain huruf dan angka) dengan underscore
    $string = preg_replace('/[^a-z0-9]+/', '_', $string);
    // Hapus underscore di awal atau akhir (opsional)
    return trim($string, '_');
}