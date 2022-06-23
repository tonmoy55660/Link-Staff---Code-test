<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonFollowers extends Model
{
    use HasFactory;

    protected $table = 'person_followers';

    protected $fillable = [
        'user_id', 'follower_id'
    ];
}
