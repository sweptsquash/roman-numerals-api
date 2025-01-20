<?php

namespace App\Services\ConversionDrivers;

interface IntegerConverterInterface
{
    public function convertInteger(int|float $value): string;
}
