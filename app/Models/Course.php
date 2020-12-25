<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image_name',
        'description',
        'colors',
        'price',
        'discount',
        'tag',
        'categori_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Categori','categori_id','id');
    }


}
