<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";

// Cek, kalau variabel session username blom di set maka balik ke form login
if (!session::exist('username')) {
    // Sebelum redirect kasih flash message
    session::flash('login', 'Anda harus login!');
    Redirect::to('../LandingPage/login');

}

if (session::exist('register')) {
    session::phpAlert(session::flash('register'));
}

// Menampilkan pesan yg ada pada session['login']
if (session::exist('login')) {
    session::phpAlert(session::flash('login'));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">


    <!-- BS Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- css -->
    <link rel="stylesheet" href="../../public/sidebar.css">
    <title>Admin</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="header">
                <div class="list-item">
                    <a href="#">
                        <i class="bi bi-pc-display-horizontal icon"></i>
                        <span class="description-header">Admin Panel</span>
                    </a>
                </div>
                <div class="illustration">
                    <img src="../../assets/illustration.png" id="illustration-img" alt=""
                        style="width:154px; height:130px;">
                </div>
            </div>
            <div class="main">
                <div class="list-item">
                    <a href="#">
                        <i class="bi bi-speedometer icon"></i>
                        <span class="description-header">Dashboard</span>
                    </a>
                </div>
                <hr>
                <div class="judul-category">
                    <h5>Category</h5>
                </div>
                <div class=" list-item">
                    <a href="#">
                        <i class="bi bi-card-list icon"></i>
                        <span class="description-header">List Menu</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <i class="bi bi-plus-square icon"></i>
                        <span class="description-header">Tambah Menu</span>
                    </a>
                </div>
            </div>
            <hr>
            <div class="judul-category">
                <h5>Other</h5>
            </div>
            <div class="footer">
                <div class="list-item">
                    <a href="logout.php">
                        <i class="bi bi-box-arrow-right icon"></i>
                        <span class="description-header">Signout</span>
                    </a>
                </div>
                <div class="list-item">
                    <div id="menu-button">
                        <input type="checkbox" name="" id="menu-checkbox">
                        <label for="menu-checkbox" id="menu-label">
                            <div id="hamburger"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- main-content -->
        <div class="main-content">
            <div class="main-header">
                <h1>Admin Page</h1>
                <h3>Welcome,
                    <?php echo session::get('username'); ?>
                </h3>
            </div>
            <div class="table">
                <!-- Table -->
                <table border="1">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Gambar</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Rendang A</td>
                            <td>rendang1</td>
                            <td>Ubah | Hapus</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Rendang B</td>
                            <td>rendang2</td>
                            <td>Ubah | Hapus</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Rendang C</td>
                            <td>rendang3</td>
                            <td>Ubah | Hapus</td>
                        </tr>
                    </tbody>
                </table>
                <!-- End of table -->
            </div>
            <hr>
        </div>
    </div>
</body>
<script src="../../public/script.js"></script>


</html>