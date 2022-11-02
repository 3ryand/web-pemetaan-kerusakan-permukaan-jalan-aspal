<?php
ini_set('memory_limit','128M');
// memanggil library FPDF
require('fpdf/fpdf.php');
include 'database.php';
$nama_instansi = "Politeknik Negeri Madiun";
$alamat_instansi = "Jl. Serayu no. 84 Madiun Kode Pos 63133";
$telp_instansi = "+62 351 452970";
$fax_instansi = "+62 351 492960";
$laman_instansi = "www.automata.masuk.id";
$email_instansi = "admin@automata.masuk.id";
$gambar = 'logo_automata_bulat.png';
cetakpdf($nama_instansi,$alamat_instansi,$telp_instansi,$fax_instansi,$laman_instansi,$email_instansi,$gambar);
function cetakpdf($nama,$alamat,$telp,$fax,$web,$email,$logo){    
    include 'database.php';
    $GLOBALS["logo"] = $logo;
    $GLOBALS["nama"] = $nama;
    $GLOBALS["alamat"] = $alamat;
    $GLOBALS["telp"] = $telp;
    $GLOBALS["fax"] = $fax;
    $GLOBALS["web"] = $web;
    $GLOBALS["email"] = $email;
    class PDF extends FPDF
    {
        public $nama;
        public function __construct($nama) {
            parent::__construct();
            $this->custom = $nama;
        }
        function Header(){
            $this->Image('logo_instansi/'.$GLOBALS["logo"],30,10,25,25);
            $this->Cell(31);
            $this->SetFont('Times','',15);
            $this->Cell(0,5,$GLOBALS["nama"],0,1,'C');
            $this->Cell(31);
            $this->SetFont('Times','B',15);
            $this->Cell(0,5,'Laporan Kerusakan Permukaan Jalan',0,1,'C');
            $this->Cell(31);
            $this->SetFont('Times','',12);
            $this->Cell(0,5,$GLOBALS["alamat"],0,1,'C');
            $this->Cell(0,5,'Telepon '.$GLOBALS["telp"].' Faksimile '.$GLOBALS["fax"],0,1,'C');
            $this->Cell(31);
            //$this->SetFont('Arial','B',8);
            $this->Cell(0,5,'Laman : '.$GLOBALS["web"].' / Email : '.$GLOBALS["email"],0,1,'C');
            //$this->Cell(25);
            //$this->Cell(0,2,'/ Email : '.$GLOBALS["email"],0,1,'C');
            $this->SetLineWidth(1);
            $this->Line(30,37,183,37);
            $this->SetLineWidth(0);
            $this->Line(30,38,183,38);
            $this->Ln(10);
        }
    }
    function tgl_indo($tanggal){
    	$bulan = array (
    		1 =>   'Januari',
    		'Februari',
    		'Maret',
    		'April',
    		'Mei',
    		'Juni',
    		'Juli',
    		'Agustus',
    		'September',
    		'Oktober',
    		'November',
    		'Desember'
    	);
    	$pecahkan = explode('-', $tanggal);
    	
    	// variabel pecahkan 0 = tanggal
    	// variabel pecahkan 1 = bulan
    	// variabel pecahkan 2 = tahun
     
    	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    $pdf = new PDF('P','mm','A4');
    // membuat halaman baru
    $pdf->AddPage();
    // Memberikan space kebawah agar tidak terlalu rapat
    //$pdf->Cell(0,5,'Tanggal :',0,1);
    //$pdf->Cell(6,30,'',0,1);
    //$pdf->Cell(35);
    //$pdf->SetFont('Times','B',12);
    //$pdf->Cell(8,6,'No',1,0,'C');
    //$pdf->Cell(30,6,'Kerusakan',1,0,'C');
    //$pdf->Cell(50,6,'Lokasi',1,0,'C');
    //$pdf->Cell(40,6,'Foto',1,1,'C');
    //$pdf->SetFont('Times','',12);
    //$mahasiswa = mysqli_query($con, "select * from gambar_data");
    //$no = 1;
    //while ($row = mysqli_fetch_array($mahasiswa)){
    //    $pdf->Cell(35);
    //    $pdf->Cell(8,22,$no++,1,0,'C');
    //    $pdf->Cell(30,22,$row['keterangan'],1,0);
    //    $pdf->Cell(50,22,$row['lokasi'],1,0);
    //    $pdf->Cell(40,22,$pdf->Image('hasil_deteksi/'.$row['nama_gambar'], $pdf->GetX(), $pdf->GetY(), 40),1,1,'C');
    //}
    $pdf->Ln(20);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(105);
    $pdf->Cell(20,6,'Madiun, '.tgl_indo(date('Y-m-d')),0,1,'');
    $pdf->Cell(105);
    $pdf->Cell(20,6,'Yang Bertanggung Jawab',0,1,'');
    $pdf->Ln(20);
    $pdf->Cell(105);
    $pdf->Cell(10,6,'Eryandhi PN',0,1,'');
    $pdf->Output();
}
?>