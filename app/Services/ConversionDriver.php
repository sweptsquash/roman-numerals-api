<?php

namespace App\Services;

use App\Services\ConversionDrivers\GramToKgConversionDriver;
use App\Services\ConversionDrivers\KgToGramConversionDriver;
use App\Services\ConversionDrivers\RomanNumeralConversionDriver;
use Illuminate\Support\Manager;

class ConversionDriver extends Manager
{
    public function getDefaultDriver()
    {
        return config('services.conversion.driver');
    }

    public function createRomanNumeralDriver()
    {
        return new RomanNumeralConversionDriver;
    }

    public function createKgToGramDriver()
    {
        return new KgToGramConversionDriver;
    }

    public function createGramToKgDriver()
    {
        return new GramToKgConversionDriver;
    }
}
