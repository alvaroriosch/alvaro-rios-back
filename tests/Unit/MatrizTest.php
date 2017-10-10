<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Matriz;

class MatrizTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $matriz = new Matriz(4);
        $matriz->update(2,2,2,4);
        $this->assertEquals(4,$matriz->query(1,1,1,3,3,3));
        $matriz->update(1,1,1,23);
        $this->assertEquals(4,$matriz->query(2,2,2,4,4,4));
        $this->assertEquals(27,$matriz->query(1,1,1,3,3,3));
    }

    public function testExampleDos()
    {
        $matriz = new Matriz(2);
        $matriz->update(2,2,2,1);
        $this->assertEquals(0,$matriz->query(1,1,1,1,1,1));
        $this->assertEquals(1,$matriz->query(1,1,1,2,2,2));
        $this->assertEquals(1,$matriz->query(2,2,2,2,2,2));
    }
}
