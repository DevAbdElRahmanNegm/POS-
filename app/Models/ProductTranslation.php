<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','image' , 'purchase_price' , 'sale_price' , 'stock'];

    public $timestamps = false;
}
