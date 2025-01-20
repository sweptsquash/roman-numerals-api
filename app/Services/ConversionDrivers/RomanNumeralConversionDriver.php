<?php

namespace App\Services\ConversionDrivers;

class RomanNumeralConversionDriver implements IntegerConverterInterface
{
    /** @var array<int, string> */
    private array $numeralMap = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I',
    ];

    public function convertInteger(int|float $value): string
    {
        if (is_float($value)) {
            throw new \InvalidArgumentException('Only integers can be converted to Roman numerals');
        }

        $result = '';

        foreach ($this->numeralMap as $numeralValue => $numeral) {
            while ($value >= $numeralValue) {
                $result .= $numeral;
                $value -= $numeralValue;
            }
        }

        return $result;
    }
}
