<?php
class Squash {
  public function __construct() {
  $this->convert_byte = new SquashConversionsByte;
$this->convert_bibyte = new SquashConversionsBiByte;
$this->number = new SquashNumber;
  }
  function update_file($dir, $filename, $source) {
    $fileList = glob($dir.'/*');
    if (in_array($dir.'/'.$filename, $fileList)) {
      if (file_get_contents($filename) == file_get_contents($source)){
      // do nothing
    } else {
      $myfile = fopen($filename, "w") or die("Unable to open file!");
$txt = file_get_contents($source);
fwrite($myfile, $txt);
fclose($myfile);
    }
    } else {
      $myfile = fopen($filename, "w") or die("Unable to open file!");
$txt = file_get_contents($source);
fwrite($myfile, $txt);
fclose($myfile);
    }
  }
  function generateRandomString($length = 25) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  function get_json($url) {
    return json_decode(file_get_contents($url));
  }
  function sleepms(int $ms) {
    $micro = $ms * 1000;
    return usleep($micro);
  }
  function files_in_dir($dir, $newline) {
    $fileList = glob($dir.'/*');
    if ($newline == true) {
      $seperator = "\n";
    } else {
      $seperator = "";
    }
    foreach($fileList as $filename){
      $return .= $filename.$seperator;
    }
    return $return;
  }
  function file_in_dir($filename, $dir) {
    $fileList = glob($dir.'/*');
    if (in_array($dir.'/'.$filename, $fileList)) {
      return true;
    } else {
      return false;
    }
  }
  function uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }
}
?>
