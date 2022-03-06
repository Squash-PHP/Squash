<?
namespace Squash\Squash {
class Squash {
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
}
  $Squash = new Squash;
  //Squash_start();
//class A {
  //public $hello;

  //function __construct() {
  //  $this->hello = new B();
  //}
//}

//class B {
  //public function hello() {
  //  echo 'IT WORKS';
  //}
//}
}
?>