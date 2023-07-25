<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";
$db = new connection();

// Pengganti if(isset($_POST['btn_login]))
if (input::getValue('submit_btn') && Token::checkToken(input::getValue('token'))) {
    $user = new User();
    $validation = new validation();
    // validasi dulu datanya, sesuai dengan ketentuan tidak
    $validation = $validation->check([
        'username' => ['required' => true],
        'password' => ['required' => true],
    ]);

    // Kalo sesuai langsung cek data tersebut ke DB
    if ($validation->passed()) {

        // Cek nama dari database dulu, kalo ada datanya
        if ($user->cek_nama(input::getValue('username'))) {

            /* Kalo username ada di datbase, baru nama & password dibandingin sama data yang ada di database */
            if ($user->login_user(input::getValue('username'), input::getValue('password'))) {

                session::set('username', input::getValue('username'));
                // header('Location:../admin/sidebar.php');
                Redirect::to('../admin/table');
            } else {
                $errors[] = "Gagal login";
            }
        } else {
            $errors[] = "Cek ulang username dan password";
        }

    } else {
        $errors = $validation->error();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/landingPage/formLogin.css" />
    <link rel="stylesheet" href="../../public/sweetalert/sweetalert2.min.css">

    <title>Sign in Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?=$_SERVER['PHP_SELF']?>" class="sign-in-form" method="POST">
                    <h2 class=" title">Login terlebih dahulu</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required />
                    </div>
                    <?php if (!empty($errors)): ?>
                    <div class="errors">
                        <p>Terdapat Error :</p>
                        <?php foreach ($errors as $error): ?>
                        <h5 class="error-message" style="color:red;"><?=$error?></h5>
                        <?php endforeach?>
                    </div>
                    <?php endif?>
                    <!-- Token for Anti-csrf -->
                    <input type="hidden" name="token" value="<?=Token::generate();?>">


                    <button type="submit" class="btn-solid" name="submit_btn" value="masuk">Masuk</button>

                    <!--
                    <p class="social-text">atau masuk melewati platform kita</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> -->
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>SELAMAT DATANG </h3>
                    <p>Silahkan login jika ingin ke halaman admin.</p>
                    <a href="landing.php">Kembali ke halaman utama</a>
                </div>
                <div class='image'></div>
            </div>

</body>
<script src="../../public/landingPage/formLogin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../public/sweetalert/sweetalert2.min.js"></script>

</html>
<!-- Cek apakah ada session dgn nama login_dulu -->
<?php if (session::exist('login_dulu')): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Silakan login lebih dahulu😊',
})
</script>
<?php
// sesudah jalankan sweetalert, hapus session
session::delete('login_dulu');
endif?>