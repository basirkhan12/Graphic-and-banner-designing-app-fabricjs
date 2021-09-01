<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteDesingn extends Model
{
    use HasFactory;
    protected $fillable = [
        "userID",
        "designID"
    ];

}
