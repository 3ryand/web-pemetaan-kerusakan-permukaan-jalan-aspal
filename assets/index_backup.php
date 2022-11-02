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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.4.1.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBwbzBGhooCgamUF6BN9aGV0NRg6Vqug4&callback=initialize"></script>

    <script type="text/javascript">
        let map;
        let infoWindow;
        let mapOptions;
        let bounds;
        // fungsi initialize untuk mempersiapkan peta
        function initialize() {
            //infoWindow = new google.maps.InfoWindow;
            var propertiPeta = {
                center:new google.maps.LatLng(-7.6477175,111.5265427),
                zoom:9,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
            var marker=new google.maps.Marker({
                position: new google.maps.LatLng(-8.0080397,111.453517),
                map: peta
            });
            
            // Variabel untuk menyimpan batas kordinat
            /*bounds = new google.maps.LatLngBounds();
            //<?php
            //$query = $db->query("SELECT * FROM gambar_data ORDER BY id ASC");
            //while ($row = $query->fetch_assoc()) {
            //    $nama_gambar = $row["nama_gambar"];
            //    $lokasi = $row["lokasi"];
            //    foreach ($lokasi as $koor) {
            //        $koorLengkap = explode(",", $koor);
            //        $lat  = $koorLengkap[0];
            //        $long = $koorLengkap[1];
            //    }
            //    echo "addMarker($lat, $long, '$nama');\n";
            //}
            ?>
            // Proses membuat marker 
            var location;
            var marker;
            function addMarker(lat, lng, info){
                location = new google.maps.LatLng(lat, lng);
                bounds.extend(location);
                marker = new google.maps.Marker({
                map: map,
                position: location
            });       
                map.fitBounds(bounds);
                bindInfoWindow(marker, map, infoWindow, info);
            }
            // Proses ini dapat menampilkan informasi lokasi Kota/Kab ketika diklik dari masing-masing markernya
            function bindInfoWindow(marker, map, infoWindow, html){
                google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            }*/
        }
        
    </script>
    <title>Web Pemetaan Kerusakan Jalan</title>
</head>
<body onload="initialize()">
<nav class='navbar navbar-expand-lg navbar-dark bg-dark text-light '>
    <div class="container">
        <a href="index.php" class="navbar-brand"><img src="assets/images/logotext.png" width="110" height="30" class="d-inline-block align-top" alt=""> PEMETAAN KERUSAKAN JALAN ASPAL</a>
        <button class="navbar-toggler" type="button" data-togle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto pt-2 pb-2">
            <li class="nav-item">
                <a href="#" class="nav-link text-light"><?php echo $username;?></a>
            </li>
            <li class="nav-item ml-4">
                <a href="../logout.php" class="nav-link text-light"> Log Out </a>
            </li>
        </ul>
    </div>
</nav>
<div class="jumbotron jumbotron-fluid bg-light">
    <div class="container">
        <div class="row">
                <div class="col-6 col-md-6">
        <?php
            //Validasi untuk menampilkan pesan pemberitahuan
            if (isset($_GET['add'])) {
                if ($_GET['add']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> File gambar telah diupload!.</div>";
                }else if ($_GET['add']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> File gambar Gagal diupload!.</div>";
                }else if ($_GET['add']=='gagal1'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> File Gambar telah ada di server.</div>";
                }else if ($_GET['add']=='gagal2'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Silahkan pilih dahulu file yang akan diupload!.</div>";
                }    
            }

            if (isset($_GET['hapus'])) {
        
                if ($_GET['hapus']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> File gambar telah dihapus!</div>";
                }else if ($_GET['hapus']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> File gambar gagal dihapus!</div>";
                }    
            }
            ?>
                    <form action="simpan.php" method="post" enctype="multipart/form-data">
                        <!-- rows -->   
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div id="msg"></div>
                                    <input type="file" name="gambar" class="file" >
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                            <div class="input-group-append">
                                                    <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                                            </div>
                                        </div>
                                    <!-- <img src="#" id="preview" class="img-thumbnail"> -->
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn_simpan" class="btn btn-success">Upload</button>
                    </form>

                    <hr>
                    <div class="row" style="height: 500px; width:100%; overflow:auto">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" width='20%'cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width='5%'>No</th>
                                            <th width='60%'>Gambar</th> 
                                            <th>Lokasi</th>
                                            <th>Keterangan</th>
                                            <th width='10%'>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        // perintah sql untuk menampilkan daftar bank yang berelasi dengan tabel kategori bank
                                        $sql="SELECT * from gambar_data";
                                        $hasil=mysqli_query($con, $sql);
                                        $no=0;
                                        //Menampilkan data dengan perulangan while
                                        while ($data = mysqli_fetch_array($hasil)):
                                        $no++;
                                    ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $no; ?></td>
                                        <td><img src="hasil_deteksi/<?php echo $data['nama_gambar'];?>" class="rounded" width='100%' alt="Gambar Kerusakan Jalan"></td>
                                        <td class="align-middle"><a href="http://maps.google.com/maps?q=loc:<?php echo $data['lokasi'];?>"><?php echo $data['lokasi'];?></a></td>
                                        <td class="align-middle"><?php echo $data['keterangan'];?></td>
                                        <td class="align-middle"><a href="hapus.php?gambar=<?php echo $data['nama_gambar'];?>&id_gambar=<?php echo $data['id'];?>" onclick="konfirmasi()" class="btn btn-danger" role="button">Hapus</a></td>
                                    </tr>
                                    <!-- bagian akhir (penutup) while -->
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div id="googleMap" style="width:100%;height:500px;"></div>
                </div>
            </div>
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

<script>
    function konfirmasi(){
        konfirmasi=confirm("Apakah anda yakin ingin menghapus gambar ini?")
        document.writeln(konfirmasi)
    }
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
</script>