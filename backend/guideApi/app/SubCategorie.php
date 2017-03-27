<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategorie extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subCategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'description',
        'category_id'
    ];

    protected $hidden = ['created_at'];

    public function categorie()
    {
        return $this->belongsTo('App\Categorie', 'category_id');
    }


}
