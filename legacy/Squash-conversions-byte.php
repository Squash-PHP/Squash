<?php
class SquashConversionsByte {
  function bytes(int $value, $unit) {
    if ($unit == "b") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    if ($unit == "kb") {
      $totimesby = 1000;
      $result = $value / $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1e+6;
      $result = $value / $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1e+9;
      $result = $value / $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1e+12;
      $result = $value / $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1e+15;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function kilobytes(int $value, $unit) {
    if ($unit == "b") {
      $totimesby = 1000;
      $result = $value * $totimesby;
    }
    if ($unit == "kb") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1000;
      $result = $value / $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1e+6;
      $result = $value / $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1e+9;
      $result = $value / $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1e+12;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function megabytes(int $value, $unit) {
    if ($unit == "b") {
      $totimesby = 1e+6;
      $result = $value * $totimesby;
    }
    if ($unit == "kb") {
      $totimesby = 1000;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1000;
      $result = $value / $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1e+6;
      $result = $value / $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1e+9;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function gigabytes(int $value, $unit) {
    if ($unit == "b") {
      $totimesby = 1e+9;
      $result = $value * $totimesby;
    }
    if ($unit == "kb") {
      $totimesby = 1e+6;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1000;
      $result = $value * $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1e+12;
      $result = $value / $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1000;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function terabytes(int $value, $unit) {
    if ($unit == "b") {
      $totimesby = 1e+12;
      $result = $value * $totimesby;
    }
    if ($unit == "kb") {
      $totimesby = 1e+9;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1e+6;
      $result = $value * $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1000;
      $result = $value * $totimesby;
    }
    if ($unit == "tb") {
      $totimesby = 1;
      $result = $value * $totimesby;
    }
    if ($unit == "pb") {
      $totimesby = 1000;
      $result = $value / $totimesby;
    }
    return $result;
  }
  function petabytes(int $value, $unit) {
    if ($unit == "b") {
      $totimesby = 1e+15;
      $result = $value * $totimesby;
    }
    if ($unit == "kb") {
      $totimesby = 1e+9;
      $result = $value * $totimesby;
    }
    if ($unit == "mb") {
      $totimesby = 1e+6;
      $result = $value * $totimesby;
    }
    if ($unit == "gb") {
      $totimesby = 1000;
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