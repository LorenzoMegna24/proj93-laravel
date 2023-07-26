<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Amenity;
use App\Models\Admin\Apartment;
use Illuminate\Http\Request;
use App\Models\Admin\ApartmentSponsor;


use App\Http\Controllers\Illuminate\Support\Str;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $apartments = Apartment::where('user_id', $user->id)->get();

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
    public function store(StoreApartmentRequest $request)
    {
        $form_data = $request->validated();

        $slug = Apartment::generateUniqueSlug($request->title);

        $form_data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('apartment_image', $request->image);
            $form_data['image'] = $path;
        }

        $new_apartment = new Apartment($form_data);

        $new_apartment->user_id = auth()->user()->id;



        $address = $form_data['address'];
        $url = 'https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json?key=asb5Pwh7kCfYH2ak33Rwa7ebLVG3P4GF';
        $response = file_get_contents($url);

        $new_apartment->save();
        $json = json_decode($response);
        if ($request->has('amenities')) {
            $new_apartment->amenities()->attach($request->amenities);
        }

        $latitude = $json->results[0]->position->lat;
        $longitude = $json->results[0]->position->lon;


        $new_apartment->update([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);


        return redirect()->route('apartments.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $sponsor = ApartmentSponsor::where('apartment_id', $apartment->id)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        // Passa i dati alla vista
        return view('admin.apartments.show', [
            'apartment' => $apartment,
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        if (auth()->id() !== $apartment->user_id) {

            return redirect()->route('apartments.index')->with('error', 'Non sei autorizzato a modificare questo appartamento');
        }

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
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {

        $form_data = $request->validated();

        $slug = Apartment::generateSlug($request->title);
        $slug = Apartment::generateUniqueSlug($request->title);

        $form_data['slug'] = $slug;

        if ($request->hasFile('image')) {

            if ($apartment->image) {
                Storage::delete($apartment->image);
            }

            $path = Storage::disk('public')->put('apartment_image', $request->image);
            $form_data['image'] = $path;
        }

        $apartment->update($form_data);

        $apartment->user_id = auth()->user()->id;

        $address = $form_data['address'];
        $url = 'https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json?key=asb5Pwh7kCfYH2ak33Rwa7ebLVG3P4GF';
        $response = file_get_contents($url);

        $apartment->save();
        $json = json_decode($response);
        if ($request->has('amenities')) {
            $apartment->amenities()->sync($request->amenities);
        }

        $latitude = $json->results[0]->position->lat;
        $longitude = $json->results[0]->position->lon;


        $apartment->update([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        return redirect()->route('apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        foreach ($apartment->messages as $message) {
            $message->delete();
        }

        $apartment->amenities()->sync([]);

        if ($apartment->image) {
            Storage::delete($apartment->image);
        }

        $apartment->delete();

        return redirect()->route('apartments.index');
    }
}
