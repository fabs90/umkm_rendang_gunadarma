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
                $nama_gambar = $_FILES['gambar']['name'];
                $valuesArray[$i] = $nama_gambar;
            }

            // Cek apakah inputan tipe integer atau bukan
            if (is_int($value)) {
                // Kalau integer, tidak perlu beri tanda petik
                $valuesArray[$i] = $escapedValue;
            }
            // Kalau string kasih petik
            $valuesArray[$i] = "'" . $escapedValue . "'";

            $i++;
        }

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

        if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
            if ($ukuran < 2000 * 2000) {
                // Pindahkan file yang diupload ke direktori tujuan
                $tujuan = 'c:/xampp/htdocs/Project/admin_interface_umkm/images/' . $nama_gambar;
                move_uploaded_file($file_tmp, $tujuan);

                // Gabungkan nilai dalam format (value1, value2, value3)
                $values = implode(', ', $valuesArray);

                // Buat query
                $query = "INSERT INTO all_menu ($columns) VALUES ($values)";

                if ($db->Performquery($query)) {
                    session::flash('store', 'Data berhasil dimasukan');
                    return true;
                } else {
                    return false;
                }
            }
            session::flash('error_size', 'Ukuran terlalu besar, maksimum 4mb');
        }
        session::flash('error_ekstensi', 'Hanya boleh PNG,JPG,JPEG');
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

}
