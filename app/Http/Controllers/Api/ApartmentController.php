<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Apartment;

class ApartmentController extends Controller
{
	public function index()
	{
		$apartments = Apartment::with('amenities', 'messages', 'views', 'sponsors')->paginate(9);

		return response()->json([
			'success' => true,
			'apartments' => $apartments
		]);
	}

	public function show($slug)
    {
        $apartment = Apartment::with( 'amenities', 'messages', 'views', 'sponsors' )-> where('slug', $slug )->first();

        if ($apartment){
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
}
