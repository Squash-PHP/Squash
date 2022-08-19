<?php


namespace Squash\Timer;


use OutOfBoundsException;
use PHPUnit\Framework\TestCase;


class MillisecondsTest extends TestCase
{
    public function testWait(): void
    {
        $timer = new Milliseconds();

        $start = hrtime();
        $timer->wait(1000);
        $end = hrtime();

        $this->assertSame(1, ($end[0] - $start[0]));
    }

    public function testWaitLessThanSecond(): void
    {
        $timer = new Milliseconds();

        $start = hrtime();
        $timer->wait(100);
        $end = hrtime();

        $this->assertSame(0, (int) ($end[0] - $start[0]));
    }

    public function testWaitNegativeNumberError(): void
    {
        $timer = new Milliseconds();
        $this->expectException(OutOfBoundsException::class);
        $timer->wait(-1);
    }
}
