<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    use HasFactory;

    /*Get the user that added visit the endpoint */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
