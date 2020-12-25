<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Course', 'id', 'categori_id');
    }

}
