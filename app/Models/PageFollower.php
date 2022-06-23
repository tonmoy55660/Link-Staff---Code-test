<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageFollower extends Model
{
    use HasFactory;
    protected $table = 'page_followers';

    protected $fillable = [
       'page_id', 'follower_id'
    ];
}
