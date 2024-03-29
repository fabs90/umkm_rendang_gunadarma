<?php

class Menu
{

    private $_db;

    public function __construct()
    {
        $this->_db = connection::getInstance();
    }
    public function index()
    {
        $db = new connection();
        $query = "SELECT * FROM all_menu ORDER BY menu_id ASC";
        $result = $db->performQuery($query);
        return $result;
    }

    public function show($id)
    {
        $db = new connection();
        $query = "SELECT * FROM all_menu WHERE menu_id = $id ORDER BY menu_id ASC";
        $result = $db->performQuery($query);

        return $result;
    }

    public function store($fields = [])
    {

        $db = new connection();

        // Take column name (col1, col2, col3)
        $columns = implode(', ', array_keys($fields));

        // Take values
        $valuesArray = array();
        $i = 0;
        // Melakukan loop terhadap kolom value, kalo key nya tuh kek nama,bahan,deskripsi...
        foreach ($fields as $key => $value) {
            // lakukan escape string utk mencegah sql injection
            $escapedValue = $db->escape($value);

            // Cek jika key adalah gambar dan value adalah gambar
            if ($key == "gambar") {
                //  Ambil nama gambar
                $nama_gambar = $_FILES['gambar']['name'];
                // Get file extension
                $ext = pathinfo($nama_gambar, PATHINFO_EXTENSION);
                $uniqueId = uniqid();
                // Combine unique id, file extension, and original file name
                $newFileName = $uniqueId . $nama_gambar;
                $valuesArray[$key] = $newFileName;
            }

            // Cek apakah inputan tipe integer atau bukan
            if (is_numeric($value)) {
                // Kalau integer, tidak perlu beri tanda petik
                $valuesArray[$key] = $escapedValue;
            } else {
                // Kalau string kasih petik
                $valuesArray[$key] = "'" . $escapedValue . "'";

            }
            $i++;
        }

        // Buat array yg extensi nya diperbolehkan
        $ekstensi_diperbolehkan = ['png', 'jpg', 'jpeg'];
        // Cek ekstensi dgn cara explode
        $x = explode('.', $newFileName);
        // kecilin semuaa huruf sesudah '.(titik), dan ambil extensi nya'
        $ekstensi = strtolower(end($x));
        // Ambil size file yg di upload
        $ukuran = $_FILES['gambar']['size'];
        // Mendapatkan temporary file yg tersimpan di direktori sementara server
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
            if ($ukuran < 2000 * 2000) {
                // Pindahkan file yang diupload ke direktori tujuan
                $tujuan = 'c:/xampp/htdocs/Project/admin_interface_umkm/images/' . $newFileName;
                move_uploaded_file($file_tmp, $tujuan);

                // Update nama gambar dengan $newFileName yang berisi nama file yang unik
                $valuesArray['gambar'] = '"' . $newFileName . '"';

                // Gabungkan nilai dalam format (value1, value2, value3)
                $values = implode(', ', $valuesArray);

                // Buat query
                $query = "INSERT INTO all_menu ($columns) VALUES ($values)";

                if ($db->Performquery($query)) {
                    session::flash('store', 'Data berhasil dimasukan');
                    return true;
                } else {
                    session::flash('store', 'Data gagal dimasukan');
                    return false;
                }
            }
            session::flash('error_size', 'Ukuran terlalu besar, maksimum 4mb');
        }
        session::flash('error_ekstensi', 'Hanya boleh PNG,JPG,JPEG');
        return false;
    }

    public function edit($id)
    {
        $db = new connection();
        $query = "SELECT * FROM all_menu WHERE menu_id = $id";
        $result = $db->performQuery($query);
        return $result;
    }

    public function update($id, $fields = [])
    {
        $db = new connection();

        // Take column name (col1, col2, col3)
        $columns = implode(', ', array_keys($fields));

        // Take values
        $valuesArray = array();
        $i = 0;

        // Melakukan loop terhadap kolom value, kalo key nya tuh kek nama,bahan,deskripsi...
        foreach ($fields as $key => $value) {
            // lakukan escape string utk mencegah sql injection
            $escapedValue = $db->escape($value);

            // Cek jika key adalah gambar dan value adalah gambar
            if ($key == "gambar") {
                $nama_gambar = $_FILES['gambar']['name'];
                $valuesArray[$i] = $nama_gambar;
            }

            // Cek apakah inputan tipe integer atau bukan
            if (is_numeric($value)) {
                // Kalau integer, tidak perlu beri tanda petik
                $valuesArray[$i] = $escapedValue;
            } else {
                // Kalau string kasih petik
                $valuesArray[$i] = "'" . $escapedValue . "'";

            }

            $i++;
        }
        // Dapetin nilai satuan valuesArray
        $nama_produk = $valuesArray[0];
        $deskripsi_produk = $valuesArray[1];
        $harga_produk = $valuesArray[2];
        $bahan_produk = $valuesArray[3];
        $diskon_produk = $valuesArray[5];

        // Buat array yg extensi nya diperbolehkan
        $ekstensi_diperbolehkan = ['png', 'jpg', 'jpeg'];
        // Cek ekstensi dgn cara explode
        $x = explode('.', $nama_gambar);
        // kecilin semuaa huruf sesudah '.(titik), dan ambil extensi nya'
        $ekstensi = strtolower(end($x));
        // Ambil size file yg di upload
        $ukuran = $_FILES['gambar']['size'];
        // Mendapatkan temporary file yg tersimpan di direktori sementara server
        $file_tmp = $_FILES['gambar']['tmp_name'];

        // Gabungkan nilai dalam format (value1, value2, value3)
        $values = implode(', ', $valuesArray);

        // Jika diskon yang diinput > 0
        if ($diskon_produk != 0) {
            $harga_diskon = $this->hitungDiskon($harga_produk, $diskon_produk);

            // Kalau yang diinput kosong / 0
        } else {
            $harga_diskon = 0;
        }

        // Buat query update nama, deskripsi, bahan, harga
        $query = "UPDATE all_menu SET nama = $nama_produk, deskripsi = $deskripsi_produk, harga = $harga_produk, harga_diskon = $harga_diskon, bahan = $bahan_produk WHERE menu_id = $id";

        if ($db->Performquery($query)) {
            //  Cek apakah user input gambar
            if ($_FILES['gambar']['name'] != null) {
                // Update gambar saja
                if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
                    // Kalau ukuran dibawah 4mb
                    if ($ukuran < 2000 * 2000) {

                        // Pindahkan soft copy gambar baru yang diupload ke direktori tujuan
                        $tujuan = 'c:/xampp/htdocs/Project/admin_interface_umkm/images/' . $nama_gambar;
                        move_uploaded_file($file_tmp, $tujuan);

                        // Query gambar lama
                        $queryGambar = "SELECT gambar FROM all_menu where menu_id = '$id'";
                        if ($result1 = $db->performQuery($queryGambar)) {

                            $row1 = $result1->fetch_assoc();

                            // Ambil data gambar lama dr database
                            $image = $row1['gambar'];

                            // Hapus soft copy gambar lama
                            $dir = 'c:/xampp/htdocs/Project/admin_interface_umkm/images/' . $image;
                            unlink($dir);
                        } else {
                            session::flash('store', 'Data gagal diproses');
                            return false;
                        }

                        // Update nama gambar baru di database
                        $queryUpdateGambar = "UPDATE all_menu SET gambar = '$nama_gambar' WHERE menu_id = '$id'";
                        if ($db->Performquery($queryUpdateGambar)) {
                            session::flash('store', 'Data berhasil diupdate');
                            Redirect::to('table');
                            return true;
                        }
                        return false;

                    } else {
                        session::flash('error_size', 'Ukuran terlalu besar, maksimum 4mb');
                        return false;
                    }

                } else {
                    session::flash('error_ekstensi', 'Hanya bisa PNG, JPG, JPEG');
                    return false;
                }
            }
            session::flash('store', 'Data berhasil diupdate');
            return true;

        } else {
            Redirect::to('update');
            return false;
        }

    }

    public function destroy($id)
    {
        $db = new connection();
        // Lakukan query pertama utk mengambil data gambar
        $query1 = ("SELECT gambar FROM all_menu where menu_id = '$id'");
        $result1 = $db->performQuery($query1);
        $row1 = $result1->fetch_assoc();

        $image = $row1['gambar'];
        // Hapus data gambar berdasarkan nama dari direktori images
        $dir = 'c:/xampp/htdocs/Project/admin_interface_umkm/images/' . $image;
        $hapus = unlink($dir);

        // Lakukan query hapus data dari database
        $query2 = "DELETE FROM all_menu WHERE menu_id = $id";
        if ($db->Performquery($query2) && $hapus) {
            session::set('hapus', 'Data berhasil terhapus!');
            Redirect::to('table');
            return true;
        }
        session::flash('gagal_hapus', 'Data gagal terhapus!');
        Redirect::to('table');
        return false;
    }

    public function cekMenu($nama_menu)
    {
        $data = $this->_db->get_info('all_menu', 'nama', $nama_menu);
        if (empty($data)) {
            return true;
        }
        return false;
    }

    public function hitungDiskon($harga, $diskon)
    {
        $nilaiDiskon = $harga * ($diskon / 100);
        $hargaSetelahDiskon = $harga - $nilaiDiskon;
        return intval($hargaSetelahDiskon);
    }
}
