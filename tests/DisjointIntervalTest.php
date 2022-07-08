<?php

declare(strict_types=1);

namespace Test;

use App\Interval\DisjointInterval;
use PHPUnit\Framework\TestCase;
use App\Traits\ArrayFunctions;

class DisjointIntervalTest extends TestCase
{
    private $globalSort;

    use ArrayFunctions;

    public function setUp(): void
    {
        $this->disjointInterval = new DisjointInterval();
    }

    public function testFoo()
    {
        $this->assertSame(
            $this->arrays_are_similar(
                $this->array_flatten([[0, 3], [6, 10]]),
                $this->array_flatten($this->disjointInterval->foo([[0, 3], [6, 10]])), 
            ),
            true
        );

        $this->assertSame(
            $this->arrays_are_similar(
                $this->array_flatten([[0, 10]]),
                $this->array_flatten($this->disjointInterval->foo([[0, 5], [3, 10]])), 
            ),
            true
        );

        $this->assertSame(
            $this->arrays_are_similar(
                $this->array_flatten([[0, 5]]),
                $this->array_flatten($this->disjointInterval->foo([[0, 5], [2, 4]])), 
            ),
            true
        );

        $this->assertSame(
            $this->arrays_are_similar(
                $this->array_flatten([[2, 6], [7, 8]]),
                $this->array_flatten($this->disjointInterval->foo([[7, 8], [3, 6], [2, 4]])), 
            ),
            true
        );

        $this->assertSame(
            $this->arrays_are_similar(
                $this->array_flatten([[1, 10], [15, 20]]),
                $this->array_flatten($this->disjointInterval->foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]])), 
            ),
            true
        );
    }   
}