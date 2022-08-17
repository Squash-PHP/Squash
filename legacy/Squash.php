<?php
$version = "0.0.4";
$response = json_decode(file_get_contents("https://api.squash.ml/checkver.php?current=$version"));
if ($response->upgrade == "not needed") {
unset($response);
unset($version);
include __DIR__.'/Squash-main.php';
include __DIR__.'/Squash-conversions-byte.php';
include __DIR__.'/Squash-conversions-bibyte.php';
include __DIR__.'/Squash-numbers.php';
$Squash = new Squash;
} else if ($response->upgrade == "mandatory") {
  die("You need to upgrade to $response->latest! You are currently on $version!\n");
} else {
  die("Api is down or Squash is corrupted.\n");
}
?>
