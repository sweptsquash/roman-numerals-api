<?php

namespace App\Services\ConversionDrivers;

class KgToGramConversionDriver implements IntegerConverterInterface
{
    public function convertInteger(int|float $value): string
    {
        return (string) ($value * 1000);
    }
}
