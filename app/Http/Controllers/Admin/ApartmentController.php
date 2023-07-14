<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Amenity;
use App\Models\Admin\Apartment;
use Illuminate\Http\Request;

use App\Http\Controllers\Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenities = Amenity::all();

        return view('admin.apartments.create', compact('amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $slug = Apartment::generateSlug($request->title);

        $form_data['slug'] = $slug;

        if($request->hasFile('image')){
            $path = Storage::disk('public')->put('apartment_image', $request->image);
            $form_data['image'] = $path;
        }
        // $apartment = Apartment::create($form_data);
        $new_apartment = Apartment::create($form_data);

        if($request->has('amenities')){
            $new_apartment->amenities()->attach($request->amenities);
        }

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show',  compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $amenities = Amenity::all();
        return view('admin.apartments.edit', compact('apartment', 'amenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $form_data = $request->all();

        $slug = Apartment::generateSlug($request->title);

        $form_data['slug'] = $slug;

        if($request->hasFile('image')){

            if( $apartment->image ){
                Storage::delete($apartment->image);
            }

            $path = Storage::disk('public')->put('apartment_image', $request->image);
            $form_data['image'] = $path;
        }

        $apartment->update($form_data);

        if($request->has('amenities')){
            $apartment->amenities()->sync($request->amenities);
        }

        return redirect()->route('admin.apartments.store');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->amenities()->sync([]);

        if($apartment->image){
            Storage::delete($apartment->image);
        }

        $apartment->delete();

        return redirect()->route('admin.apartment.index');
    }
}
