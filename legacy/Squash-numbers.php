<?
class SquashNumber {
  function format(int $num) {
    return number_format($num);
  }
  function round($num, int $dp) {
    return number_format((float)$num, $dp, '.', '');
  }
  function divide(int $num, int $by) {
    if ($num < $by) {
      return ($by / $num);
    }
    if ($num > $by) {
      return ($num / $by);
    }
  }
  function multiply(int $num, int $by) {
    if ($num < $by) {
      return ($by * $num);
    }
    if ($num > $by) {
      return ($num * $by);
    }
  }
  function add(int $num, int $by) {
    if ($num < $by) {
      return ($by + $num);
    }
    if ($num > $by) {
      return ($num + $by);
    }
  }
  function subtract(int $num, int $by) {
    if ($num < $by) {
      return ($by - $num);
    }
    if ($num > $by) {
      return ($num - $by);
    }
  }
}
?>