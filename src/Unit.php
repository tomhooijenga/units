<?php declare(strict_types=1);

namespace Conversion;

class Unit
{
    protected array $parts;

    public function __construct(UnitPart ...$parts)
    {
        $this->parts = $parts;
    }

    public function getParts(): array
    {
        return $this->parts;
    }

    public function getPart(int $index): UnitPart
    {
        return $this->parts[$index];
    }

    public function isCompound(): bool
    {
        return count(array_filter($this->getDimensions())) > 1;
    }

    public function getDimensions(): array
    {
        $dimensions = [
            Dimension::MASS->name => 0,
            Dimension::LENGTH->name => 0,
            Dimension::TIME->name => 0,
            Dimension::CURRENT->name => 0,
            Dimension::TEMPERATURE->name => 0,
            Dimension::LUMINOUS_INTENSITY->name => 0,
            Dimension::AMOUNT_OF_SUBSTANCE->name => 0,
            Dimension::ANGLE->name => 0,
        ];

        foreach ($this->getParts() as $part) {
            $dimensions[$part->getDimension()->name] += $part->getPower();
        }

        return $dimensions;
    }

    public function __toString(): string
    {
        return $this->format();
    }

    public function format(): string
    {
        $parts = array_map(fn (UnitPart $part) => $part->format(), $this->getParts());

        return implode('*', $parts);
    }
}