<?
class Squash {
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
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
}
?>
