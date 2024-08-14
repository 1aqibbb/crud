<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'breed', 'birth_year','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
