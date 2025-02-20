<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable=['image','blog_id'];
}
