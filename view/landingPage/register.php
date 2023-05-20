<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";
$db = new connection();
// Pengganti if(isset($_POST['btn_login]))
if (input::getValue('submit_btn')) {
    $user = new User();
    $validation = new validation();
    // validasi dulu datanya, sesuai dengan ketentuan tidak
    $validation = $validation->check([
        'username' => ['required' => true, 'max' => 50, 'min' => 3],
        'password' => ['required' => true, 'max' => 30, 'min' => 5],
    ]);

    /* Mencegah username sama saat register */
    // Kalau ada data dengan username yg sama di database
    if ($user->cek_nama(input::getValue('username'))) {
        $errors[] = "Username sudah terdaftar, coba username lain";

    } else {

        // Kalo sesuai langsung register data tersebut ke DB
        if ($validation->passed()) {

            /* Registering a new user by calling the `register_user` method of the `user` object and passing an
            array of user data as an argument. The user data includes the username and a hashed password. */
            $user->register_user(array(
                'username' => input::getValue('username'),
                'password' => password_hash(input::getValue('password'), PASSWORD_ARGON2ID),
            ));

            session::set('username', input::getValue('username'));
            header('Location:../admin/sidebar.php');
        } else {
            $errors = $validation->error();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register Form</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
    }

    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .container h2 {
        text-align: center;
    }

    .container .form-group {
        margin-bottom: 15px;
    }

    .container .form-group label {
        display: block;
        font-weight: bold;
    }

    .container .form-group input {
        width: 100%;
        padding: 5px;
        font-size: 16px;
        border-radius: 3px;
        border: 1px solid #ccc;
    }

    .container .form-group input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
    }

    .container .form-group input[type="submit"]:hover {
        background-color: #45a049;
    }

    .container .form-group .error-message {
        color: red;
        margin-top: 5px;
    }


    .container .form-group .error-message {
        color: red;
        margin-top: 5px;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register Form</h2>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <!-- <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div> -->
            <!-- show errors -->
            <div class="form-group">
                <?php if (!empty($errors)) {?>
                <div class="errors">
                    <p>Terdapat Error :</p>

                    <?php foreach ($errors as $error): ?>
                    <div class="error-message"><?=$error?></div>
                    <?php endforeach?>
                </div>

                <?php }?>
            </div>
            <div class="form-group">
                <input type="submit" value="Register" name="submit_btn">
            </div>
        </form>
    </div>
</body>

</html>