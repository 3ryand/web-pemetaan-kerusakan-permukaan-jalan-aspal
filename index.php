<?php
ob_start();
//menyertakan file program koneksi.php pada register
require('database.php');
//inisialisasi session
session_start();
$error = '';
$validate = '';

//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if( isset($_SESSION['username']) ) header('Location: home/index.php');

//mengecek apakah form disubmit atau tidak
if( isset($_POST['submit']) ){
        
        // menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($con, $username);
         // menghilangkan backshlases
        $password = stripslashes($_POST['password']);
         //cara sederhana mengamankan dari sql injection
        $password = mysqli_real_escape_string($con, $password);
       
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($username)) && !empty(trim($password))){

            //select data berdasarkan username dari database
            $query      = "SELECT * FROM user_data WHERE username = '$username'";
            $result     = mysqli_query($con, $query);
            $rows       = mysqli_num_rows($result);

            if ($rows != 0) {
                $hash   = mysqli_fetch_assoc($result)['password'];
                if(password_verify($password, $hash)){
                    $_SESSION['username'] = $username;
               
                    header("location: home/index.php");
                }
                else {
                    $error =  'Login Gagal! Silahkan cek password anda.';
                }
            //jika gagal maka akan menampilkan pesan error
            } else {
                $error =  'Login Gagal! Silahkan cek username anda.';
            }
            
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
    } 

?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
 
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;800&display=swap" rel="stylesheet">
<!-- costum css -->
<link rel="stylesheet" href="assets/style2.css">
<title>Masuk Automata</title>
<link rel="icon" type="image/x-icon" href="assets/images/logo_automata_bulat.png">
</head>
<body>
    <div class="upper" style="text-align: center;height: 200px;">
        <div id="inside-upper-text" style="height: 180px;background-color: rgba(94, 129, 244, 0.7);background-image: linear-gradient(0deg, rgba(28,82,160,1) 2%, rgba(24,70,135,1) 50%);url(assets/images/);background-repeat: no-repeat;background-size: cover;padding-bottom: 120px;">
            <h1 style="padding: 120px;font-family: 'Nunito', sans-serif;font-weight: 800;font-size: 34px;color: #fff;">Pemetaan Kerusakan Permukaan Jalan Aspal</h1>
        </div>
        <div id="inside-upper-logo">
            <img src="assets/images/logo_automata_bulat.png"  width=100px style="margin-top: 30px;margin-right: 30px;">
            <img src="assets/images/logopnm.png" width=100px style="margin-top: 30px;">
        </div>
    </div>
    <div style="margin-top:100px;">
        <section class="container-fluid mb-4">
            <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
            <section class="row justify-content-center">
                <section class="col-12 col-sm-6 col-md-4">
                    <form class="form-container" action="index.php" method="POST">
                        <h4 class="text-center font-weight-bold" style="margin-top: 30px;margin-bottom: 10px;font-family: 'Nunito', sans-serif;"> Masuk Pengguna </h4>
                        <?php if($error != ''){ ?>
                            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                        <?php } ?>
                       
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Masukkan Password" style="font-family: 'Nunito', sans-serif;font-weight: 300;color: rgba(255, 255, 255, 1);background-color: rgba(94, 129, 244, 0.8);opacity: 1;"/>
                            <?php if($validate != '') {?>
                                <p class="text-danger"><?= $validate; ?></p>
                            <?php }?>
                        </div>
                     
                        <button type="submit" name="submit" class="btn btn-primary btn-block" style="font-family: 'Nunito', sans-serif;font-weight: 800;margin-top: 20px;background: rgb(28,82,160);">Sign In</button>
                        <div class="form-footer mt-2 row justify-content-between" style="width:97%;margin-left:1%;">
                            <div class="text-right"><a href="lupapw.php" class="text-left" style="font-family: 'Nunito', sans-serif;font-weight: 800;color:#1C52A0;">Lupa Sandi?</a></div>
                                <div>Tidak memiliki akun? <a href="register.php" style="font-family: 'Nunito', sans-serif;font-weight: 800;color:#1C52A0;">Register</a></div>
                        </div>
                    </form>
                </section>
            </section>
            <br>
            <section class="row justify-content-center">
                <section style="margin-right:10px;">
                    <iframe width="448" height="252" src="https://www.youtube-nocookie.com/embed/k5_ORBdBBYw" title="Video Fitur Alat dan Cara Kerja" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </section>
                <section>
                    <iframe width="448" height="252" src="https://www.youtube-nocookie.com/embed/2d1nyMG-WYk" title="Demo Keseluruhan Sistem" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </section>
            </section>
        </section>
    </div>
</body>
</html>