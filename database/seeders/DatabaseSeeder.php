<?php

namespace Database\Seeders;

use App\Enums\ConversionSupported;
use App\Models\Conversion;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (ConversionSupported::cases() as $conversion) {
            Conversion::factory(20, ['conversion_driver' => $conversion->value])->create();
        }
    }
}
