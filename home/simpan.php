<?php
    if (isset($_POST['btn_simpan'])) {
        //Include file koneksi, untuk koneksikan ke database
        require('database.php');
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ekstensi_diperbolehkan	= array('png','jpg');
            $gambar = $_FILES['gambar']['name'];
            $x = explode('.', $gambar);
            $y = explode('_', $gambar);
            $z = explode('.jpg', $y[2]);
            $ket = $y[1];
            $koor = $z[0];
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar']['tmp_name'];
            if (cekNamaFile($gambar,$con) == 0){
                if (!empty($gambar)){
                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                        if ($y[1] == "Retak" || $y[1] == "Lubang"){
                            //Mengupload gambar
                            move_uploaded_file($file_tmp, 'hasil_deteksi/'.$gambar);

                            $sql="INSERT INTO gambar_data (nama_gambar, lokasi, keterangan) VALUES ('$gambar', '$koor', '$ket')";

                            $simpan_bank=mysqli_query($con,$sql)or die(mysqli_error($con));

                            if ($simpan_bank) {
                                header("Location:index.php?add=berhasil");
                            }
                            else {
                                header("Location:index.php?add=gagal");
                            }
                        }else{
                            header("Location:index.php?add=gagal3");
                        }
                    }
                }else {
                    header("Location:index.php?add=gagal2");
                }
            }else {
                header("Location:index.php?add=gagal1");
            }
        }
    }

    function cekNamaFile($gambar,$con){
        $nama = mysqli_real_escape_string($con, $gambar);
        $query = "SELECT * FROM gambar_data WHERE nama_gambar = '$gambar'";
        if( $result = mysqli_query($con, $query) ) return mysqli_num_rows($result);
    }
?>