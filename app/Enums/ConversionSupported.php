<?php

namespace App\Enums;

enum ConversionSupported: string
{
    case RomanNumeral = 'roman_numeral';
    case KgToGram = 'kg_to_gram';
    case GramToKg = 'gram_to_kg';
}
