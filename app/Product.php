<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product Extends Model
{
  protected $fillable = [
    'name', 'price', 'description'
  ];
}
