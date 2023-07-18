<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Sponsor;

class SponsorController extends Controller
{
    public function index(){
        $sponsor = Sponsor::all();
        return response()->json(
            [
                'success' => true,
                'sponsor' => $sponsor
            ]
        );
    }
}
