<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'apartment_id',
        'mail',
        'name',
        'surname',
        'date',
        'content',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
