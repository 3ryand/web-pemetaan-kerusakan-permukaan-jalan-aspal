<!DOCTYPE html>
<?php
include 'database.php';
?>
<html>

<head>
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
                    $fileAddr = 'https://automata.masuk.id/home/hasil_deteksi/'.$file;
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
                    file_name + ' width="200px" height="180px"><br><br><a href=' + rawFileName + '&id_gambar=' +
                    id +
                    ' onclick="konfirmasi()" class="btn btn-danger" role="button">Hapus</a></center></div>';

                infoWindow.setContent(msg);
                infoWindow.open(map, marker);
            });
        }
    }
    </script>
    <title>Web Pemetaan Kerusakan Jalan</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo_automata_bulat.png">
</head>

<body>

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
                <td class="align-middle"><?php echo $no; ?></td>
                <td><a id="myImg" href="hasil_deteksi/<?php echo $data['nama_gambar'];?>"><img
                            src="hasil_deteksi/<?php echo $data['nama_gambar'];?>" class="rounded" width='100%'
                            alt="Gambar Kerusakan Jalan"></a></td>
                <td class="align-middle"><a
                        href="http://maps.google.com/maps?q=loc:<?php echo $data['lokasi'];?>"><?php //$response = get_web_page("http://api.positionstack.com/v1/reverse?access_key=ec202e18fb385ea88c736cc48bc79c05&query=".$data['lokasi']);
                                        $koorsplit = explode(",", $data['lokasi']);
                                        //$response = get_web_page("https://api.geoapify.com/v1/geocode/reverse?lat=".$koorsplit[0]."&lon=".$koorsplit[1]."&apiKey=fa093c4bcca34c4ca537f192f33232cc");
                                        $resArr = array();
                                        $resArr = json_decode($response);
                                        echo $data['lokasi'];
                                        //echo $resArr->data[0]->label;
                                        //echo ($resArr->features[0]->properties->road).", ".($resArr->features[0]->properties->formatted);?></a>
                </td>
                <td class="align-middle"><?php echo $data['keterangan'];?></td>
                <td class="align-middle"><a
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
</body>

</html>