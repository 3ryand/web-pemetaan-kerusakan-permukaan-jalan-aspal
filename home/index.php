<?php
//inisialisasi session
session_start();
include 'database.php';
//mengecek username pada session
if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: ../index.php');
} else {
  $username = $_SESSION['username'];
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
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBwbzBGhooCgamUF6BN9aGV0NRg6Vqug4&callback=initialize">
    </script>

    <script>
    // fungsi initialize untuk mempersiapkan peta
    function initialize() {
        var infoWindow = new google.maps.InfoWindow;
        var propertiPeta = {
            center: new google.maps.LatLng(-7.6477175, 111.5265427),
            zoom: 9,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        // Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();

        // Pengambilan data dari database
        <?php
                $query = mysqli_query($con,"select * from gambar_data");
                while ($data = mysqli_fetch_array($query))
                {
                    $id_gambar = $data['id'];
                    $file = $data['nama_gambar'];
                    $fileRaw = 'hapus.php?gambar='.$file;
                    $fileAddr = 'hasil_deteksi/'.$file;
                    $keterangan = $data['keterangan'];
                    $lokasi = explode(",", $data['lokasi']);
                    $lat = $lokasi[0];
                    $lon = $lokasi[1];
                    if (!empty($lat)){
                        echo ("addMarker($lat, $lon, '$fileAddr', '<h6>$keterangan</h6>', '$id_gambar', '$fileRaw');\n");
                    }
                }
            ?>

        // Proses membuat marker 
        function addMarker(lat, lng, file, ket, id_gambar, namafile) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                position: lokasi
            });
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, file, ket, id_gambar, namafile);
        }

        // Menampilkan informasi pada masing-masing marker yang diklik
        function bindInfoWindow(marker, map, infoWindow, file_name, html, id, rawFileName) {
            google.maps.event.addListener(marker, 'click', function() {
                var msg = '<div style="width:200px;height:200px;"><center>' + html + '<br> <img src=' +
                    file_name + ' width="200px" height="180px"><br><br><a href=prehapus.php?gambar=' + rawFileName + '&id_gambar=' +
                    id +
                    ' class="btn btn-danger" role="button">Hapus</a></center></div>';

                infoWindow.setContent(msg);
                infoWindow.open(map, marker);
            });
        }
    }
    </script>
    <title>Web Pemetaan Kerusakan Jalan</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo_automata_bulat.png">
</head>

<body onload="initialize()" style="overflow-x: visible;">
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
                <h1
                    style="font-family: 'Nunito', sans-serif;font-weight: 800;font-size: 28px;margin-top:28px;color:#000000;">
                    Pemetaan Kerusakan Permukaan Jalan Aspal</h1>
            </div>
            <div class="col-6 col-md-3"><img src="https://pnm.ac.id/assets/img/top-logo.png" width="200px"
                    style="margin-top:20px;" /></div>
        </div>
    </div>

    <div>
        <div class="container-fluid">
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
                        }else if ($_GET['add']=='gagal3'){
                            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Format nama file hasil deteksi tidak sesuai.</div>";
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
            <?php
                    function get_web_page($url) {
                        $options = array(
                            CURLOPT_RETURNTRANSFER => true,   // return web page
                            CURLOPT_HEADER         => false,  // don't return headers
                            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                            CURLOPT_ENCODING       => "",     // handle compressed
                            CURLOPT_USERAGENT      => "test", // name of client
                            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                            CURLOPT_TIMEOUT        => 120,    // time-out on response
                        ); 
                    
                        $ch = curl_init($url);
                        curl_setopt_array($ch, $options);
                    
                        $content  = curl_exec($ch);
                    
                        curl_close($ch);
                    
                        return $content;
                    }
                ?>
            <div style="justify-content:center;display:flex;margin-top:30px;">
                <div class="jumbotron" style="width:900px;">
                    <h1 class="display-4">Halo, <?php echo $username;?></h1>
                    <p class="lead">Selamat datang di web pemetaan kerusakan jalan.</p>
                    <hr class="my-4">
                    <a class="btn btn-lg btn-primary" href="upload.php" role="button">Upload Kerusakan</a>
                    <a class="btn btn-lg btn-primary" href="cetaklaporan.php" role="button">Cetak Laporan</a>
                    <a style="" class="btn btn-danger btn-lg" href="../logout.php" role="button">Sign Out</a>
                </div>
            </div>
            <div style="justify-content:center;display:flex;color:#ffff;">
                <div style="width:12;">
                    <div class="col-sm-12">
                        <div style="justify-content:center;">
                            <div id="googleMap" style="height:500px;width:900px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="container-fluid" style="justify-content:center;display:flex;width:900px;margin-top:30px;">
                <table id="tabel-data">
                    <thead>
                        <tr>
                            <th class="text-center" width='5%'>No</th>
                            <th class="text-center" width='30%'>Gambar</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center" width='10%'>Aksi</th>
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
                            <td class="text-center"><?php echo $no; ?></td>
                            <td><a id="myImg" href="hasil_deteksi/<?php echo $data['nama_gambar'];?>"><img
                                        src="hasil_deteksi/<?php echo $data['nama_gambar'];?>" class="rounded" width='100%'
                                        alt="Gambar Kerusakan Jalan"></a></td>
                            <td class="text-center"><a
                                    href="http://maps.google.com/maps?q=loc:<?php echo $data['lokasi'];?>" class="btn btn-info" role="button">Lihat di Map</a>
                            </td>
                            <td class="text-center"><?php echo $data['keterangan'];?></td>
                            <td class="text-center"><a
                                    href="prehapus.php?gambar=<?php echo $data['nama_gambar'];?>&id_gambar=<?php echo $data['id'];?>"
                                    class="btn btn-danger" role="button">Hapus</a></td>
                        </tr>
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>
                    </tbody>
                    <script>
                    $(document).ready(function() {
                        $('#tabel-data').DataTable();
                    });
                    </script>
                </table>
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

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
        //window.location.replace("https://automata.masuk.id/home");
    });
}, 2000);
</script>