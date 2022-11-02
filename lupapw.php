<?php
ob_start();
//menyertakan file program koneksi.php pada register
require('database.php');
$error = '';
$validate = '';
//mengecek apakah data username yang diinpukan user kosong atau tidak
if( isset($_POST['submit']) ){
        $email    = stripslashes($_POST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($email))){
            //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
            //if($password == $repass){
                //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
                //echo (cek_nama($email, $con));
                if( cek_nama($email, $con) != 0 ){
                    $query  = "SELECT * FROM user_data WHERE email = '$email'";
                    $result     = mysqli_query($con, $query);
                    $rows       = mysqli_num_rows($result);
                    $data  = mysqli_fetch_array($result);
                    $username = $data['username'];
                    //hashing password sebelum disimpan didatabase
                    //$pass  = password_hash($password, PASSWORD_DEFAULT);
                    //insert data ke database
                    $to = $email;
    				$from = "admin@automata.masuk.id";
    				$subject ="Informasi Login Automata";
    				$pesan ='Anda telah melakukan permintaan lupa password \n Berikut ini adalah informasi login baru Anda \n======================= \n Email ='.$email.'\n Username ='.$username.'\n Password='.$password.'\n =======================';
    				$headers = $from;
    				$kirimEmail = mail($to, $subject, $pesan, $headers);
                    // cek status pengiriman email
                    if ($kirimEmail) {
                        // update password baru ke database (jika pengiriman email sukses)
                        $newPasswordEnkrip  = password_hash($password, PASSWORD_DEFAULT);
                        $query2 = "UPDATE user_data SET password = '$newPasswordEnkrip' WHERE username = '$username'";
                        $hasil = mysqli_query($con, $query2);
                    	
                        if ($hasil) $sukses = "Password telah berhasil diganti";
                        }else $error = "Pengiriman password baru ke email gagal";
                    //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
                    //if ($result) {
                        //$error =  'Silahkan cek email anda untuk informasi username dan kata sandi.';
                        //header("Location: https://automata.masuk.id");
                    //jika gagal maka akan menampilkan pesan error
                    }else {
                        $error =  'Email tidak terdaftar !!';
                    }
            //}else{
             //   $validate = 'Password tidak sama !!';
            //}
        }else {
            $error =  'Email tidak boleh kosong !!';
        }
    }

    //fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_nama($email,$con){
        $query      = "SELECT * FROM user_data WHERE email = '$email'";
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
    <title>Lupa Sandi</title>
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
                <form class="form-container" action="lupapw.php" method="POST">
                    <?php if($error != ''){ 
                            echo"<div class='alert alert-danger' style='margin-top:10px;' role='alert'>$error</div>";
                        }
                        if($sukses != ''){
                            echo"<div class='alert alert-success' style='margin-top:10px;' role='alert'><strong>Berhasil!</strong>$sukses</div>";
                        }?>
                    <h4 class="text-center font-weight-bold" style="margin-top: 30px;margin-bottom: 10px;font-family: 'Nunito', sans-serif;"> Lupa Sandi Pengguna </h4>
                    <div class="form-group">
                        <input type="email" class="form-control" id="InputEmail" name="email"
                            aria-describeby="emailHelp" placeholder="Masukkan Email" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="InputPassword" name="password"
                            placeholder="Masukkan Password Baru" style="font-family: 'Nunito', sans-serif;font-weight: 300;background-color: rgba(94, 129, 244, 0.8);color: rgba(255, 255, 255, 1);">
                        <?php if($validate != '') {?>
                        <p class="text-danger"><?= $validate; ?></p>
                        <?php }?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block" style="font-family: 'Nunito', sans-serif;font-weight: 800;margin-top: 20px;background: rgb(28,82,160);">Submit</button>
                    <div class="form-footer mt-2 text-right">
                        <p><a href="https://automata.masuk.id/" style="font-family: 'Nunito', sans-serif;font-weight: 800;color:#1C52A0;">Kembali</a></p>
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