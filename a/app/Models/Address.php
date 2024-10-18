<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'pseudo', 'adressName', 'city', 'info','googleAddress', 'latitude', 'longitude', 'codePin', 'user_id',
    ];


    public function media()
    {
        return $this->hasOne(Media::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
