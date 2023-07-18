<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Amenity;

class AmenityController extends Controller
{
    public function index(){
        $amenities = Amenity::all();
        return response()->json(
            [
                'success' => true,
                'amenities' => $amenities
            ]
        );
    }
}
