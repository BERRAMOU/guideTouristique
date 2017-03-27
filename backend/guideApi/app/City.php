<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'uf',
        'latitude',
        'longitude'
    ];

    protected $hidden = ['created_at'];

    public function categories()
    {
        return $this->belongsTo('App\Categorie', 'category_id');
    }

}
