<?php

use App\Enums\ConversionSupported;
use App\Models\Conversion;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\getJson;

describe('Conversion Popular Controller', function () {
    beforeEach(function () {
        foreach (ConversionSupported::cases() as $conversion) {
            Conversion::factory(20, ['conversion_driver' => $conversion->value])->create();

            Conversion::factory(5, ['conversion_driver' => $conversion->value])->create([
                'original' => 123,
            ]);
        }
    });

    it('can retrieve the top 10 converted `of all` values', function () {
        getJson(route('conversions.popular'))
            ->assertJsonCount(10, 'data');
    });

    it('can retrieve the top 10 converted `roman numerals` values', function () {
        getJson(route('conversions.popular', ['conversion' => ConversionSupported::RomanNumeral->value]))
            ->assertJsonCount(10, 'data')
            ->assertJson(function (AssertableJson $json) {
                $json->has('data')
                    ->each(function (AssertableJson $json) {
                        $json->each(function (AssertableJson $json) {
                            $json
                                ->where('conversion_driver', ConversionSupported::RomanNumeral->value)
                                ->has('original')
                                ->has('conversion_driver')
                                ->has('count');
                        });
                    });
            });
    });

    it('can retrieve the top 10 converted `kg to gram` values', function () {
        getJson(route('conversions.popular', ['conversion' => ConversionSupported::KgToGram->value]))
            ->assertJsonCount(10, 'data')
            ->assertJson(function (AssertableJson $json) {
                $json->has('data')
                    ->each(function (AssertableJson $json) {
                        $json->each(function (AssertableJson $json) {
                            $json
                                ->where('conversion_driver', ConversionSupported::KgToGram->value)
                                ->has('original')
                                ->has('conversion_driver')
                                ->has('count');
                        });
                    });
            });
    });

    it('can retrieve the top 10 converted `gram to kg` values', function () {
        getJson(route('conversions.popular', ['conversion' => ConversionSupported::GramToKg->value]))
            ->assertJsonCount(10, 'data')
            ->assertJson(function (AssertableJson $json) {
                $json->has('data')
                    ->each(function (AssertableJson $json) {
                        $json->each(function (AssertableJson $json) {
                            $json
                                ->where('conversion_driver', ConversionSupported::GramToKg->value)
                                ->has('original')
                                ->has('conversion_driver')
                                ->has('count');
                        });
                    });
            });
    });
});
