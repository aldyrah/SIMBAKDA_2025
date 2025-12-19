<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak_fpdf extends CI_Controller {
    

    private $data = array();
    private $options = array(
        'filename' => '',
        'destinationfile' => '',
        'paper_size'=>'F4',
        'orientation'=>'L'
    );

	public function __construct($options = array()) {
		parent::__construct();
        $this->data = $this->load_barang();// $data;


        $this->options = $options;
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $this->load->library('fpdf');
	}
	
/*function __construct($data = array(), $options = array()) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
    }*/

public function rptDetailData () {
        //
        $border = 0;
        $this->fpdf->AddPage();
        $this->fpdf->SetAutoPageBreak(true,60);
        $this->fpdf->AliasNbPages();
        $left = 25;
        
        //header
        $this->fpdf->SetFont("", "B", 15);
        $this->fpdf->MultiCell(0, 12, 'PT. ACHMATIM DOT NET');
        $this->fpdf->Cell(0, 1, " ", "B");
        $this->fpdf->Ln(10);
        $this->fpdf->SetFont("", "B", 12);
        $this->fpdf->SetX($left); $this->fpdf->Cell(0, 10, 'LAPORAN DATA KARYAWAN', 0, 1,'C');
        $this->fpdf->Ln(10);
        
        
        $h = 13;
        $left = 40;
        $top = 80;  
        #tableheader
        $this->fpdf->SetFillColor(200,200,200);   
        $left = $this->fpdf->GetX();
        $this->fpdf->Cell(30,$h,'NO',1,0,'L',true);
        $this->fpdf->SetX($left += 30); $this->fpdf->Cell(75, $h, 'NIP', 1, 0, 'C',true);
        $this->fpdf->SetX($left += 75); $this->fpdf->Cell(100, $h, 'NAMA', 1, 0, 'C',true);
        $this->fpdf->SetX($left += 100); $this->fpdf->Cell(150, $h, 'ALAMAT', 1, 0, 'C',true);
        $this->fpdf->SetX($left += 150); $this->fpdf->Cell(100, $h, 'EMAIL', 1, 0, 'C',true);
        $this->fpdf->SetX($left += 100); $this->fpdf->Cell(100, $h, 'WEBSITE', 1, 1, 'C',true);
        //$this->Ln(20);
        
        $this->fpdf->SetFont('Arial','',8);
        $this->SetWidths(array(30,75,100,150,100,100));
        $this->SetAligns(array('L','C','L','L','L','L'));
        $no = 1; $this->fpdf->SetFillColor(255);
        foreach ($this->data as $baris) {
            $this->Row(
                array($no++, 
                $baris['kd_brg'],
                $baris['nm_brg'],
                $baris['kd_rek5'],
                $baris['kd_kelompok'],
                $baris['nmkel']

                
            ));
        }
            

    }

    public function printPDF () {

        if ($this->options['paper_size'] == "F4") {
            $a = 8.3 * 72; //1 inch = 72 pt
            $b = 13.0 * 72;
            $this->fpdf->FPDF($this->options['orientation'], "pt", array($a,$b));
        } else {
            $this->fpdf->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
        }
        
        $this->fpdf->SetAutoPageBreak(false);
        $this->fpdf->AliasNbPages();
        $this->fpdf->SetFont("helvetica", "B", 10);
        //$this->AddPage();
    
        $this->rptDetailData();
                
        $this->fpdf->Output($this->options['filename'],$this->options['destinationfile']);
    }

    private $widths;
    private $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=10*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->fpdf->GetX();
            $y=$this->fpdf->GetY();
            //Draw the border
            $this->fpdf->Rect($x,$y,$w,$h);
            //Print the text
            $this->fpdf->MultiCell($w,10,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->fpdf->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->fpdf->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->fpdf->GetY()+$h>$this->fpdf->PageBreakTrigger)
            $this->fpdf->AddPage($this->fpdf->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        $cMargin=0;
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->fpdf->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->fpdf->rMargin-$this->x;
        $wmax=($w-2*$this->fpdf->cMargin)*1000/$this->fpdf->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

     /*function load_barang() {
           
        
        $sql = "SELECT a.*, concat(kd_kelompok,' - ',(SELECT nm_kelompok FROM mkelompok1 WHERE kd_kelompok = a.kd_kelompok)) AS nmkel FROM mbarang a";
        $query1 = $this->db->query($sql);  
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $data[] = array(
                        'id'          => $ii,        
                        'kd_brg'      => $resulte['kd_brg'],
                        'nm_brg'      => $resulte['nm_brg'],
                        'kd_rek5'     => $resulte['kd_rek5'],
                        'kd_kelompok' => $resulte['kd_kelompok'],
                        'nmkel'       => $resulte['nmkel']                                                                                           
                        );
                        $ii++;
        }
        
        
        
        return $data;

        }*/

        function load_barang() {
           
        
        $sql = "SELECT * from trkib_b where kd_skpd='1.01.01.00'";
        $query1 = $this->db->query($sql);  
        
        
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $data[] = array(
                        'id'          => $ii,        
                        'kd_brg'      => $resulte['id_barang'],
                        'nm_brg'      => $resulte['kd_brg'],
                        'kd_rek5'     => $resulte['nilai'],
                        'kd_kelompok' => $resulte['kondisi'],
                        'nmkel'       => $resulte['tahun']                                                                                           
                        );
                        $ii++;
        }
        
        
        
        return $data;

        }


    
    
}

//contoh penggunaan
/*$data = array(
    array(
        'nip'       => '0111500382',
        'nama'      => 'ACHMAD SOLICHIN',
        'alamat'    => 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
        'email'     => 'achmatim@gmail.com',
        'website'   => 'http://achmatim.net'
    ),
    array(
        'nip'       => '0411500101',
        'nama'      => 'CHOTIMATUL MUSYAROFAH',
        'alamat'    => 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
        'email'     => 'chotimatul.musyarofah@gmail.com',
        'website'   => 'http://contohprogram.info'
    ),
    array(
        'nip'       => '1111500200',
        'nama'      => 'MUHAMMAD ',
        'alamat'    => 'Jl. Raya Caplin, Kec. Ciledug,',
        'email'     => 'achmatim@yahoo.com',
        'website'   => 'http://ebook.achmat'
    )
);*/

//pilihan
$options = array(
    'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
    'destinationfile' => '', //I=inline browser (default), F=local file, D=download
    'paper_size'=>'F4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation'=>'L' //orientation: P=portrait, L=landscape
);


//$data = load_barang();
$tabel = new cetak_fpdf($options);
$tabel->printPDF();