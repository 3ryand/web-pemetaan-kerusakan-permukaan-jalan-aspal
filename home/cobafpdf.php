<?php
ini_set('memory_limit','128M');
// memanggil library FPDF
require('fpdf/fpdf.php');
include 'database.php';
// intance object dan memberikan pengaturan halaman PDF
class PDF extends FPDF
{
    function Header()
    {
        // Select Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        //$this->Cell(80);
        // Framed title
        // Insert a logo in the top-left corner at 300 dpi
        $this->Image('assets/images/KopLaporan.jpg',15,10,180);
        // Insert a dynamic image from a URL
        //$this->Image('assets/images/koppnm.png',0,1,'C');
        //$this->Cell(30,10,'LAPORAN KERUSAKAN PERMUKAAN JALAN',0,0,'C');
        // Line break
        $this->Ln(30);
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
$pdf->Cell(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(8,6,'NO',1,0,'C');
$pdf->Cell(30,6,'KERUSAKAN',1,0,'C');
$pdf->Cell(50,6,'LOKASI',1,0,'C');
$pdf->Cell(40,6,'FOTO',1,1,'C');

$pdf->SetFont('Arial','',12);
$mahasiswa = mysqli_query($con, "select * from gambar_data");
$no = 1;
while ($row = mysqli_fetch_array($mahasiswa)){
    $pdf->Cell(35);
    $pdf->Cell(8,22,$no++,1,0,'C');
    $pdf->Cell(30,22,$row['keterangan'],1,0);
    $pdf->Cell(50,22,$row['lokasi'],1,0);
    $pdf->Cell(40,22,$pdf->Image('hasil_deteksi/'.$row['nama_gambar'], $pdf->GetX(), $pdf->GetY(), 40),1,1,'C');
    //$pdf->Cell(27,6,$row[''],1,0);
}
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$pdf->Cell(125);
$pdf->Cell(20,6,'Madiun, '.tgl_indo(date('Y-m-d')),0,1,'C');
$pdf->Cell(130);
$pdf->Cell(20,6,'Yang Bertanggung Jawab',0,1,'C');
$pdf->Ln(20);
$pdf->Cell(123);
$pdf->Cell(10,6,'Eryandhi PN',0,1,'C');
$pdf->Output();
?>