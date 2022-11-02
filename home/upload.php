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
if (isset($_POST['btn_upload'])) {
        //Include file koneksi, untuk koneksikan ke database
        require('database.php');
        $pilihankerusakan = stripslashes($_POST['kerusakanlist']);
        $pilihankerusakan = mysqli_real_escape_string($con, $pilihankerusakan);
        $lokasi = stripslashes($_POST['koordinatlokasi']);
        $lokasi = mysqli_real_escape_string($con, $lokasi);
        //cari ekstensi gambar
        $ekstensi_diperbolehkan	= array('png','jpg');
        $gambar = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        //cari koordinat
        $y = explode('(', $lokasi);
        $z = explode(')', $y[1]);
        $koor = explode(',', $z[0]); //lat -> $koor[0]
        $koor2 = explode(' ', $koor[1]); //long -> $koor2[1]
        /*$afterdeclat = explode('.', $koor[0]);
        $digit6 = substr($afterdeclat[1],0,6);*/
        if($pilihankerusakan==1) $ket = "Retak";
        else $ket = "Lubang";
        $lokasi = $koor[0].','.$koor2[1];
        $namafile = '0_'.$ket.'_'.$koor[0].','.$koor2[1].'.'.$ekstensi;
        //echo $lokasi;
        //echo $afterdeclat[0].'.'.$digit6;
        //echo $koor[0];
        //echo $koor2[1];
        if(cekLokasi($lokasi,$con)==0){
            if (!empty($gambar)){
                $response = get_web_page("https://api.geoapify.com/v1/geocode/reverse?lat=".$koor[0]."&lon=".$koor2[1]."&apiKey=fa093c4bcca34c4ca537f192f33232cc");
                $resArr = array();
                $resArr = json_decode($response);
                $lokasistring = ($resArr->features[0]->properties->road).", ".($resArr->features[0]->properties->formatted);
                    if (in_array($ekstensi, $ekstensi_diperbolehkan) == true){
                            //Mengupload gambar
                            move_uploaded_file($file_tmp, 'hasil_deteksi/'.$namafile);

                            $sql="INSERT INTO gambar_data (nama_gambar, lokasi, lokasi_string, keterangan) VALUES ('$namafile', '$lokasi', '$lokasistring', '$ket')";

                            $simpan_bank=mysqli_query($con,$sql)or die(mysqli_error($con));

                            if ($simpan_bank) {
                                $sukses = "DATA BERHASIL DIUPLOAD DAN DISIMPAN.";
                            }
                            else {
                                $error =  "DATA GAGAL DIUPLOAD DAN DISIMPAN!";
                            }
                    }else{
                        $error =  ("EKSTENSI GAMBAR HARUS JPG ATAU PNG!");
                    }
            }else {
                $error =  ("GAMBAR BELUM DIPILIH!");
            }
        }else{
            $error =  ("KERUSAKAN SUDAH DIPETAKAN PADA LOKASI TERSEBUT!");
        }
    }

    function cekLokasi($lok,$con){
        $lok = mysqli_real_escape_string($con, $lok);
        $query = "SELECT * FROM gambar_data WHERE lokasi = '$lok'";
        if( $result = mysqli_query($con, $query) ) return mysqli_num_rows($result);
    }
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
    <title>Upload Kerusakan Jalan</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo_automata_bulat.png">
</head>

<body onload="myMap()" style="overflow-x: visible;">
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
                    <div style="width:900px;margin-top:30px;">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <?php $GLOBALS["error"] = $error; $GLOBALS["sukses"] = $sukses;
                                if($error != ''){ 
                                echo"<div class='alert alert-danger' style='margin-top:10px;' role='alert'>$error</div>";
                                }
                                if($sukses != ''){
                                    echo"<div class='alert alert-success' style='margin-top:10px;' role='alert'><strong>Berhasil!</strong>$sukses</div>";
                            }?>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Kerusakan</label>
                              </div>
                              <select class="custom-select" name="kerusakanlist" id="inputGroupSelect01">
                                <option selected>Pilih Jenis Kerusakan</option>
                                <option value="1">Retak</option>
                                <option value="2">Lubang</option>
                              </select>
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Koordinat</span>
                              </div>
                              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="koordinatlokasi" name="koordinatlokasi">
                            </div>
                            <div class="form-group">
                                <input type="file" name="gambar" class="file">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Upload Gambar"
                                                id="file">
                                    <div class="input-group-append d-flex justify-content-end">
                                        <span><button type="button" id="pilih_gambar" class="browse btn btn-dark"
                                                    style="margin-right:10px;margin-left:10px;">Pilih
                                                    Gambar</button></span>
        
                                        <span><button type="submit" name="btn_upload"
                                                    class="btn btn-success">Upload</button></span>
                                    </div>
                                </div>
                            </div>
                        
                        <div style="justify-content:center;display:flex;color:#ffff;">
                            <div style="width:12;">
                                <div class="col-sm-12">
                                    <div style="justify-content:center;">
                                        <div id="googleMap" style="height:500px;width:900px;"></div>
                                        <script>
                                            function myMap() {
                                                const myLatlng = {lat: -7.6477175, lng: 111.5265427};
                                                const map = new google.maps.Map(document.getElementById("googleMap"), {
                                                    zoom: 10,
                                                    center: myLatlng
                                                  });
                                                let infoWindow = new google.maps.InfoWindow({
                                                    content: "<div style='color:black;'>Click the map to get Lat/Lng!</div>",
                                                    position: myLatlng
                                                });
                                                infoWindow.open(map);
                                                // Configure the click listener.
                                                map.addListener("click", (mapsMouseEvent) => {
                                                    // Close the current InfoWindow.
                                                    infoWindow.close();
                                                    // Create a new InfoWindow.
                                                    infoWindow = new google.maps.InfoWindow({
                                                        position: mapsMouseEvent.latLng,
                                                    });
                                                    var latlongclick = mapsMouseEvent.latLng;
                                                    //JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                                                    document.getElementById("koordinatlokasi").value = latlongclick;
                                                    infoWindow.setContent(
                                                        "<div style='color:black;'>"+latlongclick+"</div>"
                                                        //JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                                                    );
                                                    infoWindow.open(map);
                                                });  
                                            }/*
                                            declare global {
                                              interface Window {
                                                initMap: () => void;
                                              }
                                            }
                                            window.initMap = initMap;
                                            export {};*/
                                        </script>
                                        <script async defer
                                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBwbzBGhooCgamUF6BN9aGV0NRg6Vqug4&callback=myMap">
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
        //window.location.replace("https://automata.masuk.id/home");
    });
}, 2000);
</script>