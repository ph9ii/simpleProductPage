<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'title', 'seller_id', 'slug', 'quantity', 'price'
    ];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = strtolower($title);
    }

    public function getTitleAttribute($title)
    {
        return ucwords($title);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
