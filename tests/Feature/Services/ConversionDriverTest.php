<?php

use App\Services\ConversionDriver;

use function PHPUnit\Framework\assertSame;

describe('Conversion Driver', function () {
    test('can convert `integer` to `Roman Numerals`', function () {
        $converter = app()->make(ConversionDriver::class)->driver('roman_numeral');

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

    test('can convert `Gram` to `KG`', function () {
        $converter = app()->make(ConversionDriver::class)->driver('gram_to_kg');

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

    test('can convert `KG` to `Gram`', function () {
        $converter = app()->make(ConversionDriver::class)->driver('kg_to_gram');

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
});
