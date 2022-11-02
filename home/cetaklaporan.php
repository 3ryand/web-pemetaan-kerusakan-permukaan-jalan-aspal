<?php
//inisialisasi session
session_start();
include 'database.php';
//mengecek username pada session
if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: https://automata.masuk.id');
} else {
  $username = $_SESSION['username'];
}
if( isset($_POST['submit']) ){
        // menghilangkan backshlases
        $pilihanheader = stripslashes($_POST['headerlist']);
        $pilihanheader = mysqli_real_escape_string($con, $pilihanheader);
        $nama_instansi = stripslashes($_POST['instansi']);
        $nama_instansi = mysqli_real_escape_string($con, $nama_instansi);
        $penanggungjawab = stripslashes($_POST['peje']);
        $penanggungjawab = mysqli_real_escape_string($con, $penanggungjawab);
        $alamat_instansi = stripslashes($_POST['alamat']);
        $alamat_instansi = mysqli_real_escape_string($con, $alamat_instansi);
        $telp_instansi = stripslashes($_POST['telepon']);
        $telp_instansi = mysqli_real_escape_string($con, $telp_instansi);
        $fax_instansi = stripslashes($_POST['faksimile']);
        $fax_instansi = mysqli_real_escape_string($con, $fax_instansi);
        $laman_instansi = stripslashes($_POST['laman']);
        $laman_instansi = mysqli_real_escape_string($con, $laman_instansi);
        $email_instansi = stripslashes($_POST['email']);
        $email_instansi = mysqli_real_escape_string($con, $email_instansi);
        $gambar = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        
        if(cek_header($pilihanheader, $con) != 0 ){
            $query = "SELECT * FROM header_laporan_data WHERE id = '$pilihanheader'";
            $konek = mysqli_query($con, $query);
            $result = mysqli_fetch_array($konek);
            cetakpdf($result['nama_instansi'],$result['alamat_instansi'],$result['telepon_instansi'],$result['fax_instansi'],$result['laman_instansi'],$result['email_instansi'],$result['logo_instansi'],$result['penanggung_jawab']);
            $sukses = "Header ".$result['nama_instansi']." berhasil dipilih, tunggu proses pembuatan laporan.";
        }else{
            if(!empty($nama_instansi)&&!empty($penanggungjawab)&&!empty($alamat_instansi)&&!empty($telp_instansi)&&!empty($laman_instansi)&&!empty($email_instansi)){
                move_uploaded_file($file_tmp, 'logo_instansi/'.$gambar);
                $sql="INSERT INTO header_laporan_data (nama_instansi,penanggung_jawab, alamat_instansi, telepon_instansi,fax_instansi, laman_instansi, email_instansi, logo_instansi) VALUES ('$nama_instansi', '$penanggungjawab', '$alamat_instansi', '$telp_instansi','$fax_instansi', '$laman_instansi', '$email_instansi', '$gambar')";
                $simpan_bank=mysqli_query($con,$sql);
                if ($simpan_bank) {
                    $sukses = "Data Header berhasil disimpan, silahkan pilih pada pilihan template.";
                    //cetakpdf($nama_instansi,$penanggungjawab,$alamat_instansi,$telp_instansi,$fax_instansi,$laman_instansi,$email_instansi,$gambar);
                }else{
                    $error = "Data Header Gagal Disimpan";
                }
            }else{
                $error = "Silahkan isi Form Header Baru atau Pilih Template Header!";
            }
        }
    }
    if( isset($_POST['hapustemplate']) ){
        $pilihanheader = stripslashes($_POST['headerlist']);
        $pilihanheader = mysqli_real_escape_string($con, $pilihanheader);
        if(cek_header($pilihanheader, $con) != 0 ){
            $query = "DELETE FROM header_laporan_data WHERE id= '$pilihanheader'";
            if($konek = mysqli_query($con, $query)){
                $sukses = "Template Header berhasil dihapus.";
            }
        }else{
            $error = "Tidak ada Template yang dipilih.";
        }
    }
    function cek_header($namainstansi,$con){
        $query = "SELECT * FROM header_laporan_data WHERE id = '$namainstansi'";
        if($result = mysqli_query($con, $query)) return mysqli_num_rows($result);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;800&display=swap" rel="stylesheet">
    <!-- DATATABLES CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBwbzBGhooCgamUF6BN9aGV0NRg6Vqug4&callback=initialize">
    </script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <title>Cetak Laporan</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo_automata_bulat.png">
</head>
<style>

</style>
<body style="overflow-x: visible;">
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
    <div id="inside-upper-text"
        style="width:100%;height: 100px;background-color: rgb(233,236,239);text-align:center;position:sticky;">
        <div class="align-items-center" style="justify-content:center;display:flex;">
            <div class="col-6 col-md-3"><img src="assets/images/logo_automata_text.png" width="250px"
                    style="margin-top:20px;" /></div>
            <div class="col-6 col-md-6">
                <h1 style="font-family: 'Nunito', sans-serif;font-weight: 800;font-size: 28px;margin-top:28px;color:#000000;">
                    Pemetaan Kerusakan Permukaan Jalan Aspal</h1>
            </div>
            <div class="col-6 col-md-3"><img src="https://pnm.ac.id/assets/img/top-logo.png" width="200px"
                    style="margin-top:20px;" /></div>
        </div>
    </div>

    <div>
        <div class="container-fluid">
            <section class="row justify-content-center">
            <form action="cetaklaporan.php" method="post" enctype="multipart/form-data">
                <?php $GLOBALS["error"] = $error; $GLOBALS["sukses"] = $sukses;
                    if($error != ''){ 
                        echo"<div class='alert alert-danger' style='margin-top:10px;' role='alert'>$error</div>";
                    }
                    if($sukses != ''){
                        echo"<div class='alert alert-success' style='margin-top:10px;' role='alert'><strong>Berhasil!</strong>$sukses</div>";
                    }?>
                        <!-- rows -->
                        <div style="width:900px;margin-top:30px;">
                            <div class="form-group input-group" style="margin-bottom:20px;">
                              <select class="custom-select" name="headerlist" id="inputGroupSelect01">
                                  <option selected>Pilih Header / Kop Laporan</option>
                                  <?php $sql = "SELECT * FROM header_laporan_data";
                                    $all_categories = mysqli_query($con,$sql);
                                  while ($category  = mysqli_fetch_array($all_categories)){;?>
                                  <option value="<?php echo $category['id'];?>"><?php echo $category["nama_instansi"];echo(" - ");echo $category["penanggung_jawab"];}?></option>
                              </select>
                              <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-outline-primary">Cetak Laporan</button>
                                <button type="submit" name="hapustemplate" class="btn btn-outline-danger">Hapus Template</button>
                              </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="instansi" name="instansi"
                                    placeholder="Nama Instansi" style="color: rgba(255, 255, 255, 1);font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Alamat Instansi" style="color: rgba(255, 255, 255, 1);font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="telepon" name="telepon"
                                    placeholder="Telepon Instansi" style="color: rgba(255, 255, 255, 1);font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="faksimile" name="faksimile"
                                    placeholder="Faksimile Instansi" style="color: rgba(255, 255, 255, 1);font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="laman" name="laman"
                                    placeholder="Laman / Website Instansi" style="color: rgba(255, 255, 255, 1);font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Email Instansi" style="color: rgba(255, 255, 255, 1);font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);">
                            </div>
                            <div class="form-group" style="color: rgba(255, 255, 255, 1);">
                                <input type="text" class="form-control" id="peje" name="peje"
                                    placeholder="Penanggung Jawab" style="color: rgba(255, 255, 255, 1);font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);">
                            </div>
                            <div class="form-group">
                                <input type="file" name="gambar" class="file">
                                <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Pilih Logo Instansi"
                                        id="file">
                                <div class="input-group-append d-flex justify-content-end">
                                    <span><button type="button" id="pilih_gambar" class="browse btn btn-dark"
                                            style="margin-right:10px;margin-left:10px;">Pilih
                                            Gambar</button></span>
                                    <span><button type="submit" name="submit"
                                            class="btn btn-success">Simpan Template Header</button></span>
                                </div>
                                </div>
                                <!-- <img src="#" id="preview" class="img-thumbnail"> -->
                            </div>
                        </div>
                    </form>
            </section>
        </div>
    </div>
</body>

</html>

<style>
.file {
    visibility: hidden;
    position: absolute;
}
</style>
<?php
function cetakpdf($nama,$alamat,$telp,$fax,$web,$email,$logo,$pjawab){
    ini_set('memory_limit','128M');
    require('fpdf/fpdf.php');
    include 'database.php';
    $GLOBALS["logo"] = $logo;
    $GLOBALS["nama"] = $nama;
    $GLOBALS["alamat"] = $alamat;
    $GLOBALS["telp"] = $telp;
    $GLOBALS["fax"] = $fax;
    $GLOBALS["web"] = $web;
    $GLOBALS["email"] = $email;
    $GLOBALS["penanggungjawab"] = $pjawab;
    class PDF extends FPDF
    {
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
            $this->Cell(31);
            $this->Cell(0,5,'Telepon '.$GLOBALS["telp"].' Faksimile '.$GLOBALS["fax"],0,1,'C');
            $this->Cell(31);
            $this->Cell(0,5,'Laman : '.$GLOBALS["web"].' / Email : '.$GLOBALS["email"],0,1,'C');
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
    $pdf->Cell(35);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(8,6,'No',1,0,'C');
    $pdf->Cell(30,6,'Kerusakan',1,0,'C');
    $pdf->Cell(50,6,'Lokasi',1,0,'C');
    $pdf->Cell(40,6,'Foto',1,1,'C');
    $pdf->SetFont('Times','',12);
    $mahasiswa = mysqli_query($con, "select * from gambar_data");
    $no = 1;
    while ($row = mysqli_fetch_array($mahasiswa)){
        $pdf->Cell(35);
        $pdf->Cell(8,22,$no++,1,0,'C');
        $pdf->Cell(30,22,$row['keterangan'],1,0);
        $pdf->Cell(50,22,$row['lokasi'],1,0);
        $pdf->Cell(40,22,$pdf->Image('hasil_deteksi/'.$row['nama_gambar'], $pdf->GetX(), $pdf->GetY(), 40),1,1,'C');
    }
    $pdf->Ln(20);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(105);
    $pdf->Cell(20,6,'Madiun, '.tgl_indo(date('Y-m-d')),0,1,'');
    $pdf->Cell(105);
    $pdf->Cell(20,6,'Penanggung Jawab',0,1,'');
    $pdf->Ln(20);
    $pdf->Cell(105);
    $pdf->Cell(10,6,$GLOBALS["penanggungjawab"],0,1,'');
    $pdf->Output('I',date('Ymd').'_Laporan_Kerusakan_Permukaan_Jalan.pdf');
}
?>
<script>
$(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});

$('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);
</script>