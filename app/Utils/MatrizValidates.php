<?php

namespace App\Utils;

use InvalidArgumentException;

class MatrizValidates
{

  public static function boundValidates($value, $min, $max) {
    if ($value < $min || $value > $max) {
      throw new InvalidArgumentException("$value esta fuera de los limites");
    }
    return true;
  }

  public static function validateInteger() {
    $args = func_get_args();
    foreach ($args as $value) {
      if (!is_int($value)) {
        throw new InvalidArgumentException("$value debe ser un entero");
      }
    }
    return true;
  }
}
