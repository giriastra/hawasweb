<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mcrypt extends CI_Model {

  private $iv = 'HAWASAppGTRA2020';
  private $key = 'HawASAPPGTRA2020';

  function __construct(){
  }

  public function encrypt($str) {

    $iv = $this->iv;

    $td = @mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

    @mcrypt_generic_init($td, $this->key, $iv);
    $encrypted = @mcrypt_generic($td, $str);

    @mcrypt_generic_deinit($td);
    @mcrypt_module_close($td);

    return bin2hex($encrypted);

  }

  public function decrypt($str) {

    $code = $this->hex2bin($str);
    $iv = $this->iv;

    $td = @mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

    @mcrypt_generic_init($td, $this->key, $iv);
    $decrypted = mdecrypt_generic($td, $code);

    @mcrypt_generic_deinit($td);
    @mcrypt_module_close($td);

    return utf8_encode(trim($decrypted));

  }

  protected function hex2bin($hexdata) {
    $bindata = '';

    for ($i = 0; $i < strlen($hexdata); $i += 2) {
      $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
    }

    return $bindata;
  }

}
