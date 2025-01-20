<?php

namespace App\Http\Controllers;

use App\Enums\ConversionSupported;
use App\Http\Resources\ConversionPopularResource;
use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConversionPopularController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $conversion = Conversion::mostPopularConversion($request->has('conversion') ? ConversionSupported::tryFrom($request->query('conversion')) : null)->get();

        return ConversionPopularResource::collection($conversion);
    }
}
