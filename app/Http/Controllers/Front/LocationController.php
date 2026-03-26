<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY', '');
        $this->baseUrl = 'https://rajaongkir.komerce.id/api/v1';
    }

    public function destinations(Request $request)
    {
        $search = $request->query('search', '');
        
        if (strlen($search) < 3) {
            return response()->json([]);
        }

        // Cache the search results for a day to reduce API calls
        $destinations = Cache::remember('komerce_dest_' . md5($search), 86400, function () use ($search) {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->get($this->baseUrl . '/destination/domestic-destination', [
                'search' => $search,
                'limit' => 10,
                'offset' => 0
            ]);
            
            if ($response->successful() && isset($response->json()['data'])) {
                return $response->json()['data'];
            }
            
            return [];
        });

        return response()->json($destinations);
    }

    public function checkCost(Request $request)
    {
        $request->validate([
            'destination' => 'required|integer',
            'weight' => 'required|integer', // in grams
            'courier' => 'required|string',
        ]);

        $origin = env('RAJAONGKIR_ORIGIN_CITY_ID', 153); // Ensure this matches a Komerce ID, 153 is valid.

        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->asForm()->post($this->baseUrl . '/calculate/domestic-cost', [
            'origin' => $origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);

        if ($response->successful() && isset($response->json()['data'])) {
            return response()->json($response->json()['data']);
        }

        return response()->json(['error' => 'Gagal mengecek ongkir'], 500);
    }
}
