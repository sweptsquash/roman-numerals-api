<?php

use App\Services\ConversionDrivers\KgToGramConversionDriver;

use function PHPUnit\Framework\assertSame;

it('Converts `KG` to `Grams`', function () {
    $converter = new KgToGramConversionDriver;

    $toTest = [
        1 => '1000',
        10 => '10000',
        100 => '100000',
        1000 => '1000000',
    ];

    foreach ($toTest as $integer => $returnValue) {
        assertSame($returnValue, $converter->convertInteger($integer));
    }

    assertSame('1', $converter->convertInteger(0.001));
    assertSame('1255', $converter->convertInteger(1.255));
    assertSame('10255', $converter->convertInteger(10.255));
    assertSame('100255', $converter->convertInteger(100.255));
    assertSame('1000255', $converter->convertInteger(1000.255));
});
