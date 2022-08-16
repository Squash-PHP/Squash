<?
class SquashConversionsBiByte {
  function kibibyte(int $value, $unit) {
    if ($unit == "kb") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1024;
      $result = $value / $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1.049e+6;
      $result = $value / $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1.074e+9;
      $result = $value / $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1.1e+12;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function mebibyte(int $value, $unit) {
    if ($unit == "kb") {
      $totimesby = 1024;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1;
      $result = $value / $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1024;
      $result = $value / $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1.049e+6;
      $result = $value / $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1.074e+9;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function gibibyte(int $value, $unit) {
    if ($unit == "kb") {
      $totimesby = 1.049e+6;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1024;
      $result = $value * $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1;
      $result = $value / $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1024;
      $result = $value / $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1.049e+6;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function tebibyte(int $value, $unit) {
    if ($unit == "kb") {
      $totimesby = 1.074e+9;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1.049e+6;
      $result = $value * $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1024;
      $result = $value * $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1024;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function pebibyte(int $value, $unit) {
    if ($unit == "kb") {
      $totimesby = 1.1e+12;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1.074e+9;
      $result = $value * $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1.049e+6;
      $result = $value * $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1024;
      $result = $value * $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    return $result;
  }
}
?>