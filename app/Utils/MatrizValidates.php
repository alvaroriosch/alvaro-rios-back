<?php

namespace App\Utils;

class MatrizValidates
{

  public static function boundValidates($value, $min, $max) {
    if ($value < $min || $value > $max) {
      throw new InvalidArgumentException("$value esta fuera de los limites");
    }
  }

  public static function validateInteger() {
    $args = func_get_args();
    foreach ($args as $value) {
      if (!is_int($value)) {
        throw new InvalidArgumentException("$value debe ser un entero");
      }
    }
  }
}
