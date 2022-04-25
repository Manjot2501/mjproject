<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incharge extends Model
{
    use HasFactory;
    protected $table = 'incharge';
    protected $hidden = ['password'];
    protected $fillable = ['name','email','password','created_at','updated_at'];
}
