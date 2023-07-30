<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Apartment;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Apartment::with('amenities', 'sponsors')
            ->selectRaw("apartments.*, (CASE WHEN apartment_sponsor.end_date > NOW() THEN 0 ELSE 1 END) AS sponsored_order")
            ->leftJoin('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->distinct()
            ->orderBy('sponsored_order', 'ASC');


        if ($request->has('latitude') && $request->has('longitude')) {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $radius = $request->input('radius', 20); // Raggio di ricerca in km

            $query->selectRaw("( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin(radians(latitude)) ) ) AS distance", [$latitude, $longitude, $latitude])
                ->havingRaw("distance < ?", [$radius])
                ->orderBy('distance', 'ASC');
        }


        if ($request->has('sponsor_id')) {
            $query->where('sponsor_id', $request->sponsor_id);
        }

        if ($request->has('amenities_id')) {
            $amenitiesId = explode(',', $request->amenities_id);
            $query->whereHas('amenities', function ($query) use ($amenitiesId) {
                $query->whereIn('id', $amenitiesId);
            }, '=', count($amenitiesId));
        }

        if ($request->has('min_rooms')) {
            $query->where('room', '>=', $request->min_rooms);
        }

        if ($request->has('min_beds')) {
            $query->where('bed', '>=', $request->min_beds);
        }

        $apartments = $query->paginate(9);

        if ($apartments->isEmpty()) {
            return response()->json([
                'success' => false,
                'error' => 'Non ci sono appartamenti che corrispondono ai filtri selezionati'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'apartments' => $apartments
            ]);
        }
    }

    public function show($slug)
    {
        $apartment = Apartment::with('amenities', 'messages', 'views', 'sponsors')->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'apartment' => $apartment
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'non ci sono appartamenti'
            ]);
        }
    }

    public function sponsoredApartments()
    {
        $apartments = Apartment::with('amenities')->whereHas('sponsors', function ($query) {
            $query->where('end_date', '>', now());
        })->get();

        return response()->json([
            'success' => true,
            'apartments' => $apartments
        ]);
    }
}
