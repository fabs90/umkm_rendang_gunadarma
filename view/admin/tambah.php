<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";

// Cek, kalau variabel session username blom di set maka balik ke form login
if (!session::exist('username')) {
    // Sebelum redirect kasih flash message
    session::flash('login', 'Anda harus login!');
    Redirect::to('../LandingPage/login');

}

if (input::getValue('simpan')) {
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
            $success[] = "Data berhasil dimasukan!";
        } else {
            $errors[] = "Ekstensi hanya boleh [PNG,JPG,JPEG] & Ukuran maksimum 4 MB";
        }
    } else {
        $errors[] = "Menu dengan nama yang sama sudah ada";
    }

    // if (session::exist('error_ekstensi')) {
    //     session::phpAlert(session::flash('error_ekstensi'));
    // }
    // if (session::exist('error_size')) {
    //     session::phpAlert(session::flash('error_size'));
    // }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../public/admin/cottoncandy.css">
</head>

<body>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card shadow mx-auto">
                        <div class="card-body p-4">
                            <h1 class="card-text text-center fw-bold p-4">Tambah Menu</h1>
                            <h6 class="card-subtitle mb-2 text-muted text-center">
                                <a href="table.php">Kembali ke halaman admin</a>
                            </h6>
                            <div class="form-group mx-5 d-flex flex-column justify-content-center">
                                <form action="tambah.php" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">
                                    <?php if (!empty($errors)) {?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php foreach ($errors as $error): ?>
                                        <p><strong><?=$error?></strong></p>
                                        <?php endforeach?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php }?>
                                    <?php if (!empty($success)) {?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php foreach ($success as $true): ?>
                                        <p><strong><?=$true?></strong></p>
                                        <?php endforeach?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php }?>
                                    <div class="my-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Menu</label>
                                        <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" required />
                                    </div>
                                    <div class="my-3">
                                        <label for="bahan" class="form-label">Bahan:</label>
                                        <textarea id="bahan" name="bahan" class="form-control" required></textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="deskripsi" class="form-label">Deskripsi:</label>
                                        <textarea id="deskripsi" name="deskripsi" class="form-control"
                                            required></textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="harga" class="form-label">Harga:</label>
                                        <input class="form-control" type="number" min="1" step="any"
                                            placeholder="Masukan harga" name="harga" id="harga" required />
                                    </div>

                                    <div class="my-3">
                                        <label for="gambar" class="form-label">Gambar:</label>
                                        <br />
                                        <input type="file" id="gambar" name="gambar" class="form-control" required />
                                    </div>
                                    <div class=" buttonDiv my-3">
                                        <input type="submit" value="simpan" name="simpan" class="btn-grad" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>