<?php
ob_start();
//menyertakan file program koneksi.php pada register
require('database.php');
$error = '';
$validate = '';
if( isset($_SESSION['user']) ) header('Location: index.php');
//mengecek apakah data username yang diinpukan user kosong atau tidak
if( isset($_POST['submit']) ){
        // menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($con, $username);
        $name     = stripslashes($_POST['name']);
        $name     = mysqli_real_escape_string($con, $name);
        $email    = stripslashes($_POST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $repass   = stripslashes($_POST['repassword']);
        $repass   = mysqli_real_escape_string($con, $repass);
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
            //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
            if($password == $repass){
                //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
                if( cek_nama($username, $con) == 0 ){
                    //hashing password sebelum disimpan didatabase
                    $pass  = password_hash($password, PASSWORD_DEFAULT);
                    //insert data ke database
                    $query = "INSERT INTO user_data (username,name,email,password) VALUES ('$username','$name','$email','$pass')";
                    $result   = mysqli_query($con, $query);
                    //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
                    if ($result) {
                        $_SESSION['username'] = $username;
                        header("Location: index.php");
                    //jika gagal maka akan menampilkan pesan error
                    } else {
                        $error =  'Register User Gagal !!';
                    }
                }else{
                        $error =  'Username sudah terdaftar !!';
                }
            }else{
                $validate = 'Password tidak sama !!';
            }
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
    } 

    //fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_nama($username,$con){
        $query = "SELECT * FROM user_data WHERE username = '$username'";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;800&display=swap" rel="stylesheet">
    <!-- costum css -->
    <link rel="stylesheet" href="assets/style2.css">
    <title>Registrasi Automata</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo_automata_bulat.png">
</head>

<body>
    <div class="upper" style="text-align: center;height: 200px;">
        <div id="inside-upper-text" style="height: 180px;background-color: rgba(94, 129, 244, 0.7);background-image: linear-gradient(0deg, rgba(28,82,160,1) 2%, rgba(24,70,135,1) 50%);background-repeat: no-repeat;background-size: cover;padding-bottom: 120px;">
            <h1 style="padding: 120px;font-family: 'Nunito', sans-serif;font-weight: 800;font-size: 34px;color:#ffff;">Pemetaan Kerusakan Permukaan Jalan Aspal</h1>
        </div>
        <div id="inside-upper-logo">
            <img src="assets/images/logo_automata_bulat.png"  width=100px style="margin-top: 30px;margin-right: 30px;">
            <img src="assets/images/logopnm.png" width=100px style="margin-top: 30px;">
        </div>
    </div>
    <section class="container-fluid mb-4" style="margin-top: 100px;">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="register.php" method="POST">
                    <h4 class="text-center font-weight-bold" style="margin-top: 30px;margin-bottom: 10px;font-family: 'Nunito', sans-serif;"> Registrasi Pengguna </h4>
                    <?php if($error != ''){ 
                    echo"<div class='alert alert-danger' role='alert'>$error</div>";
                    } ?>

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="InputEmail" name="email"
                            aria-describeby="emailHelp" placeholder="Masukkan Email" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Masukkan Username" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="InputPassword" name="password"
                            placeholder=" Masukkan Password" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);">
                        <?php if($validate != '') {?>
                        <p class="text-danger"><?= $validate; ?></p>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="InputRePassword" name="repassword"
                            placeholder="Masukkan Ulang Password" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);">
                        <?php if($validate != '') {?>
                        <p class="text-danger"><?= $validate; ?></p>
                        <?php }?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block" style="font-family: 'Nunito', sans-serif;font-weight: 800;margin-top: 20px;background: rgb(28,82,160);">Sign Up</button>
                    <div class="form-footer mt-2 text-right">
                        <p> Sudah memiliki akun? <a href="https://automata.masuk.id/" style="font-family: 'Nunito', sans-serif;font-weight: 800;color:#1C52A0;">Sign In</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>
</body>
</html>
<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
        window.location.replace("https://automata.masuk.id/register.php");
    });
}, 2000);
</script>