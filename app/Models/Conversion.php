<?php

namespace App\Models;

use App\Enums\ConversionSupported;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @mixin IdeHelperConversion
 */
class Conversion extends Model
{
    /** @use HasFactory<\Database\Factories\ConversionFactory> */
    use HasFactory;

    protected $fillable = ['original', 'value', 'conversion_driver'];

    /**
     * @return array{original: 'float', value: 'string', conversion_driver: 'App\Enums\ConversionSupported' }
     */
    protected function casts(): array
    {
        return [
            'original' => 'float',
            'value' => 'string',
            'conversion_driver' => ConversionSupported::class,
        ];
    }

    public function scopeMostPopularConversion(Builder $query, ?ConversionSupported $conversionSupported = null): void
    {
        $query->select(['original', 'conversion_driver', DB::raw('COUNT(*) as count')])
            ->groupBy(['original', 'conversion_driver'])
            ->when($conversionSupported, fn ($query) => $query->where('conversion_driver', $conversionSupported))
            ->limit(10)
            ->orderByDesc('count');
    }
}
