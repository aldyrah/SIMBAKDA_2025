<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('cetak_pdf')) {
    function cetak_pdf($html, $nama_file = 'laporan.pdf', $mode = 'I') {
        // Load MPDF v8
        require_once APPPATH . '../vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 10,
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_file, $mode); // 'I' = tampil, 'D' = download
    }
}