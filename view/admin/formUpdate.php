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
        'harga' => input::getValue('harga'),
        'bahan' => input::getValue('bahan'),
        'gambar' => $_FILES['gambar']['name'],
    ])) {
        return true;
    }

}

$menu = new Menu();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Menu</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    padding: 20px;
}

h1 {
    text-align: center;
}

a {
    display: flex;
    justify-content: center;
}

form {
    width: 400px;
    margin: 0 auto;
    border: solid #000 1px;
    padding: 2% 5%
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 5px;
    margin-bottom: 10px;
}

input[type="file"] {
    margin-bottom: 10px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>

<body>
    <h1>Edit Menu</h1>
    <a href="sidebar.php">Kembali</a>
    <form action="formUpdate.php?id=<?=$id?>" method="POST" enctype="multipart/form-data" autocomplete="off">
        <?php
$result = $menu->edit($id);
foreach ($result as $row):
?>
        <label for="nama">Nama Menu:</label>
        <input type="text" name="nama" id="" value='<?=$row['nama']?>'>
        <br>

        <label for="bahan">Bahan:</label>
        <textarea id="bahan" name="bahan" required><?=$row['bahan']?></textarea><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" required><?=$row['deskripsi']?></textarea><br>

        <label for="harga">Harga :</label>
        <input type="number" min="1" step="any" placeholder="Masukan harga" name="harga" id="harga"
            value="<?=$row['harga']?>" required />

        <label for="gambar">Gambar:</label>
        <img src="<?php echo "../../images/" . $row['gambar']; ?>" width="200px">
        <input type="file" id="gambar" name="gambar"><br>

        <?php endforeach?>
        <input type="submit" value="simpan" name="simpan">
    </form>
</body>

</html>