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
}