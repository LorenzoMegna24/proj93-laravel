<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentSponsor extends Model
{
    use HasFactory;

    protected $table = 'apartment_sponsor';

    protected $primaryKey = 'id';

    protected $fillable = [
        'apartment_id',
        'sponsor_id',
        'start_date',
        'end_date',
    ];
}
