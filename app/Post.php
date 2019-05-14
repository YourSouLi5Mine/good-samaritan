<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contain'
    ];

    protected $postgistFields = [
      'location'
    ];

    public function user()
    {
      return $this
        ->belongsTo('App\User');
    }

    public function group()
    {
      return $this
        ->belongsTo('App\Group');
    }
}
