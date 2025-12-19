<?php
// Kompatibilitas MPDF Lama → MPDF v8 (PHP 7.4+)
// File ini menggantikan MPDF lama tanpa ubah kode controller

require_once APPPATH . '../vendor/autoload.php';

class mPDF {
    private $mpdf;

    public function __construct($mode = 'utf-8', $format = 'A4', $marginLeft = 15, $marginRight = 15, $marginTop = 16, $marginBottom = 16, $marginHeader = 9, $marginFooter = 9) {
        $this->mpdf = new \Mpdf\Mpdf([
            'mode' => $mode,
            'format' => $format,
            'margin_left' => $marginLeft,
            'margin_right' => $marginRight,
            'margin_top' => $marginTop,
            'margin_bottom' => $marginBottom,
            'margin_header' => $marginHeader,
            'margin_footer' => $marginFooter,
        ]);
    }

    public function SetFooter($content = '') {
        if ($content) {
            $this->mpdf->SetHTMLFooter('<div style="text-align: center; font-size: 9pt;">' . htmlspecialchars($content) . '</div>');
        }
    }

    public function AddPage($orientation = '', $type = '', $resetpagenum = 0, $pagenumstyle = '', $suppress = '') {
        // Di MPDF v8, halaman baru otomatis dibuat saat WriteHTML terlalu panjang
        // Tapi jika benar-benar butuh page break, gunakan:
        $this->mpdf->AddPageByArray([
            'orientation' => $orientation ?: $this->mpdf->CurOrientation,
            'resetpagenum' => $resetpagenum,
            'pagenumstyle' => $pagenumstyle,
            'suppress' => $suppress,
        ]);
    }

    public function WriteHTML($html, $mode = 0) {
        $this->mpdf->WriteHTML($html, $mode);
    }

    public function Output($filename = 'document.pdf', $dest = 'I') {
        $this->mpdf->Output($filename, $dest);
    }

    // Tambahkan method lain jika error muncul (misal: SetProtection, dll)
}