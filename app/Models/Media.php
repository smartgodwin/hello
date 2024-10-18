<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo1',
        'photo2',
        'audio1',
        'audio2',
        'video1',
        'video2',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
