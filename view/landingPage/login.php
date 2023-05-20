<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";
$db = new connection();

// Pengganti if(isset($_POST['btn_login]))
if (input::getValue('submit_btn')) {
    $user = new User();
    $validation = new validation();
    // validasi dulu datanya, sesuai dengan ketentuan tidak
    $validation = $validation->check([
        'username' => ['required' => true],
        'password' => ['required' => true],
    ]);

    // Kalo sesuai langsung register data tersebut ke DB
    if ($validation->passed()) {

        // Cek nama dari database dulu, kalo ada datanya
        if ($user->cek_nama(input::getValue('username'))) {

            /* Kalo username ada di datbase, baru nama & password dibandingin sama data yang ada di database */
            if ($user->login_user(input::getValue('username'), input::getValue('password'))) {
                session::set('username', input::getValue('username'));
                header('Location:../admin/sidebar.php');
            } else {
                $errors[] = "Gagal login";
            }
        }
        $errors[] = "Username/Password tidak valid";

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
    <title>Sign in Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="login.php" class="sign-in-form" method="POST">
                    <h2 class="title">Login terlebih dahulu</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" />
                    </div>
                    <?php if (!empty($errors)) {?>
                    <div class="errors">
                        <p>Terdapat Error :</p>
                        <?php foreach ($errors as $error): ?>
                        <h5 class="error-message" style="color:red;"><?=$error?></h5>
                        <?php endforeach?>
                    </div>
                    <?php }?>
                    <button type="submit" class="btn-solid" name="submit_btn" value="masuk">Masuk</button>


                    <p class="social-text">atau masuk melewati platform kita</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
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
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>SELAMAT DATANG </h3>
                    <p>Silahkan login jika ingin ke halaman admin.</p>
                </div>
                <div class='image'></div>
            </div>

</body>
<script src="../../public/landingPage/formLogin.js"></script>

</html>