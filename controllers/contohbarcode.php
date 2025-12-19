<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
* Barcode Generator menggunakan Zend Framework library
*
* Ini adalah contoh membuat barcode di CI
* by Dimas Edubuntu Samid
* edudimas1@gmail.com | 0856-8400-407
*
**/
 
class Contohbarcode extends CI_Controller
{
 
function __construct()
{
parent::__construct();
}
 
function index()
{
$this->load->view('barcode_view');
}
 
function bikin_barcode($kode)
{
//kita load library nya ini membaca file Zend.php yang berisi loader
//untuk file yang ada pada folder Zend
$this->load->library('zend');
 
//load yang ada di folder Zend
$this->zend->load('Zend/Barcode');
 
//generate barcodenya
//$kode = 12345abc;
Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
}
//end of class
}