<?php declare(strict_types=1);

use Conversion\Converter;
use Conversion\Dimension;
use Conversion\Unit;
use Conversion\UnitPart;
use PHPUnit\Framework\TestCase;

final class VolumeTest extends TestCase
{
    protected Unit $liter;
    protected Unit $m3;

    protected function setUp(): void
    {
        parent::setUp();

        $this->liter = new Unit(new UnitPart(0.1, Dimension::LENGTH, 3));
        $this->m3 = new Unit(new UnitPart(1, Dimension::LENGTH, 3));

        $this->converter = new Converter();
    }

    public function test_liter_to_m3(): void
    {
        $this->assertEqualsWithDelta(0.001, $this->converter->convert($this->liter, $this->m3, 1), 0.001);
    }

    public function test_m3_to_liter(): void
    {
        $this->assertEqualsWithDelta(1000, $this->converter->convert($this->m3, $this->liter, 1), 0.001);
    }
}
