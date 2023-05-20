<?php
class validation
{
    private $_passed = false;
    private $_errors = [];

    // Buat method validasi
    public function check($data = array())
    {
        // perlu loop 2 kali ygy
        foreach ($data as $item => $rules) {
            foreach ($rules as $rule => $rule_values) {
                // Cek rules & validasi
                switch ($rule) {
                    // Cek apakah inputan kosong
                    case 'required':
                        if (empty(input::getValue($item))) {
                            $this->addError("$item wajib diisi");
                        }
                        break;
                    case 'min':
                        // Cek apakah inputan kurang dari validasi yg ditentukan
                        if (strlen(input::getValue($item)) < $rule_values) {
                            $this->addError("panjang minimal $item adalah $rule_values");
                        }

                        break;
                    case 'max':
                        // Cek apakah inputan kurang dari validasi yg ditentukan
                        if (strlen(input::getValue($item)) > $rule_values) {
                            $this->addError("panjang maksimal $item adalah $rule_values");
                        }

                        break;
                    default:
                        break;
                }
            }
        }

        // Kalo gaada error
        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error)
    {
        // tambahin pesan error kedalam array _errors
        $this->_errors[] = $error;
    }

    public function error()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }

}
