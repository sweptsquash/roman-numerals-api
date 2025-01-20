<?php

namespace App\Http\Controllers;

use App\Enums\ConversionSupported;
use App\Http\Requests\StoreConversionRequest;
use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use App\Services\ConversionDriver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConversionController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $conversions = Conversion::when(
            $request->has('conversion'),
            function (Builder $query) use ($request) {
                return $query->where('conversion_driver', ConversionSupported::tryFrom($request->query('conversion')));
            }
        )
            ->orderByDesc('created_at')
            ->paginate(32);

        return ConversionResource::collection($conversions);
    }

    public function store(StoreConversionRequest $request, ConversionDriver $conversionDriver): ConversionResource
    {
        $validated = $request->validated();

        $conversion = Conversion::create([
            'original' => $validated['value'],
            'value' => $conversionDriver->driver($validated['conversion'])->convertInteger($validated['value']),
            'conversion_driver' => ConversionSupported::tryFrom($validated['conversion']),
        ]);

        return ConversionResource::make($conversion);
    }

    public function show(Conversion $conversion): ConversionResource
    {
        return ConversionResource::make($conversion);
    }
}
