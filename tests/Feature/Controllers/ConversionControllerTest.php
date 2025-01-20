<?php

use App\Enums\ConversionSupported;
use App\Models\Conversion;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

describe('Conversion Controller', function () {
    it('can retrieve a list of `all types` of conversions', function () {
        Conversion::factory(45)->create();

        getJson(route('conversions.index'))
            ->assertJsonCount(32, 'data')
            ->assertJsonFragment(['total' => 45]);
    });

    it('can retrieve a list of `Roman Numeral` of conversions', function () {
        Conversion::factory(45, ['conversion_driver' => ConversionSupported::GramToKg])->create();
        Conversion::factory(10, ['conversion_driver' => ConversionSupported::RomanNumeral])->create();

        getJson(route('conversions.index', ['conversion' => ConversionSupported::RomanNumeral->value]))
            ->assertJsonFragment(['total' => 10]);
    });

    it('can store a new `Integer` to `Roman Numeral` conversion', function () {
        postJson(route('conversions.store'), [
            'value' => 3999,
            'conversion' => ConversionSupported::RomanNumeral->value,
        ])
            ->assertCreated()
            ->assertJson([
                'data' => [
                    'original' => 3999,
                    'value' => 'MMMCMXCIX',
                ],
            ]);

        assertDatabaseHas('conversions', [
            'original' => 3999,
            'value' => 'MMMCMXCIX',
            'conversion_driver' => ConversionSupported::RomanNumeral->value,
        ]);
    });

    it('can store a new `KG` to `Gram` conversion', function () {
        postJson(route('conversions.store'), [
            'value' => 0.001,
            'conversion' => ConversionSupported::KgToGram->value,
        ])
            ->assertCreated()
            ->assertJson([
                'data' => [
                    'original' => 0.001,
                    'value' => '1',
                ],
            ]);

        assertDatabaseHas('conversions', [
            'original' => 0.001,
            'value' => '1',
            'conversion_driver' => ConversionSupported::KgToGram->value,
        ]);
    });

    it('can store a new `Gram` to `KG` conversion', function () {
        postJson(route('conversions.store'), [
            'value' => 1000,
            'conversion' => ConversionSupported::GramToKg->value,
        ])
            ->assertCreated()
            ->assertJson([
                'data' => [
                    'original' => 1000,
                    'value' => '1',
                ],
            ]);

        assertDatabaseHas('conversions', [
            'original' => 1000,
            'value' => '1',
            'conversion_driver' => ConversionSupported::GramToKg->value,
        ]);
    });

    it('retrieves a specific conversion', function () {
        $conversion = Conversion::factory()->create();

        getJson(route('conversions.show', $conversion->id))
            ->assertJson([
                'data' => [
                    'id' => $conversion->id,
                    'original' => $conversion->original,
                    'value' => $conversion->value,
                    'created_at' => $conversion->created_at->format('Y-m-d\TH:i:s.u\Z'),
                    'updated_at' => $conversion->updated_at->format('Y-m-d\TH:i:s.u\Z'),
                ],
            ]);
    });

    it('throws a validation error when storing a new conversion with invalid data', function () {
        postJson(route('conversions.store'), [
            'value' => 0,
            'conversion' => ConversionSupported::RomanNumeral->value,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('value');
    });

    it('throws a validation error when using a non supported unit of conversion', function () {
        postJson(route('conversions.store'), [
            'value' => 100,
            'conversion' => 'not-a-valid-conversion',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('conversion');
    });
});
