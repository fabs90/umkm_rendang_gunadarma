<?php
class connection
{
    private static $INSTANCE = null;
    private $localhost = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'umkm_rendang';
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->localhost, $this->username, $this->password, $this->database);

        // Jika ada error, tampilkan error
        if (mysqli_connect_error()) {
            die('Failed Connection : ' . mysqli_connect_errno());
        }

    }
    // Menguji koneksi agar tidak double
    public static function getInstance()
    {
        /* Karena kita bikin funct static, jadi kalo mau panggil property harus static juga.
        Kalau belum ada instance, buat instance menjadi inisiasi kelas dbConnect */
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new connection();
        }
        // Jika sudah ada instance databaseConnection, maka return instance yang sudah ada
        return self::$INSTANCE;
    }

    // method insert data
    public function insert($table, $fields = array())
    {
        // Take column name (col1, col2, col3)
        $columns = implode(', ', array_keys($fields));

        // Take values
        $valuesArray = array();
        $i = 0;
        foreach ($fields as $key => $values) {
            // Cek apakah inputan tipe integer atau bukan
            if (is_int($values)) {
                // Kalau bukan, tak usah beri tanda petik
                $valuesArray[$i] = $this->escape($values);
            }

            $valuesArray[$i] = "'" . $this->escape($values) . "'";
            $i++;
        }
        // gabungin jadi format (value1, value2, value3)
        $values = implode(', ', $valuesArray);

        // sintaks query
        $query = "INSERT INTO users ($columns) VALUES ($values)";

        // Lakukan query insert ke db pake method buatan
        return $this->run_query($query, 'Masalah saat memasukan data');

    }

    // Method run query db
    public function run_query($query, $msg = "Terdapat error")
    {
        if ($this->mysqli->query($query)) {
            return true;
        }
        die($msg);
    }
    public function escape($name)
    {
        return $this->mysqli->real_escape_string($name);
    }

    public function get_info($table, $column, $value)
    {
        // Cek tipe data masukan user
        if (!is_int($value)) {
            $value = $this->escape($value);
            $value = "'" . $value . "'";
        }

        $query = "SELECT * FROM $table where $column = $value";
        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            // Handle no results found
            return null;
        }

        // Fetch assoc hasil query
        $row = $result->fetch_assoc();

        return $row;
    }

    public function showAllMenu()
    {
        $query = "SELECT * FROM all_menu ORDER BY menu_id ASC";
        $result = $this->mysqli->query($query);
        return $result;
    }
}
