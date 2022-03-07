<?
$dir = __DIR__;
$files = array(
  "src/squash.php",
);
$class = "Squash";
$class_var = "\$Squash";
// -------------
// END OF CONFIG
// -------------
echo "Welcome to FLAA version 0.0.5\n";
usleep(1000000);
echo "Starting mounting...\n\n";
foreach($files as $file) {
  $fileList = glob($dir.'/*');
  if (! in_array($dir.'/'.$file, $fileList)) {
    echo "\e[0;31mERROR: $file does not exist in $dir!";
    $error = true;
  } else {
    echo "Now mounting $file...\n";
  echo "███";
echo "███";
echo "███";
echo "███";
echo "███";
  include $dir.'/'.$file;
echo "███";
echo "███";
echo "███";
echo "███";
  echo "\nMounted $file!\n\n";
  }
}
if ($error) {
  //
} else {
  function startclass() {
    return "$class_var = new $class;";
  }
  startclass();
  echo "Loading complete!\n\n\n";
}
?>
