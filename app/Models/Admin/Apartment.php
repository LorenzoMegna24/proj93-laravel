<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $table = 'apartments';

    protected $fillable = [
        'user_id',
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

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'apartment_sponsor')->withPivot('start_date', 'end_date');
    }

    public static function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $newSlug = $slug;
        $counter = 1;

        while (static::slugExists($newSlug, $id)) {
            $newSlug = $slug . '-' . $counter;
            $counter++;
        }

        return $newSlug;
    }

    public static function slugExists($slug, $id = null)
    {
        $query = static::where('slug', $slug);

        if ($id) {
            $query->where('id', '!=', $id);
        }

        return $query->exists();
    }
}
