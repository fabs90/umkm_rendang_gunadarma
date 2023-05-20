    <?php
class session
{

    public static function exist($name)
    {
        if (isset($_SESSION[$name])) {
            return true;
        } else {
            return false;
        }

    }

    public static function set($nama, $nilai)
    {
        return $_SESSION[$nama] = $nilai;
    }

    public static function get($nama)
    {
        return $_SESSION[$nama];
    }

    // Menampilkan pesan flash 1 kali saja
    public static function flash($nama, $pesan = '')
    {
        // kalo session nama udah ada
        if (self::exist($nama)) {
            // Taro isi session di variabel $session
            $session = self::get($nama);
            // Hapus session web nya, karena kita cuma pengen nampilin sekali
            self::delete($nama);
            return $session;
        } else {
            self::set($nama, $pesan);
        }
    }

    public static function delete($nama)
    {
        // Kalau ada session
        if (self::exist($nama)) {
            // Hapus session nya
            unset($_SESSION[$nama]);
        }
    }

    public static function phpAlert($msg)
    {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
}