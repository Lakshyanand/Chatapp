<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','password','role',
    ];

    // protected static function newFactory()
    // {
    //     return App\Models\userdetailFactory::new();
    // }
}
