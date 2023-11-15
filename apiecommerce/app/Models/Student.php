<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        "name",
        "email",
        "phone",
        "password",
    ];
}
