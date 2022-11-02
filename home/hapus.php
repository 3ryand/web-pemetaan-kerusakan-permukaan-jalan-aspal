<?php
    require('database.php');
    $gambar = $_GET["gambar"];
    $id_gambar = $_GET["id_gambar"];
    $sql="DELETE from gambar_data where id=$id_gambar";
    $hapus_bank=mysqli_query($con,$sql);
    //Menghapus file gambar
    $base_dir = realpath("hasil_deteksi");
    $file_delete =  "$base_dir/$gambar";
    if (file_exists($file_delete)) {unlink($file_delete);}
    if ($hapus_bank) {
        header("Location:https://automata.masuk.id/home/index.php?hapus=berhasil");
    }
    else {
        header("Location:https://automata.masuk.id/home/index.php?hapus=gagal");
    }
?>