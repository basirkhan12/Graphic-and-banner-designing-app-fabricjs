<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrativeDesigns extends Model
{
    use HasFactory;
    protected $fillable = [
        "designJson",
        "displayUrl",
        "userID",
        "visible",
        "title",
        "keywords"
    ];

    
}
