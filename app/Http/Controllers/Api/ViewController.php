<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\View;

class ViewController extends Controller
{
    public function index(){
        $views = View::all();
        return response()->json(
            [
                'success' => true,
                'views' => $views
            ]
        );
    }
}
