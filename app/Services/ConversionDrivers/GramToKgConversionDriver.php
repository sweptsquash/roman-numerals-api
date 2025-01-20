<?php

namespace App\Services\ConversionDrivers;

class GramToKgConversionDriver implements IntegerConverterInterface
{
    public function convertInteger(int|float $value): string
    {
        return (string) ($value / 1000);
    }
}
