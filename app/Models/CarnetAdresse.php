<?php

namespace App\Models;

use App\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarnetAdresse extends Model
{
    use HasFactory, Uuid;


    protected $fillable = [
        'person_name',
        'address_label',
        'apartment_suite_note',
        'has_google_address',
        'google_address',
        'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
