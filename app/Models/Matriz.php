<?php

namespace App\Models;

use App\Utils\MatrizValidates;

class Matriz
{
  /*
   * @var array $matriz matriz con la que se hacen los calculos.
   */
  private $matriz;
  /*
   * @var int $size tamaño de la matriz
   */
  private $size = 0;

  public static $INITIAL_VALUE = 0;

  public static $MIN_MATRIZ_SIZE = 1;
  public static $MAX_MATRIZ_SIZE = 100;

  public static $MIN_POINT = 1;

  public static $MIN_VALUE = -1000000000;
  public static $MAX_VALUE = 1000000000;

  public static $QUERY_ACTION_NAME = 'query';
  public static $UPDATE_ACTION_NAME = 'update';

  /*
  * Se encarga de generar la matriz con valores iniciales en 0
  * @param int $size tamaño de la matriz
  */
  public function __construct($size) {
    $this->size = $size;
    MatrizValidates::validateInteger($size);
    MatrizValidates::boundValidates(
      $this->size,
      Matriz::$MIN_MATRIZ_SIZE,
      Matriz::$MAX_MATRIZ_SIZE
    );
    $this->matriz = array();
    for( $i = 0; $i < $this->size; $i++ ) {
      $this->matriz[$i] = array();
      for( $j = 0; $j < $this->size; $j++ ) {
        $this->matriz[$i][$j] = array();
        for( $k = 0; $k < $this->size; $k++ ) {
          $this->matriz[$i][$j][$k] = Matriz::$INITIAL_VALUE;
        }
      }
    }
  }

  /*
  * Se encarga de actualizar el valor de uno de los elementos de la matriz
  * @param int $x coordenada x de la matriz
  * @param int $y coordenada y de la matriz
  * @param int $z coordenada z de la matriz
  * @param int $value valor que se va a asignar al punto
  */
  public function update($x, $y, $z, $value) {
    MatrizValidates::validateInteger($x, $y, $z, $value);
    MatrizValidates::boundValidates(
      $x,
      Matriz::$MIN_POINT,
      $this->size
    );
    MatrizValidates::boundValidates(
      $y,
      Matriz::$MIN_POINT,
      $this->size
    );
    MatrizValidates::boundValidates(
      $z,
      Matriz::$MIN_POINT,
      $this->size
    );
    MatrizValidates::boundValidates(
      $value,
      Matriz::$MIN_VALUE,
      Matriz::$MAX_VALUE
    );
    $this->matriz[$x - 1][$y - 1][$z - 1] = $value;
  }


  /*
  * Se encarga de consultar la suma los elementos en la matriz entre los puntos
  * indicados
  * @param int $x1 coordenada x inicial
  * @param int $y1 coordenada y inicial
  * @param int $z1 coordenada z inicial
  * @param int $x2 coordenada x final
  * @param int $y2 coordenada y final
  * @param int $z2 coordenada z final
  *
  * @return int $sum Suma de los elementos
  */
  public function query($x1, $y1, $z1, $x2, $y2, $z2) {
    MatrizValidates::validateInteger($x1, $y1, $z1, $x2, $y2, $z2);
    MatrizValidates::boundValidates(
      $x1,
      Matriz::$MIN_POINT,
      $x2
    );
    MatrizValidates::boundValidates(
      $y1,
      Matriz::$MIN_POINT,
      $y2
    );
    MatrizValidates::boundValidates(
      $z1,
      Matriz::$MIN_POINT,
      $z2
    );
    MatrizValidates::boundValidates(
      $x2,
      $x1,
      $this->size
    );
    MatrizValidates::boundValidates(
      $y2,
      $y1,
      $this->size
    );
    MatrizValidates::boundValidates(
      $z2,
      $z1,
      $this->size
    );
    $sum = 0;
    for ($i = $x1 - 1; $i < $x2; ++$i) {
        for ($j = $y1 - 1; $j < $y2; ++$j) {
            for ($k = $z1 - 1; $k < $z2; ++$k) {
                $sum += $this->matriz[$i][$j][$k];
            }
        }
    }
    return $sum;
  }
}
