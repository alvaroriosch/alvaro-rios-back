<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Utils\MatrizValidates;

use InvalidArgumentException;

class MatrizValidatesTest extends TestCase
{
    public function testExecptionRaisedOnNoIntegerArgument()
    {
      $this->expectException(InvalidArgumentException::class);
      MatrizValidates::validateInteger('a');
    }

    public function testAssertIntegerArgument()
    {
      $this->assertEquals(true, MatrizValidates::validateInteger(10));
    }

    public function testExecptionRaisedOnNoInBoundsArgument()
    {
      $this->expectException(InvalidArgumentException::class);
      MatrizValidates::boundValidates(5,1,4);
    }

    public function testAssertArgumentOnBound()
    {
      $this->assertEquals(true, MatrizValidates::boundValidates(3,1,4));
    }
}
