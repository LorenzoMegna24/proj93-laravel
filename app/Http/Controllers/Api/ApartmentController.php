<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Apartment;

class ApartmentController extends Controller
{
    public function index(){
        $apartments = Apartment::with('amenities','messages','views','sponsors')->paginate(3);

	    return response()->json([
	    	'success' => true,
	    	'apartments' => $apartments
	    ]);
    }
}
