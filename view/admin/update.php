<?php
require_once "c:/xampp/htdocs/Project/admin_interface_umkm/core/init.php";

if (!session::exist('username')) {
    // Sebelum redirect kasih flash message
    session::flash('login', 'Anda harus login!');
    Redirect::to('../LandingPage/login');

}

if (!input::getValue('id')) {
    session::flash('gagal_hapus', 'Maaf tidak valid');
    Redirect::to('table');
}

$id = input::getValue('id');

if (input::getValue('simpan')) {
    $id = input::getValue('id');
    $menu = new Menu();

    if ($menu->update($id, [
        'nama' => input::getValue('nama'),
        'deskripsi' => input::getValue('deskripsi'),
        'harga' => intval(input::getValue('harga')),
        'bahan' => input::getValue('bahan'),
        'gambar' => $_FILES['gambar']['name'],
        'diskon' => intval(input::getValue('diskon')),
    ])) {
        if (session::exist('store')) {
            session::phpAlert(session::flash('store'));
        }
        $success[] = "Data berhasil di-update!";
    }
}

$menu = new Menu();

if (session::exist('error_ekstensi')) {
    session::phpAlert(session::flash('error_ekstensi'));
}
if (session::exist('error_size')) {
    session::phpAlert(session::flash('error_size'));
}

if (session::exist('store')) {
    session::phpAlert(session::flash('store'));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Menu</title>
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
                            <h1 class="card-text text-center fw-bold p-4">Update Menu</h1>
                            <h6 class="card-subtitle mb-2 text-muted text-center">
                                <a href="table.php">Kembali ke halaman admin</a>
                            </h6>
                            <div class="form-group mx-5 d-flex flex-column justify-content-center">
                                <form action="update.php?id=<?=$id?>" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">
                                    <?php
$result = $menu->edit($id);
foreach ($result as $row):
?>
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
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="<?=$row['nama']?>" name="nama"
                                            required />
                                    </div>
                                    <div class="my-3">
                                        <label for="bahan" class="form-label">Bahan:</label>
                                        <textarea id="bahan" name="bahan" class="form-control"
                                            required><?=$row['bahan']?></textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="deskripsi" class="form-label">Deskripsi:</label>
                                        <textarea id="deskripsi" name="deskripsi" class="form-control"
                                            required><?=$row['deskripsi']?></textarea>
                                    </div>
                                    <div class="my-3">
                                        <label for="harga" class="form-label">Harga:</label>
                                        <input class="form-control" type="number" min="1" step="any"
                                            placeholder="Masukan harga" name="harga" id="harga"
                                            value="<?=$row['harga']?>" required />
                                    </div>
                                    <div class="my-3">
                                        <label for="diskon" class="form-label">Diskon:</label>
                                        <input class="form-control" type="text"
                                            placeholder="Masukan diskon (otomatis dikonversi menjadi %)" name="diskon"
                                            id="diskon" />
                                    </div>
                                    <div class="my-3">
                                        <label for="gambar" class="form-label">Gambar:</label>
                                        <img src="<?="../../images/" . $row['gambar'];?>" width="200px" />
                                        <br />
                                        <input type="file" id="gambar" name="gambar" class="form-control mt-3" />
                                    </div>
                                    <?php endforeach?>
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