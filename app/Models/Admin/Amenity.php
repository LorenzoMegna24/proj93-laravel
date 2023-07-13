<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $table = 'amenities';

    protected $fillable = [
        'name',
        'image',
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
