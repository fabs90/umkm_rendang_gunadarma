<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";

// Cek, kalau variabel session username blom di set maka balik ke form login
if (!session::exist('username')) {
    // Sebelum redirect kasih flash message
    session::flash('login', 'Anda harus login!');
    Redirect::to('../LandingPage/login');

}

if (input::getValue('upload')) {
    $menu = new Menu();

    // cek apakah ada menu dengan nama yg sama
    if ($menu->cekMenu(input::getValue('nama'))) {
        if ($menu->store([
            'nama' => input::getValue('nama'),
            'deskripsi' => input::getValue('deskripsi'),
            'harga' => input::getValue('harga'),
            'bahan' => input::getValue('bahan'),
            'gambar' => $_FILES['gambar']['name'],
        ])) {
            if (session::exist('store')) {
                session::phpAlert(session::flash('store'));
            }
        } else {
            $errors[] = "Ekstensi hanya boleh [PNG,JPG,JPEG] & Ukuran maksimum 4 MB";
        }
    } else {
        $errors[] = "Menu dengan nama yang sama sudah ada";
    }

    if (session::exist('error_ekstensi')) {
        session::phpAlert(session::flash('error_ekstensi'));
    }
    if (session::exist('error_size')) {
        session::phpAlert(session::flash('error_size'));
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="../../public/formTambah.css" />
</head>

<body>
    <div class="container">
        <div class="card-container">
            <div class="left">
                <div class="left-container">
                    <h2>Tentang Form</h2>
                    <p>Ini merupakan bagian form penambah menu</p>
                    <br />
                    <a href="sidebar.php">Kembali ke laman admin</a>
                </div>
            </div>
            <div class="right">
                <div class="right-container">
                    <form action="formTambah.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <h2 class="lg-view">Menu yang ditambahkan</h2>
                        <h2 class="sm-view">Menu yang ditambahkan</h2>
                        <?php if (!empty($errors)) {?>
                        <div class="errors">
                            <p>Terdapat Error :</p>
                            <?php foreach ($errors as $error): ?>
                            <h5 class="error-message" style="color:red;"><?=$error?></h5>
                            <?php endforeach?>
                        </div>
                        <?php }?>
                        <input type="text" placeholder="Nama Menu" name="nama" required />
                        <input type="text" placeholder="Tulis deskripsi" name="deskripsi" required />
                        <input type="number" min="1" step="any" placeholder="Masukan harga" name="harga" required />
                        <textarea id="bahan" name="bahan" required>Masukan bahan...</textarea>
                        <input id="input" type="file" name="gambar" required />
                        <input type="submit" value="upload" name="upload" class="button">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>