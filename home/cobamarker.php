<?php include "database.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Marker Map </title>
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBwbzBGhooCgamUF6BN9aGV0NRg6Vqug4&callback=initMap"></script>
    <script>
        // fungsi initialize untuk mempersiapkan peta
        function initialize() {
            var infoWindow = new google.maps.InfoWindow;
            var propertiPeta = {
                center:new google.maps.LatLng(-7.6477175,111.5265427),
                zoom:9,
                mapTypeId:google.maps.MapTypeId.ROADMAP
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
            
                    echo ("addMarker($lat, $lon, '$fileAddr', '<strong>$keterangan</strong>', $id_gambar, '$fileRaw');\n");                        
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
             
            function runphp(file_id){
                '<a href="hapus.php?gambar=<?php echo $data['nama_gambar'];?>&id_gambar=<?php echo $data['id'];?>" onclick="konfirmasi()" class="btn btn-danger" role="button">Hapus</a>';
            }
            
            // Menampilkan informasi pada masing-masing marker yang diklik
            function bindInfoWindow(marker, map, infoWindow, file_name, html, id, rawFileName) {
                google.maps.event.addListener(marker, 'click', function() {
                    var msg = '<div style="width:150px;height:150px;"><center>' + html + '<br> <img src='+ file_name + ' width="150px" height="120px"></center></div>';
                    var msg2 = '<div style="width:150px;height:150px;"><center>' + html + '<br> <img src='+ file_name + ' width="150px" height="120px"><br><a href='+rawFileName+'&id_gambar='+id+' onclick="konfirmasi()" class="btn btn-danger" role="button">Hapus</a></center></div>';
                    var msg3 = html+id+rawFileName;
                    infoWindow.setContent(msg2);
                    infoWindow.open(map, marker);
                    testgeorev();
                });
            }
        }
    </script>
    
</head>
<body onload="initialize()">
<!--- Bagian Judul-->   
<div class="container" style="margin-top:10px"> 

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Marker Google Maps</div>
                    <div class="panel-body">
                        <div id="googleMap" style="width: 700px; height: 600px;"></div>
                        <script>
                            function testgeorev(){
                                    var requestOptions = {
                                      method: 'GET',
                                    };
                                    
                                    fetch("https://api.geoapify.com/v1/geocode/reverse?lat=51.21709661403662&lon=6.7782883744862374&apiKey=1db4c29c86154d3e899d14fd07db85c8", requestOptions)
                                      .then(response => response.json())
                                      .then(result => console.log(result))
                                      .catch(error => console.log('error', error));
                                      alert(result);
                            }
                        </script>
                        <?php echo ("testgeorev();\n");?>
                    </div>
            </div>
        </div>  
    </div>
</div>  
</body>
</html>
<script>
    function konfirmasi(){
        konfirmasi=confirm("Apakah anda yakin ingin menghapus gambar ini?")
        document.writeln(konfirmasi)
    }
</script>