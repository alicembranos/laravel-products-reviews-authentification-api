<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /*Get the reviews of the product */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /*Get the user that added the product */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*Get the reviews of the product */
    public function endpoints()
    {
        return $this->hasMany(Endpoint::class);
    }
}
