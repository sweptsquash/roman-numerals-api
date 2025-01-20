<?php

use App\Enums\ConversionSupported;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->integer('original');
            $table->string('value');
            $table->string('conversion_driver')->default(ConversionSupported::RomanNumeral->value);
            $table->timestamps();
        });
    }
};
