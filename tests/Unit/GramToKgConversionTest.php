<?php

use App\Services\ConversionDrivers\GramToKgConversionDriver;

use function PHPUnit\Framework\assertSame;

it('Converts `Grams` to `KG`', function () {
    $converter = new GramToKgConversionDriver;

    $toTest = [
        1 => '0.001',
        1000 => '1',
        1255 => '1.255',
        10000 => '10',
        10255 => '10.255',
        100000 => '100',
        100255 => '100.255',
        1000000 => '1000',
        1000255 => '1000.255',
    ];

    foreach ($toTest as $integer => $returnValue) {
        assertSame($returnValue, $converter->convertInteger($integer));
    }
});
