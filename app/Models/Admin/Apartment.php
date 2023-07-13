<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $table = 'apartments';

    protected $fillable = [
        'title',
        'room',
        'bathroom',
        'bed',
        'sq_meters',
        'address',
        'longitude',
        'latitude',
        'image',
        'visibility',
        'slug',
    ];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }
}
