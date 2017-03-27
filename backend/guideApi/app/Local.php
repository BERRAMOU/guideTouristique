<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'description',
        'city_id',
        'address',
        'imagePath',
        'wifi',
        'detail',
        'latitude',
        'longitude'
    ];

    protected $hidden = ['created_at'];

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Categorie');
    }

    public function subCategories()
    {
        return $this->belongsToMany('App\SubCategorie');
    }
}
