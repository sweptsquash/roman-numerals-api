<?php

use App\Services\ConversionDrivers\RomanNumeralConversionDriver;

use function PHPUnit\Framework\assertSame;

it('Converts `Integers` To `Roman Numerals`', function () {
    $converter = new RomanNumeralConversionDriver;

    $toTest = [
        'I' => 1,
        'IV' => 4,
        'V' => 5,
        'IX' => 9,
        'X' => 10,
        'C' => 100,
        'XL' => 40,
        'L' => 50,
        'XC' => 90,
        'CD' => 400,
        'D' => 500,
        'CM' => 900,
        'M' => 1000,
    ];

    foreach ($toTest as $returnValue => $integer) {
        assertSame($returnValue, $converter->convertInteger($integer));
    }

    assertSame('MMMCMXCIX', $converter->convertInteger(3999));
    assertSame('MMXVI', $converter->convertInteger(2016));
    assertSame('MMXVIII', $converter->convertInteger(2018));
});
