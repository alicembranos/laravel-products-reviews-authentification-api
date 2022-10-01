<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /* Get the product that owns the review */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*Get the user that made the review */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
