<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $fillable=['title','slug','description'];

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
